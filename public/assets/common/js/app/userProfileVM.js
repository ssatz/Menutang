/**
 * Created by Satz on 6/18/2015.
 */
ko.validation.init({insertMessages: false,
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
var addressVM = function(data){
    var self=this;
    self.id=ko.observable(data.id||-1);
    self.user_id=ko.observable(data.user_id || -1);
    self.city_id =ko.observable(data.city_id || -1).extend({required:true,notEqual: -1});
    self.address_1=ko.observable(data.address_1 || null).extend({required:true});
    self.address_2=ko.observable(data.address_2 || null);
    self.landmark=ko.observable(data.landmark || null);
    self.postcode=ko.observable(data.postcode || null).extend({required: true,pattern:{
        message:'Hey this is not a valid pincode',
        params :'^([1-9])([0-9]){5}$'
    }});
    self.mobile=ko.observable(data.mobile || null).extend({required: true,
            pattern: {
                message: 'Hey this is not a valid mobile no',
                params: '^[7-9][0-9]{9}$'
            }
        }
    );
    self.active =ko.observable(data.active || 0);
    self.errors=ko.validation.group(self);
}

var userProfileVM = function(data){
    var self=this;
    self.user=ko.observable(new userData(data));
    self.cities =ko.observableArray(data.cities);
    self.currentPassword=ko.observable().extend({required:true}),
    self.newPassword=ko.observable().extend({required:true}),
    self.conNewPassword=ko.observable().extend({areSame: { params:self.newPassword, message: "Confirm password must match password" }}),
    self.errors=ko.validation.group([self.currentPassword,self.newPassword,self.conNewPassword]);
    self.createNewAddress=function(){

    }
    self.cancelPassword =function(){
        self.currentPassword(null);
        self.currentPassword.clearError();
        self.newPassword(null);
        self.newPassword.clearError();
        self.conNewPassword(null);
        self.conNewPassword.clearError();
    }
    self.cancelUser = function () {
        $.getJSON('profile',function(data){
            self.user(new userData(data));
        });
    }
    self.address= ko.observable(new addressVM(data.user_delivery_address));
    self.addresses = ko.observableArray(data.user_delivery_address);
   /* ko.utils.arrayForEach(data.user_delivery_address, function(data) {
       self.addresses.push(new addressVM(data));
    });*/
    self.replaceSplChar = function (string){
         data=ko.toJS(string).replace(/[^A-Z0-9]+/ig,'-');
        return data;
    }
    self.cancelAddress = function(){
        $.getJSON('profile',function(data){
            self.address(new addressVM(data.user_delivery_address));
        });
    }
    self.newAddress = function (data) {
        self.address(new addressVM(data));
    }

    self.saveUser =function(){
        if(self.user().errors().length==0) {
            postAction('userDetails', ko.toJSON(self.user()), self);
        }
        else{
            self.user().errors.showAllMessages();
        }
    }
    self.saveAddress = function () {
        console.log(ko.toJSON(self.address().errors()));
        if(self.address().errors().length==0) {
            postAction('address', ko.toJSON(self.address()), self);
        } else{
            self.address().errors.showAllMessages();
        }
    }
    self.changePassword= function(){
        if(self.errors().length==0) {
            pass = {
                currentPass: Base64.encode(ko.toJS(self.currentPassword())),
                newPass: Base64.encode(ko.toJS(self.conNewPassword()))

            }
            postAction('pass', ko.toJSON(pass), self);
        }
        else{
            self.errors.showAllMessages();
        }
    }
}
