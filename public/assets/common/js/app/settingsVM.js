/**
 * Created by satz on 4/25/2015.
 */


var settingsVM = {
   panelToggle:function(model,event){
       $(event.target).parent().next().toggle('slow',function(){
          if($(this).is(':visible')){
              $(event.target).removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
          }
           else{
              $(event.target).addClass('fa-chevron-circle-down').removeClass('fa-chevron-circle-up');
          }
       });

       return true;
   },
  businessType:ko.observableArray(),
  selectedBusinessType:ko.observable()

}


ko.applyBindingsWithValidation(settingsVM,$('#panels')[0]);