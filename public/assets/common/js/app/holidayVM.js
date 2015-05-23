
function holiday()
{
    var self = this;
    self.id =ko.observable('');
    self.business_info_id=ko.observable('');
    self.title = ko.observable('');
    self.holiday_reason=  ko.observable('');
    self.holiday_date = ko.observable('');
    self.start_time =ko.observable();
    self.end_time =ko.observable();
}
var validationMapping={

}
function holidayVM(initialData,url){
    var self = this;
    window.viewModel = self;
    ko.validatedObservable(ko.mapping.fromJS(initialData,validationMapping,self));
    self.list = ko.observableArray(initialData);
    self.pageSize = ko.observable(10);
    self.pageIndex = ko.observable(0);
    self.selectedItem = ko.observable();
    self.saveUrl = url;
    self.deleteUrl = url;
    self.edit = function (item) {
        self.selectedItem(item);
    };
    self.cancel = function () {
        self.selectedItem(null);
    };
    self.add = function () {
        var newItem = new holiday();
        self.list.push(newItem);
        self.selectedItem(newItem);
        self.moveToPage(self.maxPageIndex());
    };
    self.remove = function (item) {
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
        var item = self.selectedItem();
        $.post(self.saveUrl, item, function (result) {
            self.selectedItem().id(result);
            self.selectedItem(null);
        });

    };

    self.templateToUse = function (item) {
        return self.selectedItem() === item ? 'editTmpl' : 'itemsTmpl';
    };

    self.pagedList = ko.dependentObservable(function () {
        var size = self.pageSize();
        var start = self.pageIndex() * size;
        return self.list.slice(start, start + size);
    });
    self.maxPageIndex = ko.dependentObservable(function () {
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
    self.allPages = ko.dependentObservable(function () {
        var pages = [];
        for (i = 0; i <= self.maxPageIndex() ; i++) {
            pages.push({ pageNumber: (i + 1) });
        }
        return pages;
    });
    self.moveToPage = function (index) {
        self.pageIndex(index);
    };


}
