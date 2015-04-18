/**
 * Created by Admin on 4/18/2015.
 */

var addbuType= function()
{
    this.buCode=ko.observable().extend({required:true,pattern:
    {
        params:'^[A-Z]*$',
        message:'Should be in Capital Letter'
    }});
    this.buDescription =ko.observable().extend({required:true});
    this.errors= ko.validation.group(this);
    this.submit = function()
    {
        if (this.errors().length === 0) {
            addbuAjax(ko.toJSON(this));
        }
        else {
            this.errors.showAllMessages();
        }
    }.bind(this);
}
var addcuType =function()
{
    this.buID =ko.observable().extend({required:true});

    this.cuCode=ko.observable().extend({required:true,pattern:
    {
        params:'^[A-Z]*$',
        message:'Should be in Capital Letter'
    }});
    this.cuDescription =ko.observable().extend({required:true});
    this.errors= ko.validation.group(this);
    this.submit = function()
    {
        if (this.errors().length === 0) {
            addcuAjax(ko.toJSON(this));
        }
        else {
            this.errors.showAllMessages();
        }
    }.bind(this);
}
ko.applyBindings(new addbuType(),document.getElementById("buType"));
ko.applyBindings(new addcuType(),document.getElementById("cuType"));
