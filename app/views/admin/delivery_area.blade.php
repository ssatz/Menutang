@extends('admin._layout')

@section('content')
<div class="panel-heading">
    Delivery Area
</div>
{{ Form::open(['route' =>'admin.delivery-area', 'method'
=>'POST','class'=>'form-horizontal']) }}
<div class="padding-md clearfix">
    <table class="table table-responsive">
        <thead>
        <th>Area</th>
        <th>Pincode
        <th></th>
        </thead>
        <tbody>
        @foreach($deliveryarea as $areas)
        <tr id="id-{{$areas->id}}">
            <td>{{$areas->area}} </td>
            <td>{{$areas->area_pincode}} </td>
            <td><button class="btn-info btn btn-sm edit-area">Edit</button></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">{{$deliveryarea->links()}}</div>
    {{Form::close()}}

</div>
@endsection

@section('css')
<link href="{{asset('assets/common/css/gritter/jquery.gritter.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{asset('assets/common/js/typeahead.bundle.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var $currentObject;
       $(".edit-area").click(function(e){
           e.preventDefault();
           var $html = '<input  class="input-sm form-control" type="text">';
           $(this).closest("tr").find("td:eq(0)").html($html);
           $(this).closest("tr").find("td:eq(1)").html($html);
           $currentObject=this;
           var $input=$(this).closest("tr").find("td:eq(0) input");
           var autocomplete = new google.maps.places.Autocomplete($($input)[0], {
               componentRestrictions: {country: "in"}
           });
           google.maps.event.addListener(autocomplete, 'place_changed', function() {
               notification('Notification', 'Please Wait..', 'gritter-info');
               var place = autocomplete.getPlace();
               var $token = '{{ Session::token() }}';
               var query =  place.address_components[0].long_name;
               $data={
                 search_query : query,
                   _token: $token
               };
               ajax('{{action('AdminAuthController@addOrUpdateDeliveryArea')}}', 'POST', $data, 'json', function (msg) {
                   if(msg.ResponseCode==0) {
                       $($currentObject).closest("tr").find("td:eq(1) input").val(msg.Data[0].Pincode);
                       notification('Notification', 'Pincode retrived Sucessfully', 'gritter-success');
                   }
                   else{
                       notification('Notification', 'Pincode not Available', 'gritter-error');
                   }
               });
           });
           $(this).text("update");
       });

    });
</script>
@endsection