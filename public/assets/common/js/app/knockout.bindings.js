/*Knockout Bindings */
(function (factory) {
    // Module systems magic dance.

    if (typeof require === "function" && typeof exports === "object" && typeof module === "object") {
        // CommonJS or Node: hard-coded dependency on "knockout"
        factory(require("knockout"), require("jquery"));
    } else if (typeof define === "function" && define["amd"]) {
        // AMD anonymous module with hard-coded dependency on "knockout"
        define(["knockout", "jquery"], factory);
    } else {
        // <script> tag: use the global `ko` object, attaching a `mapping` property
        factory(ko, jQuery);
    }
}(function (ko, $) {

    var fileBindings = {
        customFileInputSystemOptions: {
            wrapperClass: 'custom-file-input-wrapper',
            fileNameClass: 'custom-file-input-file-name',
            buttonGroupClass: 'custom-file-input-button-group',
            buttonClass: 'custom-file-input-button',
            clearButtonClass: 'custom-file-input-clear-button',
            buttonTextClass: 'custom-file-input-button-text',
        },
        defaultOptions: {
            wrapperClass: 'input-group',
            fileNameClass: 'disabled form-control',
            noFileText: 'No file chosen',
            buttonGroupClass: 'input-group-btn',
            buttonClass: 'btn btn-primary',
            clearButtonClass: 'btn btn-default',
            buttonText: 'Choose File',
            changeButtonText: 'Change',
            clearButtonText: 'Clear',
            fileName: true,
            clearButton: true,
            onClear: function(fileData, options) {
                if (typeof fileData.clear === 'function') {
                    fileData.clear();
                }
            }
        },
    }

    var windowURL = window.URL || window.webkitURL;

    ko.bindingHandlers.fileInput = {
        init: function(element, valueAccessor) {
            element.onchange = function() {
                var fileData = ko.utils.unwrapObservable(valueAccessor()) || {};
                if (fileData.dataUrl) {
                    fileData.dataURL = fileData.dataUrl;
                }
                if (fileData.objectUrl) {
                    fileData.objectURL = fileData.objectUrl;
                }
                fileData.file = fileData.file || ko.observable();

                var file = this.files[0];
                if (file) {
                    fileData.file(file);
                }

                if (!fileData.clear) {
                    fileData.clear = function() {
                        $.each(['file', 'objectURL', 'base64String', 'binaryString', 'text', 'dataURL', 'arrayBuffer'], function(i, property) {
                            if (fileData[property] && ko.isObservable(fileData[property])) {
                                if (property == 'objectURL') {
                                    windowURL.revokeObjectURL(fileData.objectURL());
                                }
                                fileData[property](null);
                            }
                        });
                        element.value = '';
                    }
                }
                if (ko.isObservable(valueAccessor())) {
                    valueAccessor()(fileData);
                }
            };
            element.onchange();
        },
        update: function(element, valueAccessor, allBindingsAccessor) {

            var fileData = ko.utils.unwrapObservable(valueAccessor());

            var file = ko.isObservable(fileData.file) && fileData.file();

            if (fileData.objectURL && ko.isObservable(fileData.objectURL)) {
                var newUrl = file && windowURL.createObjectURL(file);
                if (newUrl) {
                    var oldUrl = fileData.objectURL();
                    if (oldUrl) {
                        windowURL.revokeObjectURL(oldUrl);
                    }
                    fileData.objectURL(newUrl);
                }
            }


            if (fileData.base64String && ko.isObservable(fileData.base64String)) {
                if (fileData.dataURL && ko.isObservable(fileData.dataURL)) {
                    // will be handled
                }
                else {
                    fileData.dataURL = ko.observable(); // hack
                }
            }

            // var properties = ['binaryString', 'text', 'dataURL', 'arrayBuffer'], property;
            // for(var i = 0; i < properties.length; i++){
            //     property = properties[i];
            ['binaryString', 'text', 'dataURL', 'arrayBuffer'].forEach(function(property){
                var method = 'readAs' + (property.substr(0, 1).toUpperCase() + property.substr(1));
                if (property != 'dataURL' && !(fileData[property] && ko.isObservable(fileData[property]))) {
                    return true;
                }
                if (!file) {
                    return true;
                }
                var reader = new FileReader();
                reader.onload = function(e) {
                    if (fileData[property]) {
                        fileData[property](e.target.result);
                    }
                    if (method == 'readAsDataURL' && fileData.base64String && ko.isObservable(fileData.base64String)) {
                        var resultParts = e.target.result.split(",");
                        if (resultParts.length === 2) {
                            fileData.base64String(resultParts[1]);
                        }
                    }
                };

                reader[method](file);
            });
        }
    };

    ko.bindingHandlers.fileDrag = {
        update: function(element, valueAccessor, allBindingsAccessor) {
            var fileData = ko.utils.unwrapObservable(valueAccessor()) || {};

            if (!element.dataset.fileDragInjected) {
                element.classList.add('filedrag');
                element.ondragover = element.ondragleave = element.ondrop = function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    if(e.type == 'dragover'){
                        element.classList.add('hover');
                    }
                    else {
                        element.classList.remove('hover');
                    }
                    if (e.type == 'drop' && e.dataTransfer) {
                        var files = e.dataTransfer.files;
                        var file = files[0];
                        if (file) {
                            fileData.file(file);
                            if (ko.isObservable(valueAccessor())) {
                                valueAccessor()(fileData);
                            }
                        }
                    }
                };

                element.dataset.fileDragInjected = true;
            }
        }
    };

    ko.bindingHandlers.customFileInput = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            if (ko.utils.unwrapObservable(valueAccessor()) === false) {
                return;
            }
            //*
            var sysOpts = fileBindings.customFileInputSystemOptions;
            var defOpts = fileBindings.defaultOptions;

            var $element = $(element);
            var $wrapper = $('<span>').addClass(sysOpts.wrapperClass).addClass(defOpts.wrapperClass);
            var $buttonGroup = $('<span>').addClass(sysOpts.buttonGroupClass).addClass(defOpts.buttonGroupClass);
            $buttonGroup.append($('<span>').addClass(sysOpts.buttonClass));
            $element.wrap($wrapper).wrap($buttonGroup);
            var $buttonGroup = $element.parent('.' + sysOpts.buttonClass).parent();
            $buttonGroup.before($('<input>').attr('type', 'text').attr('disabled', 'disabled').addClass(sysOpts.fileNameClass));
            $element.before($('<span>').addClass(sysOpts.buttonTextClass));

        },
        update: function(element, valueAccessor, allBindingsAccessor) {
            var options = ko.utils.unwrapObservable(valueAccessor());
            if (options === false) {
                return;
            }
            options = options || {};
            if (options && typeof options !== 'object') {
                options = {};
            }

            var sysOpts = fileBindings.customFileInputSystemOptions;
            var defOpts = fileBindings.defaultOptions;

            options = $.extend(defOpts, options);

            var allBindings = allBindingsAccessor();
            if (!allBindings.fileInput) {
                return;
            }
            var fileData = ko.utils.unwrapObservable(allBindings.fileInput) || {};

            var file = ko.utils.unwrapObservable(fileData.file);

            var $button = $(element).parent();
            var $buttonGroup = $button.parent();

            var $wrapper = $buttonGroup.parent();
            $button.addClass(ko.utils.unwrapObservable(options.buttonClass));
            $button.find('.' + sysOpts.buttonTextClass)
                .html(ko.utils.unwrapObservable(file ? options.changeButtonText : options.buttonText));
            var $fileName = $wrapper.find('.' + sysOpts.fileNameClass);
            $fileName.addClass(ko.utils.unwrapObservable(options.fileNameClass));

            if (file && file.name) {
                $fileName.val(file.name);
            }
            else {
                $fileName.val(ko.utils.unwrapObservable(options.noFileText));
            }

            var $clearButton = $buttonGroup.find('.' + sysOpts.clearButtonClass);
            if (!$clearButton.length) {
                $clearButton = $('<span>').addClass(sysOpts.clearButtonClass);
                $clearButton.on('click', function(e) {
                    options.onClear(fileData, options);
                });
                $buttonGroup.append($clearButton);
            }
            $clearButton.html(ko.utils.unwrapObservable(options.clearButtonText));
            $clearButton.addClass(ko.utils.unwrapObservable(options.clearButtonClass));


            if (file && options.clearButton && file.name) {
//                $clearButton.show();
            }
            else {
                $clearButton.remove();
            }
        }
    };

    ko.fileBindings = fileBindings;
    return fileBindings;
}));

(function() {
    'use strict';
    ko.extenders.paging = function(target, pageSize) {
        var _pageSize = ko.observable(pageSize || 10),
        // default pageSize to 10
            _currentPage = ko.observable(1); // default current page to 1
        target.pageSize = ko.computed({
            read: _pageSize,
            write: function(newValue) {
                if (newValue > 0) {
                    _pageSize(newValue);
                }
                else {
                    _pageSize(10);
                }
            }
        });

        target.currentPage = ko.computed({
            read: _currentPage,
            write: function(newValue) {
                if (newValue > target.pageCount()) {
                    _currentPage(target.pageCount());
                }
                else if (newValue <= 0) {
                    _currentPage(1);
                }
                else {
                    _currentPage(newValue);
                }
            }
        });

        target.pageCount = ko.computed(function() {
            return Math.ceil(target().length / target.pageSize()) || 1;
        });

        target.currentPageData = ko.computed(function() {
            var pageSize = _pageSize(),
                pageIndex = _currentPage(),
                startIndex = pageSize * (pageIndex - 1),
                endIndex = pageSize * pageIndex;

            return target().slice(startIndex, endIndex);
        });

        target.moveFirst = function() {
            target.currentPage(1);
        };
        target.movePrevious = function() {
            target.currentPage(target.currentPage() - 1);
        };
        target.moveNext = function() {
            target.currentPage(target.currentPage() + 1);
        };
        target.moveLast = function() {
            target.currentPage(target.pageCount());
        };

        return target;
    };
}());

ko.bindingHandlers.typeahead =
{
    init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        var $element = $(element);
        var allBindings = allBindingsAccessor();
        var url = ko.unwrap(valueAccessor().url);
        var data = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('area'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            limit: 10,
            remote: url+'?q=%QUERY'
        });
        data.initialize();
        $(element).typeahead(null, {
            name: 'deliveryArea',
            displayKey: 'area',
            source: data.ttAdapter()

        }).bind("typeahead:selected", function(obj, datum, name) {
            var id=obj.currentTarget.id.split('_')[2];
            viewModel.area(datum.area);
            viewModel.pincode(datum.area_pincode);
            viewModel.city(datum.city_id);
            console.log(ko.toJSON(viewModel));
        });
    },
    update: function(element, valueAccessor, allBindings) {
        ko.bindingHandlers.value.update(element, valueAccessor);
    }
};

ko.bindingHandlers.addressAutocomplete = {
    init: function (element, valueAccessor, allBindingsAccessor) {
        var value = valueAccessor(),
            allBindings = allBindingsAccessor();

        var options = {
            componentRestrictions: {country: "in"}
        };
        ko.utils.extend(options, allBindings.autocompleteOptions)

        var autocomplete = new google.maps.places.Autocomplete(element, options);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            result = autocomplete.getPlace();
            console.log(result);
        });
    },
    update: function (element, valueAccessor, allBindingsAccessor) {
        ko.bindingHandlers.value.update(element, valueAccessor);
    }
};
ko.bindingHandlers.chosen = {
    listenBindings: ['value', 'disable', 'options', 'foreach'],
    init: function( element, valueAccessor, allBindings ) {
        var options = ko.unwrap(valueAccessor()), $_ = $(element);
        $_.chosen( $.extend( options, {
            width: '100%'
        } ) );

        ko.computed(function() {
            $.each(ko.bindingHandlers.chosen.listenBindings, function( i, binding ) {
                var b = allBindings.get(binding);
                b = $.isFunction(b) ? b() : b;
                ko.unwrap(b);

                $_.trigger('chosen:updated');
            } );

        }, null, { disposeWhenNodeIsRemoved: element });

        ko.utils.domNodeDisposal.addDisposeCallback(element, function(node) {
            $(node).chosen('destroy');
        });
    }
};
ko.bindingHandlers.timePicker = {
    init: function(element, valueAccessor) {
        var options = ko.unwrap(valueAccessor());
        $(element).timepicker(options);
    },
    update: function(element, valueAccessor, allBindings) {
        ko.bindingHandlers.value.update(element, valueAccessor);
    }
};

ko.bindingHandlers.datePicker = {
    init: function(element, valueAccessor) {
        var options = ko.unwrap(valueAccessor());
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
         $(element).datepicker({
             format:'yyyy-mm-dd',
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        });
        //handle the field changing
        ko.utils.registerEventHandler(element, "changeDate", function () {
            var observable = valueAccessor();
            var widget = $(element).data("datepicker");
            observable(formatDatePicker(widget.date));
        });

    },
    update: function(element, valueAccessor, allBindings) {
        ko.bindingHandlers.value.update(element, valueAccessor);
    }
};
ko.bindingHandlers.bootstrapSwitch = {
    init: function (element, valueAccessor, allBindingsAccessor) {
        //initialize bootstrapSwitch
        $(element).bootstrapSwitch();

        // setting initial value
        $(element).bootstrapSwitch('state', valueAccessor()());

        //handle the field changing
        $(element).on('switchChange.bootstrapSwitch', function (event, state) {
            var observable = valueAccessor();
            observable(state);
        });

        // Adding component options
        var options = allBindingsAccessor().bootstrapSwitchOptions || {};
        for (var property in options) {
            $(element).bootstrapSwitch(property, ko.utils.unwrapObservable(options[property]));
        }

        //handle disposal (if KO removes by the template binding)
        ko.utils.domNodeDisposal.addDisposeCallback(element, function () {
            $(element).bootstrapSwitch("destroy");
        });

    },
    //update the control when the view model changes
    update: function (element, valueAccessor, allBindingsAccessor) {
        var value = ko.utils.unwrapObservable(valueAccessor());

        // Adding component options
        var options = allBindingsAccessor().bootstrapSwitchOptions || {};
        for (var property in options) {
            $(element).bootstrapSwitch(property, ko.utils.unwrapObservable(options[property]));
        }

        $(element).bootstrapSwitch("state", value);
    }
};
function formatDatePicker(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

ko.numericObservable = function(initialValue) {
    var _actual = ko.observable(initialValue);

    var result = ko.dependentObservable({
        read: function() {
            return _actual();
        },
        write: function(newValue) {
            var parsedValue = parseFloat(newValue);
            _actual(isNaN(parsedValue ) ? newValue: parsedValue);
        }
    });

    return result;
};
var reset = function ( obj, whitelist ) {
    for ( var prop in obj ) {
        if ( obj.hasOwnProperty( prop ) && ko.isObservable( obj[ prop ] ) && whitelist.indexOf( prop ) === -1 ) {
            obj[ prop ]( undefined );
        }
    }
};

function formatDate(date) {
       if(date==null){
           return;
       }
        var d = new Date("2000-01-01 " + date);
        var hh = d.getHours();
        var m = d.getMinutes();
        var s = d.getSeconds();
        var dd = "am";
        var h = hh;
        if (h >= 12) {
            h = hh - 12;
            dd = "pm";
        }
        if (h == 0) {
            h = 12;
        }
        m = m < 10 ? "0" + m : m;

        s = s < 10 ? "0" + s : s;
        var pattern = new RegExp("0?" + hh + ":" + m + ":" + s);

        var replacement = h + ":" + m;
        /* if you want to add seconds
         replacement += ":"+s;  */
        replacement += dd;
        return date.replace(pattern, replacement);
}
/*
Knockout Validation Custom Rules
 */
ko.validation.rules['imgtype'] = {
    validator: function (val,validate) {
        var file =val;
        if (!validate) { return true; }
        var extension = file.name.substr((file.name.lastIndexOf('.') + 1));
        var flag;

        switch (extension.toLowerCase()) {
            case 'jpg':
            case 'png':
            case 'gif':
                flag = true;
                break;
            default:
                flag = false;
        }
        return flag;
    },
    message: 'You can upload only jpg,png,gif extension file'
};
ko.validation.registerExtenders();