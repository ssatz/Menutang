/**
 * Created by satz on 4/9/2015.
 */
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
ko.validation.init({insertMessages: false});
ko.validation.init( { grouping: { deep: true } } )
var businessVM = {
    businessName : ko.observable('').extend({ required: true,
                                                pattern: {
                                                    message: 'Hey this is not a valid Business Name',
                                                    params: '^[a-zA-Z0-9_ ]*$'
                                                }
                                            }),
    businessType : ko.observable(-1).extend({ required: true,
                                                notEqual:-1
                                            }),
    cuisineType  :ko.observable('').extend({ required: true,
                                                notEqual:-1
                                            }),
    status : ko.observable('').extend({ required: true,
        notEqual:-1
    }),
    businessUser : ko.observable(''),
    budget:ko.observable('').extend({required:true,number: true }),
    parcelCharges:ko.observable(0).extend({required:true,number: true }),
    doorDelivery:ko.observable('').extend({required:true}),
    deliveryFee :ko.observable(0).extend({number: true}),
    railDelivery:ko.observable('').extend({required:true}),
    pickupAvailable:ko.observable('').extend({required:true}),
    outdoorCatering:ko.observable('').extend({required:true}),
    partyHall :ko.observable('').extend({required:true}),
    buffet:ko.observable('').extend({required:true}),
    midnightBuffet:ko.observable('').extend({required:true}),
    wifi:ko.observable('').extend({required:true}),
    childrenPlayArea:ko.observable('').extend({required:true}),
    gardenRestaurant:ko.observable('').extend({required:true}),
    roofTop:ko.observable('').extend({required:true}),
    valetParking:ko.observable('').extend({required:true}),
    boarding:ko.observable('').extend({required:true}),
    barAttached:ko.observable('').extend({required:true}),
    highwayRestaurant:ko.observable('').extend({required:true}),
    website:ko.observable('').extend({ pattern: {params:'^(www.)([a-zA-Z0-9]*).([a-z]*)$',message:'Invalid format'}}),
    aboutBusiness:ko.observable(''),
    checkOutEnable:ko.observable('').extend({required:true}),
    avgDeliveryTime:ko.observable('').extend({ required: true,
                                                    pattern: {
                                                        message: 'Hey this is not a valid time format, format:00:00:00',
                                                        params: '([0-9][0-9]:[0-9][0-9]:[0-9][0-9])'
                                                    }
    }),
    city:ko.observable('').extend({required:true,notEqual:-1}),
    businessAddress1:ko.observable('').extend({required:true}),
    businessAddress2:ko.observable(''),
    businessLandmark:ko.observable(''),
    gpsLocation :ko.observable(''),
    postalCode :ko.observable('').extend({
        required: true,
        pattern: {
            message: 'Hey postal code should have only 6 digits',
            params: '^([1-9])([0-9]){5}$'
        }
    }),
    businessMobile:ko.observable().extend({
        required: true,
        pattern: {
            message: 'Hey this is not a valid mobile no',
            params: '^[7-9][0-9]{9}$'
        }
    }),
    timeDay:ko.observableArray().extend({required:{
        params:true,
        message: 'At least one of the Time need to be Selected'
    }}),
    time:ko.observableArray(),
    day:ko.observableArray(),
    cuisines:ko.observableArray(),
    cuisinesData:ko.observableArray(),
    payments:ko.observableArray().extend({required:true}),
    addDeliveryArea:function(model,event){
        businessVM.deliveryArea.push({
            area:ko.observable().extend({required:{ onlyIf:function(){
                if(businessVM.doorDelivery()=='true'){
                    return true;
                }

            }
            }}),
            pincode:ko.observable().extend({
                required: { onlyIf:function(){
                    if(businessVM.doorDelivery()=='true'){
                        return true;
                    }

                }
                },
                pattern: {
                    message: 'should have only 6 digits',
                    params: '^([1-9])([0-9]){5}$'
                }
            }),
            city:ko.observable(-1).extend({required:true,notEqual:-1})
        });
        return true;
    },
    removeDeliveryArea:function(model,event)
    {
        businessVM.deliveryArea.remove(model);
        return true;
    },
    removeImage:function(data){
       businessVM.imageFile('');
       businessVM.imageObjectURL('');
       businessVM.imageBinary('');
    },
    addTime: function (model) {
        if(model.check() ) {
            businessVM.timeDay.remove(model);
            businessVM.timeDay.push(model);
        }
        else{
            businessVM.timeDay.remove(model);
        }
        console.log(ko.toJSON(businessVM.timeDay));
        return true;
    },
    radioClick:function(data,event)
    {   $(event.target).closest(".form-group").find('.label-radio').removeClass('badge badge-success').addClass('badge badge-info');
        $(event.target).parent().removeClass('badge badge-info').addClass('badge badge-success');
    },
    submit: function() {
        if (businessVM.errors().length === 0) {
            postAjax(ko.toJSON(businessVM));
        }
        else {
            businessVM.errors.showAllMessages(true);
            notification('Error','Please fix errors before submit','gritter-danger');
        }
    }
}
businessVM.businessType.subscribe(function(model){
    businessVM.cuisinesData([]);
    ko.utils.arrayForEach(businessVM.cuisines(), function(cu) {
        if(cu.business_type_id == ko.toJS(parseInt(model)))
        {
            businessVM.cuisinesData.push(cu);
        }
    });
});
businessVM.minimumDeliveryAmount=ko.observable(0).extend({ required: { onlyIf: function() {
    if(businessVM.doorDelivery()==='true' )
    {
        return true;
    }
} } });
businessVM.deliveryArea=ko.observableArray([{
    area:ko.observable(undefined).extend({required:{ onlyIf:function(){
        if(businessVM.doorDelivery()=='true'){
            return true;
        }
        return false;
    }
    }}),
    pincode:ko.observable(undefined).extend({
        required: { onlyIf:function(){
            if(businessVM.doorDelivery()=='true'){
                return true;
            }

        }
        },
        pattern: {
            message: 'should have only 6 digits',
            params: '^([1-9])([0-9]){5}$'
        }
    }),
    city:ko.observable(undefined).extend({required:{ onlyIf:function(){
        if(businessVM.doorDelivery()=='true'){
            return true;
        }

    }
    },notEqual:-1})
}]).extend({required:{ onlyIf:function(){
 if(businessVM.doorDelivery()=='true'){
     return true;
 }

}
}});
businessVM.minimumRailDeliveryAmount=ko.observable(0).extend({ required: { onlyIf: function() {
    if(businessVM.railDelivery()==='true' )
    {
        return true;
    }
} } });
businessVM.minimumPickupAmount=ko.observable(0).extend({ required: { onlyIf: function() {
    if(businessVM.pickupAvailable()==='true' )
    {
        return true;
    }
} } });
businessVM.outdoorCateringComments=ko.observable();
businessVM.partyHallComments=ko.observable();
businessVM.boardingComments=ko.observable();
businessVM.highwayRestaurantDetails=ko.observable();
businessVM.isdeliveryEnable= ko.observable(function () {
    if(businessVM.doorDelivery()=='true'){
        return true;
    }
   return businessVM.deliveryArea([]);
});
businessVM.fileData = ko.observable({
    file: ko.observable().extend({required:true}),
    dataURL: ko.observable().extend({required:true})
}).extend({required:true});
ko.components.register('timehr-template', {
    viewModel: function(params) {
        var self=this;
        self.check =ko.observable(false);
        self.timeCategory = ko.observable(params.timeCategory || '');
        self.day =ko.observableArray([1,2,3,4,5,6,7]);
        self.dayCheck=function(model,event)
        {
          if($(event.target).is(':checked'))
          {
              self.day.push(model.id);
          }
          else{
              self.day.remove(model.id);
          }
            if (self.errors().length === 0) {
                self.Callback(self);
            }
            else {
                self.errors.showAllMessages();
            }
            return true;
        }
        self.openTime=ko.observable(params.openTime || '').extend({ required: { onlyIf: function() {
            if(self.check()==true )
            {
                return true;
            }
        } } });
        self.closeTime=ko.observable(params.closeTime || '').extend({ required: { onlyIf: function() {
            if(self.check()==true )
            {
                return true;
            }
        } } });
        self.category=ko.observable(params.category || '');
        self.Callback = params.callback
        self.submit = function(model, event) {
            if(self.check()) {
                $(event.target).parent().removeClass('badge-danger').addClass('badge-success');
            }
            else{
                $(event.target).parent().addClass('badge-danger').removeClass('badge-success');
            }
            if (self.errors().length === 0) {
                self.Callback(self);
            }
            else {
                self.errors.showAllMessages();
            }
            return true;
        };
       self.errors= ko.validation.group(self);
    },
    template:         '<div class="form-group">'+
                    '<label class="badge badge-danger label-checkbox inline">'+
                        '<input type="checkbox"  data-bind="checked:check,value:timeCategory,click:submit"/>'+
                            '<span class="custom-checkbox"></span>'+
                                '<!-- ko text:category --><!--/ko-->'+
                    '</label></div>'+
                    '<div class="form-group">'+
                    '<label for="openTime">Open Time</label>'+
                        '<input type="text" data-bind="timePicker,value:openTime,event: { focusout: submit}" class="form-control input-sm">'+
                        '<p class="validationMessage" data-bind="validationMessage: openTime"></p>'+
                    '</div>'+
                    '<div class="form-group">'+
                    '<label for="closeTime">Close Time</label>'+
                        '<input type="text" data-bind="timePicker,value:closeTime,event: { focusout: submit}" class="form-control input-sm">'+
                        '<p class="validationMessage" data-bind="validationMessage: closeTime"></p>'+
                    '</div>' +
                    '<!--ko foreach:$root.day -->'+
                    '<label class="badge badge-info label-checkbox inline">'+
                    '<input type="checkbox" checked="checked" data-bind="click:$parent.dayCheck,value:id"/>'+
                    '<span class="custom-checkbox"></span>'+
                    '<!-- ko text:day --><!--/ko-->'+
                    '</label><!--/ko-->' +
                    '</div>'+
                    '<hr>'

});

businessVM.errors = ko.validation.group(businessVM,{deep:true});
ko.applyBindings(businessVM);
