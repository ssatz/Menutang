ko.validation.init({insertMessages: true,
    parseInputAttributes: true,
    grouping: { deep: true } },true);

var Holiday = function(data) {
    var self = this;
    self.id =ko.observable();
    self.business_info_id=ko.observable();
    self.title = ko.observable().extend({required:true});
    self.holiday_reason=  ko.observable().extend({required: true});
    self.holiday_date = ko.observable().extend({required: true});
    self.start_time =ko.observable();
    self.end_time =ko.observable();
    self.errors=ko.validation.group(self);
    //populate our model with the initial data
    self.update(data);
};

//can pass fresh data to this function at anytime to apply updates or revert to a prior version
Holiday.prototype.update = function(data) {
    var self = this;
    self.formatDate =function(date){
        var expression = new RegExp(/^((([1-9])|(1[0-2])):([0-5])(0|5)(a|p)m)$/);
        var result = expression.test(date);
        if(result || date==undefined) {
            return date;
        }
        return formatDate(date);
    };
    self.id =ko.observable(data.id || -1);
    self.business_info_id=ko.observable(data.business_info_id || -1);
    self.title = ko.observable(data.title|| '');
    self.holiday_reason=  ko.observable(data.holiday_reason || '');
    self.holiday_date = ko.observable(data.holiday_date || '');
    self.start_time =ko.observable(formatDate(data.start_time) || '');
    self.end_time =ko.observable(formatDate(data.end_time) || '');
};

var HolidayVM = function(items) {
    var self=this;
    //turn the raw items into Item objects
    self.holidayItems = ko.observableArray(ko.utils.arrayMap(items, function(data) {
        return new Holiday(data);
    }));

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
        postAjax(ko.toJSON(data),update,self);
    }
    self.add =function(){
       var item=new Holiday({
           id:-1,
           business_info_id:-1,
           title:'',
           holiday_reason:'',
           holiday_date:'',
           start_time:'',
           end_time:''
       });
      self.holidayItems.push(item) ;
        self.selectedItem(item);
        self.itemForEditing(new Holiday(ko.toJS(item)));
    };
    self.remove=function(item){
        self.holidayItems.remove(item);
        postAjax(ko.toJSON(item),deleteHoliday,self);
    }
    self.pagedList = ko.computed(function () {
        var size = self.pageSize();
        var start = self.pageIndex() * size;
        return self.holidayItems.slice(start, start + size);
    });
    self.maxPageIndex = ko.computed(function () {
        return Math.ceil(self.holidayItems().length / self.pageSize()) - 1;
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
    self.moveToPage = function (index) {
        self.pageIndex(index);
    };
    self.selectItem = self.selectItem.bind(self);
    self.acceptItem = self.acceptItem.bind(self);
    self.revertItem = self.revertItem.bind(self);

};

ko.utils.extend(HolidayVM.prototype, {
    //select an item and make a copy of it for editing
    selectItem: function(item) {
        this.selectedItem(item);
        this.itemForEditing(new Holiday(ko.toJS(item)));
    },

    acceptItem: function(item) {
        if(item.errors().length==0) {
            var selected = this.selectedItem(),
                edited = ko.toJS(this.itemForEditing());
                selected.update(edited);
            this.post(edited);
            this.selectedItem(null);
            this.itemForEditing(null);
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

