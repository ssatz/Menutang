/**
 * Created by Satz on 6/18/2015.
 */
ko.validation.init({insertMessages: false,
    grouping: { deep: true } },true);

var userData = function(data){
    var self=this;
    self.email = ko.observable(data.email).extend({
        required:true,
        email:true
    })
    self.mobile=ko.observable(data.mobile).extend({
        required:true,
        pattern: {
            message: 'Hey this is not a valid mobile no',
            params: '^[7-9][0-9]{9}$'
        }
    }),
    self.first_name=ko.observable(data.first_name).extend({required:true});
    self.last_name=ko.observable(data.last_name).extend({required:true});
    self.errors=ko.validation.group(self);
}
var addressVM = function(data){
    var self=this;
    self.user_id=ko.observable(data.user_id || -1);
    self.city_id =ko.observable(data.city_id || -1);
    self.address_1=ko.observable(data.address_1 || null);
    self.address_2=ko.observable(data.address_2 || null);
    self.landmark=ko.observable(data.landmark || null);
    self.postcode=ko.observable(data.postcode || null);
    self.active =ko.observable(data.active || null);
    self.errors=ko.validation.group(self);
}

var userProfileVM = function(data){
    var self=this;
    self.user=ko.observable(function(){
        return new userData(data);
    });
    self.cities =ko.observableArray(data.cities);
    self.password =ko.observable({
        currentPassword:ko.observable().extend({required:true}),
        newPassword:ko.observable().extend({required:true}),
        conNewPassword:ko.observable().extend( {areSame: { params: self.newPassword, message: "Confirm password must match password" }}),
        errors:ko.validation.group(self.password)
    });

    self.screateNewAddress=function(){

    }

    self.address= ko.observable(function () {
        return new addressVM(data.user_delivery_address);
    });

}