ko.validation.init({insertMessages: true,
    grouping: { deep: true } },true);
function holiday()
{
    var self = this;
    self.id =ko.observable('');
    self.business_info_id=ko.observable('');
    self.title = ko.observable('').extend({required: true});
    self.holiday_reason=  ko.observable('').extend({required: true});
    self.holiday_date = ko.observable('').extend({required: true});
    self.start_time =ko.observable('');
    self.end_time =ko.observable('');
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
            id:ko.observable(holiday.id),
            business_info_id:ko.observable(holiday.business_info_id),
            title : ko.observable(holiday.title).extend({required: true}),
            holiday_reason:  ko.observable(holiday.holiday_reason).extend({required: true}),
            holiday_date : ko.observable(holiday.holiday_date).extend({required: true}),
            start_time :ko.observable(self.formatDate(holiday.start_time)),
            end_time :ko.observable(self.formatDate(holiday.end_time))
        })
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
    self.cancel = function () {
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
        console.log(self.errors());
        if (self.errors().length === 0) {
            var item = self.selectedItem();
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
