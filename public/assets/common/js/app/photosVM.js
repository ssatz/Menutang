/**
 * Created by Satz on 5/26/2015.
 */

ko.validation.init({insertMessages: true,
    grouping: { deep: true } },true);


var photosVM ={
    addPhotos:function(){
        $('#photoModal').modal('show');
    },
    fileData:ko.observable({
        file: ko.observable().extend({required:true}),
        dataURL: ko.observable().extend({required:true})
    })
}
photosVM.onClear = function(item){
    item.fileData().clear();
};

ko.applyBindings(photosVM,document.getElementById("photo"));