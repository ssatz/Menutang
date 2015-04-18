/**
 * Created by Admin on 4/18/2015.
 */

ko.validation.init({insertMessages: false});
ko.validation.init( { grouping: { deep: true } } )

var validationMapping = {
    'business_name': {
        create: function(options) {
            return ko.observable(options.data).extend({required: true});
        }
    }
}