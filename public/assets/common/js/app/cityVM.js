ko.validation.init({insertMessages: false,
    parseInputAttributes: true,
    grouping: { deep: true } },true);

var states={

}
ko.bindingHandlers.placeaddressAutocomplete = {
    init: function (element, valueAccessor, allBindingsAccessor,viewModel) {
        var value = valueAccessor(),
            allBindings = allBindingsAccessor();
        console.log(allBindings.states);
        var states =ko.unwrap(allBindings.states) || {};
        console.log(states);
        var options = {
            types: ['(cities)'],
            componentRestrictions: {
                country: "in"
            }
        };
        ko.utils.extend(options, allBindings.autocompleteOptions)

        var autocomplete = new google.maps.places.Autocomplete(element, options);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            var name =  place.address_components[0].short_name;
            var $locality ;
            var $region;
            var $html = $.parseHTML((place.adr_address).replace(/,/g , ""));
            $.each( $html, function( i, el ) {
                if($(el).hasClass('locality')){
                    $locality = $(el).html();
                }
                if($(el).hasClass('region')){
                    $region = $(el).html();
                }
            });
            value($locality);
            console.log(viewModel);
            viewModel.city_description($locality);
            viewModel.city_code(name.toUpperCase());
            var state_id = ko.utils.arrayFilter(states, function(item) {

                return item.state_description.replace(/ /g, '').toLocaleLowerCase() == $region.replace(/ /g, '').toLocaleLowerCase();
            });
            if(state_id==undefined || state_id.length==0){
                viewModel.state_id(-1);
                viewModel.state(undefined);
            }else {
                viewModel.state(state_id[0]);
                viewModel.state_id(state_id[0].id);

            }
        });
    },
    update: function (element, valueAccessor, allBindingsAccessor) {
        ko.bindingHandlers.value.update(element, valueAccessor);
    }
};


var City = function(data) {
    var self = this;
    self.id =ko.observable();
    self.state_id=ko.observable().extend({required:true,notEqual:-1});
    self.city_code = ko.observable().extend({required:true});
    self.city_description=  ko.observable().extend({required: true});
    self.city_status = ko.observable();
    self.state = ko.observable();
    self.errors=ko.validation.group(self);
    //populate our model with the initial data
    self.update(data);
};

//can pass fresh data to this function at anytime to apply updates or revert to a prior version
City.prototype.update = function(data) {
    var self = this;
    self.id =ko.observable(data.id || -1);
    self.state_id=ko.observable(data.state_id).extend({required:true,notEqual:-1});
    self.city_code = ko.observable(data.city_code).extend({required:true});
    self.city_description=  ko.observable(data.city_description).extend({required:true});
    self.city_status = ko.observable(data.city_status);
    self.state=ko.observable(data.state || undefined);
};

var CityVM = function() {
    var self=this;
    //turn the raw items into Item objects
    self.cityItems = ko.observableArray();
    self.stateItems = ko.observableArray();
    self.isAddnew=ko.observable(false);
    self.isErrorAjax = ko.observable(false);
    self.remove=function(item){
        self.cityItems.remove(item);
    }
    self.panelToggle=function(model,event){
        $(event.target).parent().next().toggle('slow',function(){
            if($(this).is(':visible')){
                getCity(self);
                $(event.target).removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
            }
            else{
                $(event.target).addClass('fa-chevron-circle-down').removeClass('fa-chevron-circle-up');
            }
        });

        return true;
    };
    //hold the currently selected item
    self.selectedItem = ko.observable();
    self.pageSize = ko.observable(5);
    self.pageIndex = ko.observable(0);
    //make edits to a copy
    self.itemForEditing = ko.observable();
    self.templateToUse = function (item) {
        return self.selectedItem() === item ? 'editTmpl' : 'itemsTmpl';
    };
    self.post =function(data){
        postCity(ko.toJSON(data),self);
    }
    self.add =function(){
        self.isAddnew(true);
        var item=new City({
            id:-1,
            state_id:-1,
            city_code:'',
            city_description:'',
            city_status:''
        });
        self.moveToPage(self.lastIndex().pageNumber-1);
        self.cityItems.push(item) ;
        self.selectedItem(item);
        self.itemForEditing(new City(ko.toJS(item)));
    };
    self.pagedList = ko.computed(function () {
        var size = self.pageSize();
        var start = self.pageIndex() * size;
        return self.cityItems.slice(start, start + size);
    });
    self.maxPageIndex = ko.computed(function () {
        return Math.ceil(self.cityItems().length / self.pageSize()) - 1;
    });
    self.previousPage = function () {
        if (self.pageIndex() > 0) {
            self.pageIndex(self.pageIndex() - 1);
        }
    };
    self.nextPage = function () {
        if (self.pageIndex() < self.maxPageIndex()) {
            self.pageIndex(self.pageIndex() + 1);
        }
    };
    self.allPages = ko.computed(function () {
        var pages = [];
        for (i = 0; i <= self.maxPageIndex() ; i++) {
            pages.push({ pageNumber: (i + 1) });
        }
        return pages;
    });
    self.lastIndex =ko.computed(function(){
        return self.allPages()[self.allPages().length-1];
    });
    self.moveToPage = function (index) {
        self.pageIndex(index);
    };
    self.selectItem = self.selectItem.bind(self);
    self.acceptItem = self.acceptItem.bind(self);
    self.revertItem = self.revertItem.bind(self);

};

ko.utils.extend(CityVM.prototype, {
    //select an item and make a copy of it for editing
    selectItem: function(item) {
        this.isAddnew(false);
        this.selectedItem(item);
        this.itemForEditing(new City(ko.toJS(item)));
    },

    acceptItem: function(item) {
        if(item.errors().length==0) {
            var selected = this.selectedItem(),
                edited = ko.toJS(this.itemForEditing());
            selected.update(edited);
            this.post(edited);
            console.log(this.isErrorAjax());
            if(this.isErrorAjax()) {
                this.selectedItem(null);
                this.itemForEditing(null);
            }
        }
        else{
            item.errors.showAllMessages();
        }
    },

    //just throw away the edited item and clear the selected observables
    revertItem: function() {
        this.selectedItem(null);
        this.itemForEditing(null);
    }
});

ko.applyBindings(new CityVM(), $('#city-panel')[0]);