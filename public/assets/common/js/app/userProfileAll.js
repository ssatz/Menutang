/**
 * Created by Sathish on 7/25/2015.
 */
ko.validation.init({insertMessages: true,
    parseInputAttributes: true,
    grouping: { deep: true } },true);
var userData = function(data){
    var self=this;
    self.email = ko.observable(data.email|| null).extend({
        required:true,
        email:true
    })
    self.email.isModified(false);
    self.mobile=ko.observable(data.mobile|| null).extend({
        required:true,
        pattern: {
            message: 'Hey this is not a valid mobile no',
            params: '^[7-9][0-9]{9}$'
        }
    }),
        self.mobile.isModified(false);
    self.first_name=ko.observable(data.first_name || null).extend({required:true});
    self.first_name.isModified(false);
    self.last_name=ko.observable(data.last_name || null).extend({required:true});
    self.last_name.isModified(false);
    self.errors=ko.validation.group(self);
}
var userProfileAll  =function(data) {
    var self=this;
   self.userDetails= ko.validatedObservable(ko.mapping.fromJS(data));
   self.edit = function(data,event){
      $(event.currentTarget).closest('tr').next().show('slow');
   }
    self.close=function(data,event){
        $(event.currentTarget).closest('tr').hide('slow');
    }
}
