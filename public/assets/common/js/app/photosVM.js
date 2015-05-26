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

    }
}
photosVM.onClear = function(item){
    item.fileData().clear();
};
photosVM.error=ko.validation.group(photosVM);

ko.applyBindings(photosVM,document.getElementById("photo"));