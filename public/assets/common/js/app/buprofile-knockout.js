
var cartModel ={
    cart : ko.observableArray([]),
    itemOptions:ko.observableArray([]),
    deliveryPick:ko.observable(),
    deliveryPickFee :ko.observable(),
    deliveryPickMinimum:ko.observable(),
    remainingAmount:ko.observable(),
    orderButton:ko.observable('disabled'),
    display:ko.observable(false),
    selectedChoices:ko.observableArray([]),
    addOrder:function()
    {
        $("#item-options").modal('hide');
        postAddOptionsAjax(ko.toJSON(cartModel.selectedChoices()));
    },
    addChoices:function(model){
        if(model.check()) {
            cartModel.selectedChoices.push(model);
            return true;
        }
         cartModel.selectedChoices.remove(model);
        return true;
    },
    deliveryPickclick:function(data,event){
        var fee=$(event.target).parent('label').find("input[name=delivery_fee]").val();
        var miniAmount=$(event.target).parent('label').find("input[name=minimum_amt]").val();
        this.deliveryPickFee(parseFloat(fee));
        this.deliveryPickMinimum(parseFloat(miniAmount));
        this.display(true);
        return true;
    },
    cartItemMinus:function(data,event){
        var cartItemId = $.trim($(event.target).parents("li").find("input[name=data_hash]").val());
         postAjax(cartItemId,"Minus");
        return true;
    },
    cartItemAdd:function(data,event){
        var cartItemId = $.trim($(event.target).parents("li").find("input[name=data_hash]").val());
        postAjax(cartItemId,"Add");
        return true;
    },
    cartItemDelete:function(data,event){
        var cartItemId = $.trim($(event.target).parents("li").find("input[name=data_hash]").val());
         postAjax(cartItemId,"Delete");
        return true;
    }

};

cartModel.subTotal = ko.pureComputed(function() {
    var total = 0;

    if(this.cart().length ==undefined)
    {
        $.each(this.cart().cart_item,function(index,item){
            total+=parseFloat(item.price);
        })
    }
    if(this.cart().length ==undefined)
    {
        $.each(this.cart().cart_item,function(index,item){
            if(item.option_cart!=null) {
                $.each(item.option_cart, function (index, item) {
                    total += parseFloat(item.price);
                });
            }
        });
    }
    return total;
}, cartModel);

cartModel.parcelFee = ko.pureComputed(function() {
    var total = 0;
    total =parseFloat($("#parcel-charge").val());
    return total;
}, cartModel);

cartModel.grandTotal = ko.pureComputed(function() {
    var total = this.subTotal()+ parseFloat(this.deliveryPickFee()!=undefined?this.deliveryPickFee():0);
    total = total + this.parcelFee();
    var remaining=0;
    remaining =this.deliveryPickMinimum() - total;
    if(remaining<0) {
        this.remainingAmount(0);
        this.orderButton(undefined);
    }else {
        this.remainingAmount(remaining);
    }
    return total;
}, cartModel);

//Components

ko.components.register('checkbox-template', {
    viewModel: function(params) {
        var self=this;
        self.id = ko.observable(params.id || '');
        self.name=ko.observable(params.name || '');
        self.price=ko.observable(params.price || '');
        self.Callback = params.callback;
        self.check =ko.observable(false);
        self.submit = function(model, event) {
               self.Callback(model);
            return true;
        };
    },
    template: '<input type="checkbox" data-bind="checked:check,click:submit"> <!-- ko text: name --> <!-- /ko --> ' +
     '<input type="hidden" data-bind="value:id">'+
    '<span class="badge"><i class="fa fa-inr"><!-- ko text: price --> <!-- /ko --></i></span>'
});

ko.components.register('radio-template', {
    viewModel: function(params) {
        this.id = ko.observable(params.id || '');
        this.name=ko.observable(params.name || '');
        this.price=ko.observable(params.price || '');
        self.Callback = params.callback;
        self.check =ko.observable(false);
        self.submit = function(model, event) {
                self.Callback(model);
            return true;
        };
    },
    template: '<input type="radio" data-bind="checked:check,click:submit"> <!-- ko text: name --> <!-- /ko --> ' +
    '<input type="hidden" data-bind="value:id">'+
    '<span class="badge"><i class="fa fa-inr"><!-- ko text: price --> <!-- /ko --></i></span>'
});

ko.applyBindings(cartModel);

