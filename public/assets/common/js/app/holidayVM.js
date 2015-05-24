ko.validation.init({insertMessages: true,
    grouping: { deep: true } },true);
function holiday()
{
    var self = this;
    self.id =ko.observable('').extend({
    protected: true
    });
    self.business_info_id=ko.observable('').extend({
    protected: true
    });
    self.title = ko.observable('').extend({required: true, protected: true});
    self.holiday_reason=  ko.observable('').extend({required: true, protected: true});
    self.holiday_date = ko.observable('').extend({required: true, protected: true});
    self.start_time =ko.observable('').extend({
        protected: true
    });
    self.end_time =ko.observable('').extend({
        protected: true
    });
}


function holidayVM(initialData,url){

    var self = this;
    window.viewModel = self;
    self.list = ko.observableArray();
    self.formatDate =function(data){
        if(ko.toJS(data)=='') {
            return data;
        }
        return formatDate(data);
    };
    ko.utils.arrayForEach(initialData, function(holiday) {
        self.list.push({
            id:ko.observable(holiday.id).extend({
                protected: true
            }),
            business_info_id:ko.observable(holiday.business_info_id).extend({
                protected: true
            }),
            title : ko.observable(holiday.title).extend({required: true,protected:true}),
            holiday_reason:  ko.observable(holiday.holiday_reason).extend({required: true,protected:true}),
            holiday_date : ko.observable(holiday.holiday_date).extend({required: true,protected:true}),
            start_time :ko.observable(self.formatDate(holiday.start_time)).extend({
                protected: true
            }),
            end_time :ko.observable(self.formatDate(holiday.end_time)).extend({
                protected: true
            })
        });
    });
    self.pageSize = ko.observable(10);
    self.pageIndex = ko.observable(0);
    self.selectedItem = ko.observable();
    self.isAdd =ko.observable(false);
    self.isEdit=ko.observable(false);
    self.saveUrl = url;
    self.deleteUrl = url;
    self.edit = function (item) {
        self.isEdit(true);
        self.selectedItem(item);
    };
    self.cancel = function (item) {
        item.id.reset();
        item.title.reset();
        item.business_info_id.reset();
        item.title.reset();
        item.holiday_date.reset();
        item.holiday_reason.reset();
        item.start_time.reset();
        item.end_time.reset();
        self.selectedItem(null);
    };
    self.add = function () {
        var newItem = new holiday();
        self.isAdd(true);
        self.isEdit(false);
        self.list.push(newItem);
        self.selectedItem(newItem);
        self.moveToPage(self.maxPageIndex());
    };
    self.remove = function (item) {
        self.isAdd(false);
        if (item.id) {
            if (confirm('Are you sure you wish to delete this item?')) {
                $.post(self.deleteUrl, item).complete(function (result) {
                    self.list.remove(item);
                    if (self.pageIndex() > self.maxPageIndex()) {
                        self.moveToPage(self.maxPageIndex());
                    }
                });
            }
        }
        else {
            self.list.remove(item);
            if (self.pageIndex() > self.maxPageIndex()) {
                self.moveToPage(self.maxPageIndex());
            }
        }
    };
    self.save = function () {
        if (self.errors().length === 0) {
            self.selectedItem().id.commit();
            self.selectedItem().title.commit();
            self.selectedItem().business_info_id.commit();
            self.selectedItem().title.commit();
            self.selectedItem().holiday_date.commit();
            self.selectedItem().holiday_reason.commit();
            self.selectedItem().start_time.commit();
            self.selectedItem().end_time.commit();
            var item = self.selectedItem();
            console.log(ko.toJS(item));
            $.post(self.saveUrl, item, function (result) {
                self.selectedItem().id(result);
                self.selectedItem(null);
            });
        }
        else {
            self.errors.showAllMessages();
        }
    };

    self.templateToUse = function (item) {
        return self.selectedItem() === item ? 'editTmpl' : 'itemsTmpl';
    };

    self.pagedList = ko.computed(function () {
        var size = self.pageSize();
        var start = self.pageIndex() * size;
        return self.list.slice(start, start + size);
    });
    self.maxPageIndex = ko.computed(function () {
        return Math.ceil(self.list().length / self.pageSize()) - 1;
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
    self.errors = ko.validation.group(self,{deep:true});
}
