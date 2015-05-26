/**
 * Created by Satz on 5/26/2015.
 */
ko.validation.init({insertMessages: true,
    grouping: { deep: true } },true);
var photosVM ={
    isLoading:ko.observable(true),
    addPhotos:function(){
        $('#photoModal').modal('show');
    },
    image:ko.observableArray(),
    fileData:ko.observable({
        file: ko.observable().extend({required:true,imgtype:true}),
        dataURL: ko.observable().extend({required:true})
    }),
    submit:function(item){
        console.log(photosVM.error());
       if(photosVM.error().length==0) {
           postAjax(ko.toJSON(item.fileData()), addPhotos);
           $('#photoModal').modal('hide');
           item.fileData().clear();
           return;
       }
    },
    delete: function (item) {
        postAjax(ko.toJSON(item), deletePhotos);
        return;
    }
}
photosVM.onClear = function(item){
    item.fileData().clear();
};
photosVM.error=ko.validation.group(photosVM);
photosVM.pageSize= ko.observable(5);
photosVM.pageIndex =ko.observable(0);
photosVM.pagedList = ko.computed(function () {
    var size = photosVM.pageSize();
    var start = photosVM.pageIndex() * size;
    return photosVM.image().slice(start, start + size);
});
photosVM.maxPageIndex = ko.computed(function () {
    return Math.ceil(photosVM.image().length / photosVM.pageSize()) - 1;
});
    photosVM.previousPage = function () {
    if (photosVM.pageIndex() > 0) {
        photosVM.pageIndex(pageIndex() - 1);
    }
};
photosVM.nextPage = function () {
    if (photosVM.pageIndex() < photosVM.maxPageIndex()) {
        photosVM.pageIndex(pageIndex() + 1);
    }
};
photosVM.allPages = ko.computed(function () {
    var pages = [];
    for (i = 0; i <= photosVM.maxPageIndex() ; i++) {
        pages.push({ pageNumber: (i + 1) });
    }
    return pages;
});
photosVM.moveToPage = function (index) {
    photosVM.pageIndex(index);
}
ko.applyBindings(photosVM,document.getElementById("photo"));