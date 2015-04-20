/**
 * Created by Admin on 4/18/2015.
 */

ko.validation.init({insertMessages: false});
ko.validation.init( { grouping: { deep: true } } )

ko.bindingHandlers.radio = {
    init: function(element, valueAccessor, allBindings) {
           var binding = ko.unwrap(allBindings.get('checked'));
           var $element = $(element);
           if(parseInt(binding)===parseInt($element.val())){
               $element.parent().addClass('badge-success').removeClass('badge-info');
           }

    },
    update: function(element, valueAccessor, allBindings,viewModel,bindingContext) {
        var binding = ko.unwrap(allBindings.get('checked'));
        var $element = $(element);
        if(parseInt(binding)===parseInt($element.val())){
            $element.closest(".form-group").find('.label-radio').removeClass('badge-success').addClass('badge-info');
            $element.parent().addClass('badge-success').removeClass('badge-info');
        }

    }
};
var validationMapping = {
    'business_name': {
        create: function(options) {
            return ko.observable(options.data).extend({required: true});
        }
    }
}

var viewModel=function(data){
    var self=this;
    self.timeDay=ko.observableArray();
    self.selectedPayments=ko.observableArray();
    self.deliveryArea=ko.observableArray();
    self.addDeliveryArea=function(model,event){
        self.deliveryArea.push({
            area:ko.observable().extend({required:{ onlyIf:function(){
                if(self.is_door_delivery==1){
                    return true;
                }

            }
            }}),
            pincode:ko.observable().extend({
                required: { onlyIf:function(){
                    if(self.is_door_delivery==1){
                        return true;
                    }

                }
                },
                pattern: {
                    message: 'should have only 6 digits',
                    params: '^([1-9])([0-9]){5}$'
                }
            }),
            city:ko.observable(-1).extend({required:true,notEqual:-1})
        });
        return true;
    };
    self.removeDeliveryArea=function(model,event)
    {
        self.deliveryArea.remove(model);
        return true;
    };
    self.submit= function() {
        if(self.isValid){
            postAjax(ko.toJSON(self));
        }
        else {
            self.showAllMessages;
            notification('Error','Please fix errors before submit','gritter-danger');
        }
    }
    new time(data,self);
    new selectedPayments(data.payment,self);
    new deliveryArea(data.delivery_area,self);
    ko.validatedObservable(ko.mapping.fromJS(data,validationMapping,self));
    ko.applyBindings(self,$('#add-bu')[0]);
}
var time =function(data,object){
    var self=this;
    var flag=true;
    var buhr={};
    ko.utils.arrayForEach(data.business_hours, function(hr) {
        ko.utils.arrayForEach(data.time, function(time) {
            if(time.id===hr.time_category_id){
                flag=false;
                var array = new Array();
                ko.utils.arrayForEach(hr.week_days,function(item)
                {
                    array.push(item.id);
                });
                buhr = {
                    business_hr_id : ko.observable(hr.id),
                    time_category_id : ko.observable(hr.time_category_id),
                    enabled : ko.observable(true),
                    open_time : ko.observable(formatDate(hr.open_time)),
                    close_time : ko.observable(formatDate(hr.close_time)),
                    week_days : ko.observableArray(array),
                    category_description : time.category_description
                }
                object.timeDay.push(buhr);
            }
            if(flag) {
                buhr= {
                    business_hr_id : ko.observable(-1),
                    time_category_id : ko.observable(time.id),
                    open_time : ko.observable(),
                    close_time : ko.observable(),
                    enabled : ko.observable(false),
                    week_days : ko.observableArray([1, 2, 3, 4, 5, 6, 7]),
                    category_description : time.category_description
                }
                object.timeDay.push(buhr);
            }
            flag=true;
        });
    });
}
var selectedPayments=function(payment,object)
{
    ko.utils.arrayForEach(payment,function(item)
    {
       object.selectedPayments.push(item.id);
    });
}

var deliveryArea =function(deliveryarea,object){
    ko.utils.arrayForEach(deliveryarea,function(item)
    {
       object.deliveryArea.push({
           area:ko.observable(item.area).extend({required:{ onlyIf:function(){
               if(self.is_door_delivery==1){
                   return true;
               }

           }
           }}),
           pincode:ko.observable(item.area_pincode).extend({
               required: { onlyIf:function(){
                   if(self.is_door_delivery==1){
                       return true;
                   }

               }
               },
               pattern: {
                   message: 'should have only 6 digits',
                   params: '^([1-9])([0-9]){5}$'
               }
           }),
           city:ko.observable(item.city_id).extend({required:true,notEqual:-1})
       })
    });
}