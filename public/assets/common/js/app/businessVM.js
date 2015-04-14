/**
 * Created by satz on 4/9/2015.
 */

ko.bindingHandlers.chosen = {
    init: function(element, valueAccessor, allBindings, viewModel, bindingContext){
        var $element = $(element);
        var options = ko.unwrap(valueAccessor());

        if (typeof options === 'object')
            $element.chosen(options);

        ['options', 'selectedOptions'].forEach(function(propName){
            if (allBindings.has(propName)){
                var prop = allBindings.get(propName);
                if (ko.isObservable(prop)){
                    prop.subscribe(function(){
                        $element.trigger('chosen:updated');
                    });
                }
            }
        });
    }
}
ko.bindingHandlers.timePicker = {
    init: function(element, valueAccessor) {
        var options = ko.unwrap(valueAccessor());
        $(element).timepicker(options);
    },
    update: function(element, valueAccessor, allBindings) {

    }
};
ko.validation.rules['url'] = {
    validator: function(val, required) {
        if (!val) {
            return !required
        }
        val = val.replace(/^\s+|\s+$/, '');
        return val.match(/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.‌​\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[‌​6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1‌​,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00‌​a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u‌​00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i);
    },
    message: 'This field has to be a valid URL'
};
ko.validation.registerExtenders();
ko.validation.init({insertMessages: false});
ko.validation.init( { grouping: { deep: true } } )
var businessVM = {
    businessName : ko.observable('').extend({ required: true,
                                                pattern: {
                                                    message: 'Hey this is not a valid Business Name',
                                                    params: '^[a-zA-Z0-9_ ]*$'
                                                }
                                            }),
    businessType : ko.observable('').extend({ required: true,
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
    deliveryFee :ko.observable(0).extend({number: true}),
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
    website:ko.observable('').extend({url:true}),
    aboutBusiness:ko.observable(''),
    checkOutEnable:ko.observable('').extend({required:true}),
    avgDeliveryTime:ko.observable('').extend({ required: true,
                                                    pattern: {
                                                        message: 'Hey this is not a valid time format, format:00:00:00',
                                                        params: '([0-9][0-9]:[0-9][0-9]:[0-9][0-9])'
                                                    }
    }),
    city:ko.observable('').extend({required:true,notEqual:-1}),
    businessAddress1:ko.observable('').extend({required:true}),
    businessAddress2:ko.observable(''),
    businessLandmark:ko.observable(''),
    gpsLocation :ko.observable(''),
    postalCode :ko.observable('').extend({
        required: true,
        pattern: {
            message: 'Hey postal code should have only 6 digits',
            params: '^([1-9])([0-9]){5}$'
        }
    }),
    businessMobile:ko.observable().extend({
        required: true,
        pattern: {
            message: 'Hey this is not a valid mobile no',
            params: '^[7-9][0-9]{9}$'
        }
    }),
    timeDay:ko.observableArray().extend({required:true}),
    time:ko.observableArray(),
    day:ko.observableArray(),
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
            })
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
            console.log('sathish');
            postAjax(ko.toJSON(businessVM));
        }
        else {
            businessVM.errors.showAllMessages();
        }
    }
}

businessVM.minimumDeliveryAmount=ko.observable(0).extend({ required: { onlyIf: function() {
    if(businessVM.doorDelivery()==='true' )
    {
        return true;
    }
} } });
businessVM.deliveryArea=ko.observableArray([{
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
    })
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
} } });
businessVM.minimumPickupAmount=ko.observable(0).extend({ required: { onlyIf: function() {
    if(businessVM.pickupAvailable()==='true' )
    {
        return true;
    }
} } });
businessVM.outdoorCateringComments=ko.observable().extend({ required: { onlyIf: function() {
    if(businessVM.outdoorCatering()==='true' )
    {
        return true;
    }
} } });
businessVM.partyHallComments=ko.observable().extend({ required: { onlyIf: function() {
    if(businessVM.partyHall()==='true' )
    {
        return true;
    }
} } });
businessVM.boardingComments=ko.observable().extend({ required: { onlyIf: function() {
    if(businessVM.boarding()==='true' )
    {
        return true;
    }
} } });
businessVM.highwayRestaurantDetails=ko.observable().extend({ required: { onlyIf: function() {
    if(businessVM.highwayRestaurant()==='true' )
    {
        return true;
    }
} } });
businessVM.isdeliveryEnable= ko.observable(function () {
    console.log('sathish');
    if(businessVM.doorDelivery()=='true'){
        return true;
    }
   return businessVM.deliveryArea([]);
});
businessVM.fileData = ko.observable({
    file: ko.observable(),
    dataURL: ko.observable()
});
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
ko.applyBindings(businessVM);