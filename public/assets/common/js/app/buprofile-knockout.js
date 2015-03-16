
var cartModel ={
    cart : ko.observableArray([]),
    deliveryPick:ko.observable(),
    deliveryPickFee :ko.observable(),
    deliveryPickMinimum:ko.observable(),
    remainingAmount:ko.observable(),
    orderButton:ko.observable('disabled'),
    display:ko.observable(false),
    deliveryPickclick:function(data,event){
        var fee=$(event.target).parent('label').find("input[name=delivery_fee]").val();
        var miniAmount=$(event.target).parent('label').find("input[name=minimum_amt]").val();
        this.deliveryPickFee(parseFloat(fee));
        this.deliveryPickMinimum(parseFloat(miniAmount));
        this.display(true);
        return true;
    },
    cartItemMinus:function(data,event){
        var cartItemId = $(event.target).parents("li").find("input[name=item_id]").val();
         postAjax(cartItemId,"Minus");
        return true;
    },
    cartItemAdd:function(data,event){
        var cartItemId = $(event.target).parents("li").find("input[name=item_id]").val();
        postAjax(cartItemId,"Add");
        return true;
    },
    cartItemDelete:function(data,event){
        var cartItemId = $(event.target).parents("li").find("input[name=item_id]").val();
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


ko.applyBindings(cartModel);

