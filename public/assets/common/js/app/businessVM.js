/**
 * Created by satz on 4/9/2015.
 */
ko.validation.init({insertMessages: false});
ko.validation.init( { grouping: { deep: true } } )
var businessVM = {
    businessId :ko.observable(),
    businessName : ko.observable('').extend({ required: true,
                                                pattern: {
                                                    message: 'Hey this is not a valid Business Name',
                                                    params: '^[a-zA-Z0-9_ ]*$'
                                                }
                                            }),
    businessType : ko.observable(-1).extend({ required: true,
                                                notEqual:-1
                                            }),
    cuisineType  :ko.observable('').extend({ required: true,
                                                notEqual:-1
                                            }),
    status : ko.observable('').extend({ required: true,
        notEqual:-1
    }),
    businessUser : ko.observable(''),
    budget:ko.observable('').extend({required:true,number: true }),
    parcelCharges:ko.observable(0).extend({required:true,number: true }),
    doorDelivery:ko.observable('').extend({required:true}),
    deliveryFee :ko.observable(0).extend({
        pattern:{
    params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
        message:'Enter  a valid amount'
}}),
    railDelivery:ko.observable('').extend({required:true}),
    pickupAvailable:ko.observable('').extend({required:true}),
    outdoorCatering:ko.observable('').extend({required:true}),
    partyHall :ko.observable('').extend({required:true}),
    buffet:ko.observable('').extend({required:true}),
    midnightBuffet:ko.observable('').extend({required:true}),
    wifi:ko.observable('').extend({required:true}),
    childrenPlayArea:ko.observable('').extend({required:true}),
    gardenRestaurant:ko.observable('').extend({required:true}),
    roofTop:ko.observable('').extend({required:true}),
    valetParking:ko.observable('').extend({required:true}),
    boarding:ko.observable('').extend({required:true}),
    barAttached:ko.observable('').extend({required:true}),
    highwayRestaurant:ko.observable('').extend({required:true}),
    website:ko.observable('').extend({ pattern: {params:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/,message:'Invalid format'}}),
    aboutBusiness:ko.observable(''),
    checkOutEnable:ko.observable('').extend({required:true}),
    city:ko.observable('').extend({required:true,notEqual:-1}),
    businessAddress1:ko.observable('').extend({required:true}),
    businessAddress2:ko.observable(''),
    businessLandmark:ko.observable(''),
    halal:ko.observable('').extend({required:true}),
    bbq:ko.observable('').extend({required:true}),
    businessAC:ko.observable(false),
    businessNonAC:ko.observable(true),
    gpsLatitude :ko.observable(''),
    gpsLongitude :ko.observable(''),
    postalCode :ko.observable('').extend({
        required: true,
        pattern: {
            message: 'Hey postal code should have only 6 digits',
            params: '^([1-9])([0-9]){5}$'
        }
    }),
    businessMobile:ko.observable('').extend({
        required: true,
        pattern: {
            message: 'Hey this is not a valid mobile no',
            params: '^[7-9][0-9]{9}$'
        }
    }),
    mobile:ko.observable('').extend({
        required: true,
        pattern: {
            message: 'Hey this is not a valid mobile no',
            params: '^[7-9][0-9]{9}$'
        }
    }),
    email:ko.observable('').extend({
        required: true,
        email:true
    }),
    first_name:ko.observable('').extend({
        required: true
    }),
    last_name:ko.observable('').extend({
        required: true
    }),
    businessMobile2:ko.observable('').extend({
        pattern: {
            message: 'Hey this is not a valid mobile no',
            params: '^[7-9][0-9]{9}$'
        }
    }),
    landLine:ko.observable('').extend({
        pattern: {
            message: 'Hey this is not a valid land line no',
            params: /^[0-9]\d{2,4}-\d{6,8}$/
        }
    }),
    timeDay:ko.observableArray().extend({required:{
        params:true,
        message: 'At least one of the Time need to be Selected'
    }}),
    time:ko.observableArray(),
    day:ko.observableArray(),
    cuisines:ko.observableArray(),
    cuisinesData:ko.observableArray(),
    payments:ko.observableArray().extend({required:true}),
    addDeliveryArea:function(model,event){
        businessVM.deliveryArea.push({
            area:ko.observable().extend({required:{ onlyIf:function(){
                if(businessVM.doorDelivery()=='true'){
                    return true;
                }

            }
            }}),
            pincode:ko.observable().extend({
                required: { onlyIf:function(){
                    if(businessVM.doorDelivery()=='true'){
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
    },
    removeDeliveryArea:function(model,event)
    {
        businessVM.deliveryArea.remove(model);
        return true;
    },
    removeImage:function(data){
       businessVM.imageFile('');
       businessVM.imageObjectURL('');
       businessVM.imageBinary('');
    },
    addTime: function (model) {
        if(model.check() ) {
            businessVM.timeDay.remove(model);
            businessVM.timeDay.push(model);
        }
        else{
            businessVM.timeDay.remove(model);
        }
        console.log(ko.toJSON(businessVM.timeDay));
        return true;
    },
    radioClick:function(data,event)
    {   $(event.target).closest(".form-group").find('.label-radio').removeClass('badge badge-success').addClass('badge badge-info');
        $(event.target).parent().removeClass('badge badge-info').addClass('badge badge-success');
    },
    submit: function() {
        if (businessVM.errors().length === 0) {
            postAjax(ko.toJSON(businessVM));
        }
        else {
            businessVM.errors.showAllMessages(true);
            notification('Error','Please fix errors before submit','gritter-danger');
        }
    }
}
businessVM.businessType.subscribe(function(model){
    businessVM.cuisinesData([]);
    ko.utils.arrayForEach(businessVM.cuisines(), function(cu) {
        if(cu.business_type_id == ko.toJS(parseInt(model)))
        {
            businessVM.cuisinesData.push(cu);
        }
    });
});
businessVM.avgDeliveryTime=ko.observable('').extend({ required: { onlyIf:function(){
    if(businessVM.doorDelivery()=='true'){
        return true;
    }
    businessVM.avgDeliveryTime=undefined;
}
},
    pattern: {
        message: 'Hey this is not a valid time format, format:00:00:00',
        params: '([0-9][0-9]:[0-9][0-9]:[0-9][0-9])'
    }
}),
businessVM.minimumDeliveryAmount=ko.observable(0).extend({ required: { onlyIf: function() {
    if(businessVM.doorDelivery()==='true' )
    {
        return true;
    }
    businessVM.minimumDeliveryAmount=0
} },
    pattern:{
        params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
        message:'Enter  a valid amount'
    } });
businessVM.deliveryArea=ko.observableArray([{
    area:ko.observable(undefined).extend({required:{ onlyIf:function(){
        if(businessVM.doorDelivery()=='true'){
            return true;
        }
        return false;
    }
    }}),
    pincode:ko.observable(undefined).extend({
        required: { onlyIf:function(){
            if(businessVM.doorDelivery()=='true'){
                return true;
            }

        }
        },
        pattern: {
            message: 'should have only 6 digits',
            params: '^([1-9])([0-9]){5}$'
        }
    }),
    city:ko.observable(undefined).extend({required:{ onlyIf:function(){
        if(businessVM.doorDelivery()=='true'){
            return true;
        }

    }
    },notEqual:-1})
}]).extend({required:{ onlyIf:function(){
 if(businessVM.doorDelivery()=='true'){
     return true;
 }

}
}});
businessVM.minimumRailDeliveryAmount=ko.observable(0).extend({ required: { onlyIf: function() {
    if(businessVM.railDelivery()==='true' )
    {
        return true;
    }
    businessVM.minimumRailDeliveryAmount=0;
} },
    pattern:{
        params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
        message:'Enter  a valid amount'
    }
});
businessVM.minimumPickupAmount=ko.observable(0).extend({ required: { onlyIf: function() {
    if(businessVM.pickupAvailable()==='true' )
    {
        return true;
    }
    businessVM.minimumPickupAmount=0;
} },
    pattern:{
    params:'^([0-9]+)|([0-9]+.[0-9]{1,2}|(.[0-9]{1,2}))$',
        message:'Enter  a valid amount'
}
});
businessVM.outdoorCateringComments=ko.observable();
businessVM.partyHallComments=ko.observable();
businessVM.boardingComments=ko.observable();
businessVM.highwayRestaurantDetails=ko.observable();
businessVM.isdeliveryEnable= ko.observable(function () {
    if(businessVM.doorDelivery()=='true'){
        return true;
    }
   return businessVM.deliveryArea([]);
});
businessVM.fileData = ko.observable({
    file: ko.observable().extend({required:true}),
    dataURL: ko.observable().extend({required:true})
}).extend({required:true});
ko.components.register('timehr-template', {
    viewModel: function(params) {
        var self=this;
        self.check =ko.observable(false);
        self.timeCategory = ko.observable(params.timeCategory || '');
        self.day =ko.observableArray([1,2,3,4,5,6,7]);
        self.dayCheck=function(model,event)
        {
          if($(event.target).is(':checked'))
          {
              self.day.push(model.id);
          }
          else{
              self.day.remove(model.id);
          }
            if (self.errors().length === 0) {
                self.Callback(self);
            }
            else {
                self.errors.showAllMessages();
            }
            return true;
        }
        self.openTime=ko.observable(params.openTime || '').extend({ required: { onlyIf: function() {
            if(self.check()==true )
            {
                return true;
            }
        } } });
        self.closeTime=ko.observable(params.closeTime || '').extend({ required: { onlyIf: function() {
            if(self.check()==true )
            {
                return true;
            }
        } } });
        self.category=ko.observable(params.category || '');
        self.Callback = params.callback
        self.submit = function(model, event) {
            if(self.check()) {
                $(event.target).parent().removeClass('badge-danger').addClass('badge-success');
            }
            else{
                $(event.target).parent().addClass('badge-danger').removeClass('badge-success');
            }
            if (self.errors().length === 0) {
                self.Callback(self);
            }
            else {
                self.errors.showAllMessages();
            }
            return true;
        };
       self.errors= ko.validation.group(self);
    },
    template:         '<div class="form-group">'+
                    '<label class="badge badge-danger label-checkbox inline">'+
                        '<input type="checkbox"  data-bind="checked:check,value:timeCategory,click:submit"/>'+
                            '<span class="custom-checkbox"></span>'+
                                '<!-- ko text:category --><!--/ko-->'+
                    '</label></div>'+
                    '<div class="form-group">'+
                    '<label for="openTime">Open Time</label>'+
                        '<input type="text" data-bind="timePicker,value:openTime,event: { focusout: submit}" class="form-control input-sm">'+
                        '<p class="validationMessage" data-bind="validationMessage: openTime"></p>'+
                    '</div>'+
                    '<div class="form-group">'+
                    '<label for="closeTime">Close Time</label>'+
                        '<input type="text" data-bind="timePicker,value:closeTime,event: { focusout: submit}" class="form-control input-sm">'+
                        '<p class="validationMessage" data-bind="validationMessage: closeTime"></p>'+
                    '</div>' +
                    '<!--ko foreach:$root.day -->'+
                    '<label class="badge badge-info label-checkbox inline">'+
                    '<input type="checkbox" checked="checked" data-bind="click:$parent.dayCheck,value:id"/>'+
                    '<span class="custom-checkbox"></span>'+
                    '<!-- ko text:day --><!--/ko-->'+
                    '</label><!--/ko-->' +
                    '</div>'+
                    '<hr>'

});

businessVM.errors = ko.validation.group(businessVM,{deep:true});
ko.applyBindings(businessVM,document.getElementById("add-bu"));
