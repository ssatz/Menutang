@extends('admin._layout')
@section('content')


 <!--<input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on">-->

@endsection

 @section('scripts')
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
<script type="text/javascript">
  function initialize() {

   var options = {
    types: ['(states)'],
    componentRestrictions: {country: "in"}
   };

   var input = document.getElementById('searchTextField');
   var autocomplete = new google.maps.places.Autocomplete(input, options);
  }
   google.maps.event.addDomListener(window, 'load', initialize);
</script>
 @endsection