/**
 * Created by Admin on 4/18/2015.
 */

var addbuType= function()
{
    var self = this;
    self.buCode=ko.observable().extend({required:true,pattern:
    {
        params:'^[A-Z]*$',
        message:'Should be in Capital Letter'
    },
     minLength: 3 ,
     maxLength: 3
    });
    self.buDescription =ko.observable().extend({required:true});
    self.errors= ko.validation.group(self);
    self.submit = function()
    {
        if (this.errors().length === 0) {
            addbuAjax(ko.toJSON(self),self);
        }
        else {
            this.errors.showAllMessages();
        }
    }.bind(self);
}
var addcuType =function()
{
    var self = this;
    self.buID =ko.observable().extend({required:true});

    self.cuCode=ko.observable().extend({required:true,pattern:
    {
        params:'^[A-Z]*$',
        message:'Should be in Capital Letter'
    },
        minLength: 3 ,
        maxLength: 3
    });
    self.cuDescription =ko.observable().extend({required:true});
    self.errors= ko.validation.group(self);
    self.submit = function()
    {
        if (self.errors().length === 0) {
            addcuAjax(ko.toJSON(self),self);
        }
        else {
            self.errors.showAllMessages();
        }
    }.bind(self);
}
ko.applyBindings(new addbuType(),document.getElementById("buType"));
ko.applyBindings(new addcuType(),document.getElementById("cuType"));
