
var PaymentType = function(data) {
    var self = this;
    self.id =ko.observable();
    self.payment_code=ko.observable().extend({required:true,pattern:
    {
        params:'^[A-Z]*$',
        message:'Should be in Capital Letter'
    },
        minLength: 3 ,
        maxLength: 3
    });
    self.payment_description = ko.observable().extend({required:true});
    self.errors=ko.validation.group(self);
    //populate our model with the initial data
    self.update(data);
};

//can pass fresh data to this function at anytime to apply updates or revert to a prior version
PaymentType.prototype.update = function(data) {
    var self = this;
    self.id =ko.observable(data.id || -1);
    self.payment_code=ko.observable(data.payment_code).extend({required:true,pattern:
    {
        params:'^[A-Z]*$',
        message:'Should be in Capital Letter'
    },
        minLength: 3 ,
        maxLength: 3
    });
    self.payment_description = ko.observable(data.payment_description).extend({required:true});
};

var PaymentTypeVM = function() {
    var self=this;
    //turn the raw items into Item objects
    self.paymentTypeItems = ko.observableArray();
    self.businessTypes = ko.observableArray();
    self.isErrorAjax = ko.observable(false);
    self.remove=function(item){
        self.paymentTypeItems.remove(item);
    }
    self.panelToggle=function(model,event){
        $(event.target).parent().next().toggle('slow',function(){
            if($(this).is(':visible')){
                getPaymentType(self);
                $(event.target).removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
            }
            else{
                $(event.target).addClass('fa-chevron-circle-down').removeClass('fa-chevron-circle-up');
            }
        });

        return true;
    };
    //hold the currently selected item
    self.selectedItem = ko.observable();
    self.pageSize = ko.observable(5);
    self.pageIndex = ko.observable(0);
    //make edits to a copy
    self.itemForEditing = ko.observable();
    self.templateToUse = function (item) {
        return self.selectedItem() === item ? 'editpaymentTypeTmpl' : 'paymentTypeTmpl';
    };
    self.post =function(data){
        postPaymentType(ko.toJSON(data),self);
    }
    self.add =function(){
        var item=new PaymentType({
            id:-1,
            business_type_id:-1,
            payment_code:'',
            payment_description:''
        });
        self.moveToPage(self.lastIndex().pageNumber-1);
        self.paymentTypeItems.push(item) ;
        self.selectedItem(item);
        self.itemForEditing(new PaymentType(ko.toJS(item)));
    };
    self.pagedList = ko.computed(function () {
        var size = self.pageSize();
        var start = self.pageIndex() * size;
        return self.paymentTypeItems.slice(start, start + size);
    });
    self.maxPageIndex = ko.computed(function () {
        return Math.ceil(self.paymentTypeItems().length / self.pageSize()) - 1;
    });
    self.previousPage = function () {
        if (self.pageIndex() > 0) {
            self.pageIndex(self.pageIndex() - 1);
        }
    };
    self.nextPage = function () {
        if (self.pageIndex() < self.maxPageIndex()) {
            self.pageIndex(self.pageIndex() + 1);
        }
    };
    self.allPages = ko.computed(function () {
        var pages = [];
        for (i = 0; i <= self.maxPageIndex() ; i++) {
            pages.push({ pageNumber: (i + 1) });
        }
        return pages;
    });
    self.lastIndex =ko.computed(function(){
        return self.allPages()[self.allPages().length-1];
    });
    self.moveToPage = function (index) {
        self.pageIndex(index);
    };
    self.selectItem = self.selectItem.bind(self);
    self.acceptItem = self.acceptItem.bind(self);
    self.revertItem = self.revertItem.bind(self);

};

ko.utils.extend(PaymentTypeVM.prototype, {
    //select an item and make a copy of it for editing
    selectItem: function(item) {
        this.selectedItem(item);
        this.itemForEditing(new PaymentType(ko.toJS(item)));
    },

    acceptItem: function(item) {
        if(item.errors().length==0) {
            var selected = this.selectedItem(),
                edited = ko.toJS(this.itemForEditing());
            this.post(edited);
            if(this.isErrorAjax()) {
                selected.update(edited);
                this.selectedItem(null);
                this.itemForEditing(null);
            }
        }
        else{
            item.errors.showAllMessages();
        }
    },

    //just throw away the edited item and clear the selected observables
    revertItem: function() {
        this.selectedItem(null);
        this.itemForEditing(null);
    }
});

ko.applyBindings(new PaymentTypeVM(), $('#paymentType-panel')[0]);