/**
 * Created by sathish on 4/18/2015.
 */
ko.validation.init({insertMessages: false,
    grouping: { deep: true } },true);

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
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'business_type_id': {
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'status_id': {
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'budget': {
        create: function (options) {
            return ko.observable(options.data).extend({
                required: true,
                pattern: {
                    params: '^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
                    message: 'Enter  a valid amount'
                }
            })
        }

    },
    'parcel_charges':{
        create: function (options) {
            return ko.observable(options.data).extend({
                required: true,
                pattern: {
                    params: '^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
                    message: 'Enter  a valid amount'
                }
            })
        }

    },
    'is_door_delivery':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'minimum_delivery_amt':{
        create: function (options) {
            return ko.observable(options.data).extend({ required: { onlyIf: function() {
                if(options.parent.is_door_delivery()==1 )
                {
                    return true;
                }
                options.parent.minimum_delivery_amt(0);
            } },
                pattern:{
                    params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
                    message:'Enter  a valid amount'
                }
            });
        }
    },
    'delivery_fee':{
        create: function (options) {
            return ko.observable(options.data).extend({ required: { onlyIf: function() {
                if(options.parent.is_door_delivery()==1 )
                {
                    return true;
                }
                options.parent.delivery_fee(0);
            } },
                pattern:{
                    params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
                    message:'Enter  a valid amount'
                }
            });
        }
    },
    'avg_delivery_time':{
        create: function (options) {
            return ko.observable(options.data).extend({ required: { onlyIf:function(){
                if(options.parent.is_door_delivery()==1){
                    return true;
                }
                options.parent.avg_delivery_time(null);
            }
            },
                pattern: {
                    message: 'Hey this is not a valid time format, format:00:00:00',
                    params: '([0-9][0-9]:[0-9][0-9]:[0-9][0-9])'
                }
            })
        }
    },
    'is_pickup_available':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'minimum_pickup_amt':{
        create: function (options) {
            return ko.observable(options.data).extend({ required: { onlyIf: function() {
                if(options.parent.is_pickup_available()==1 )
                {
                    return true;
                }
                options.parent.minimum_pickup_amt(0);
            } },
                pattern:{
                    params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
                    message:'Enter  a valid amount'
                }
            });
        }
    },
    'is_rail_delivery':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'minimum_rail_deli_amt':{
        create: function (options) {
            return ko.observable(options.data).extend({ required: { onlyIf: function() {
                if(options.parent.is_rail_delivery()==1 )
                {
                    return true;
                }
                options.parent.minimum_rail_deli_amt(0)
            } },
                pattern:{
                    params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
                    message:'Enter  a valid amount'
                }
            });
        }
    },
    'is_outdoor_catering':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
   'is_party_hall':{
       create: function (options) {
           return ko.observable(options.data).extend({required: true});
       }
   },
   'is_buffet': {
       create: function (options) {
           return ko.observable(options.data).extend({required: true});
       }
   },
    'is_midnight_buffet':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_wifi_available':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_children_play_area':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_garden_restaurant':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_roof_top':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_valet_parking':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_boarding':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_bar_attached':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_highway_res':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'ischeckout_enable':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_halal':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'is_barbecue':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'website':{
        create:function(options){
            return ko.observable(options.data).extend({ pattern: {params:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/,message:'Invalid format'}})
        }
    },
    'address_line_1':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'postal_code':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true});
        }
    },
    'mobile':{
        create: function (options) {
            return ko.observable(options.data).extend({required: true},{
                    pattern: {
                        message: 'Hey this is not a valid mobile no',
                        params: '^[7-9][0-9]{9}$'
                    }
                }
            );
        }
    },
    'mobile2':{
        create: function (options) {
            return ko.observable(options.data).extend({
                pattern: {
                    message: 'Hey this is not a valid mobile no',
                    params: '^[7-9][0-9]{9}$'
                }
            });
        }
    },
    'land_line':{
        create: function (options) {
            return ko.observable(options.data).extend({
                pattern: {
                    message: 'Hey this is not a valid land line no',
                    params: /^[0-9]\d{2,4}-\d{6,8}$/
                }
            });
        }
    },
    'city_id':{
        create: function (options) {
            return ko.observable(options.data).extend({required:true,notEqual:-1});
        }
    },
    'VAT_tax':{
        create: function (options) {
            return ko.observable(options.data).extend({
                pattern:{
                    params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
                    message:'Enter  a valid amount'
                }});
        }
    },
    'service_charge':{
        create: function (options) {
            return ko.observable(options.data).extend({
                pattern:{
                    params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
                    message:'Enter  a valid amount'
                }});
        }
    },
    'service_tax':{
    create: function (options) {
        return ko.observable(options.data).extend({
            pattern:{
                params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
                message:'Enter  a valid amount'
            }});
    }
}

}

var viewModel=function(data){
    var self=this;
    self.timeDay=ko.observableArray().extend({required:true});
    self.selectedPayments=ko.observableArray().extend({required:true});
    self.deliveryArea=ko.observableArray().extend({required:{ onlyIf:function(){
        if(self.is_door_delivery==1){
            return true;
        }

    }
    }});
    self.cuisineTypes=ko.observableArray();
    self.cuisineTypeSelected=ko.observableArray().extend({ required: true,
        notEqual:-1
    });
    new time(data,self);
    new selectedPayments(data.payment,self);
    new deliveryArea(data.delivery_area,self);
    new cuisinesTypeSelected(data.cuisine_type,self);
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
    self.fileData=ko.observable({
        file: ko.observable(),
        dataURL: ko.observable()
    });
    self.submit= function() {

        if(self.errors().length === 0){
            postAjax(ko.toJSON(self));
        }
        else {
            self.showAllMessages;
            notification('Error','Please fix errors before submit','gritter-danger');
        }
    };
    self.reset =function(){
        resetViewModel(self);
        console.log(ko.toJSON(self));

    };
    ko.validatedObservable(ko.mapping.fromJS(data,validationMapping,self));
    self.errors = ko.validation.group(self,{deep:true});
    self.business_type_id.subscribe(function(model){
        self.cuisineTypes.removeAll();
        ko.utils.arrayForEach(self.cuisines(), function(cu) {
            if(ko.toJSON(cu.business_type_id) == model)
            {
                self.cuisineTypes.push(cu);
            }
        });

        console.log(ko.toJSON(self.cuisineTypeSelected));
    },self);
}
var time =function(data,object){
    var self=this;
    var timeID=new Array();
    var buhr={};
    ko.utils.arrayForEach(data.time, function(time) {
        ko.utils.arrayForEach(data.business_hours, function(hr) {
            if(time.id===hr.time_category_id){
                var array = new Array();
                timeID.push(hr.time_category_id);
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

        });
    });
    ko.utils.arrayForEach(data.time, function(time) {
       if($.inArray(time.id,timeID)==-1)
       {
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
    });
    console.log(ko.toJSON(object.timeDay));
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
var selectedPayments=function(payment,object) {
    object.selectedPayments.removeAll();
    ko.utils.arrayForEach(payment, function(item) {
        object.selectedPayments.push(item.id);
    });
    console.log(ko.toJSON(object.selectedPayments));
}

var cuisinesTypeSelected=function(cuisineType,object){
    object.cuisineTypeSelected.removeAll();
    ko.utils.arrayForEach(cuisineType, function(item) {
        object.cuisineTypeSelected.push(item.id);
    });
}
