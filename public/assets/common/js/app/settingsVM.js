/**
 * Created by satz on 4/25/2015.
 */
ko.protectedObservable = function(initialValue) {
    //private variables
    var _temp = initialValue;
    var _actual = ko.observable(initialValue);

    var result = ko.dependentObservable({
        read: _actual,
        write: function(newValue) {
            _temp = newValue;
        }
    }).extend({ notify: "always"}); //needed in KO 3.0+ for reset, as computeds no longer notify when value is the same

    //commit the temporary value to our observable, if it is different
    result.commit = function() {
        if (_temp !== _actual()) {
            _actual(_temp);
        }
    };

    result.temp=function(){
        return _temp;
    }

    //notify subscribers to update their value with the original
    result.reset = function() {
        _actual.valueHasMutated();
        _temp = _actual();
    };

    return result;
};

ko.validation.init({insertMessages: false,
    grouping: { deep: true } },true);
function businessType(data){
    var self=this;
    self.id=ko.protectedObservable(data.id);
    self.business_type = ko.protectedObservable(data.business_type);
    self.business_code = ko.protectedObservable(data.business_code);
}
function businessTypeValidate(data){
    var self=this;
    self.id=ko.protectedObservable(data.id.temp());
    self.business_type = ko.protectedObservable(data.business_type.temp()).extend({required:true});
    self.business_code = ko.protectedObservable(data.business_code.temp()).extend({required:true});
    self.error =  ko.validation.group(self);
}

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
    self.selectedBuItem=ko.observable();
    self.selectedBusinessType=ko.observable();
    self.buTypeValidation=ko.observable();
    self.editItem = function (item) {
        self.selectedBuItem(item);
    };
    self.isEdit =function(item){
        return item ==self.selectedBuItem();
    };
    this.addEdit = function() {
        var newItem = new businessType('');
        self.businessType.push(newItem);
        self.selectedBuItem(newItem);
    };
    self.cancelEdit = function (item) {
        self.selectedBuItem().business_code.reset();
        self.selectedBuItem().business_type.reset();
        self.selectedBuItem().id.reset();
        self.selectedBuItem(null);
    };
    self.applyEdit = function (item) {
        self.buTypeValidation(new businessTypeValidate(item));
        if(self.buTypeValidation().error().length==0) {
            self.selectedBuItem().business_code.commit();
            self.selectedBuItem().business_type.commit();
            self.selectedBuItem().id.commit();
            self.selectedBuItem(null);
        }
        else{
            self.buTypeValidation().showAllMessages;
            notification('Error','Please fix errors before submit','gritter-danger');
        }
    };
}
var viewModel = new settingsVM();
ko.applyBindings(viewModel,$('#panels')[0]);


var validation = function(item){

}



