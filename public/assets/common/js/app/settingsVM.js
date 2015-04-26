/**
 * Created by satz on 4/25/2015.
 */
function businessType(data){
    var self=this;
    self.id=ko.observable(data.id);
    self.business_type = ko.observable(data.business_type);
    self.business_code = ko.observable(data.business_code);
    self.isEdit=ko.observable(false);
}
//wrapper for an observable that protects value until committed
ko.protectedObservable = function(initialValue) {
    //private variables
    var _temp = initialValue;
    var _actual = ko.observable(initialValue);

    var result = ko.observable({
        read: _actual,
        write: function(newValue) {
            _temp = newValue;
        }
    }).extend({ notify: "always" }); //needed in KO 3.0+ for reset, as computeds no longer notify when value is the same

    //commit the temporary value to our observable, if it is different
    result.commit = function() {
        if (_temp !== _actual()) {
            _actual(_temp);
        }
    };

    //notify subscribers to update their value with the original
    result.reset = function() {
        _actual.valueHasMutated();
        _temp = _actual();
    };

    return result;
};
var settingsVM=function(){
    var self=this;
    self.panelToggle=function(model,event){
        $(event.target).parent().next().toggle('slow',function(){
            if($(this).is(':visible')){
                $(event.target).removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
            }
            else{
                $(event.target).addClass('fa-chevron-circle-down').removeClass('fa-chevron-circle-up');
            }
        });

        return true;
    },
    self.businessType=ko.observableArray().extend({
        paging: 5
    });
    self.selectedBuItem=ko.protectedObservable();

    //notify subscribers to update their value with the original
    self.selectedBuItem.reset = function() {
        _actual.valueHasMutated();
        _temp = _actual();
    };
    self.selectedBusinessType=ko.observable();
    self.editItem = function (item) {
        self.selectedBuItem(item);
        item.isEdit(true);
    };
    self.cancelEdit = function (item) {
        item.id(ko.toJS(self.selectedBuItem().id));
        item.business_type(ko.toJS(self.selectedBuItem().business_type));
        item.business_code(ko.toJS(self.selectedBuItem().business_code));
        item.isEdit(false);
    };
    self.applyEdit = function (item) {
        item.isEdit(false);
    };
}
var viewModel = new settingsVM();
ko.applyBindings(viewModel,$('#panels')[0]);



