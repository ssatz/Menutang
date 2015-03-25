@extends('admin._layout')

@section('content')
<div class="panel-heading">
    Delivery Area
</div>
{{ Form::open(['route' =>'admin.delivery-area', 'method'=>'POST','class'=>'form-horizontal']) }}
<div class="padding-md clearfix">
    <div class="row">
        <div class="col-lg-4">
            @if(Session::has("message"))
            <div class="alert alert-success">{{Session::get("message")}}</div>
            @endif
            @if($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
        </div>
    </div>
        <table class="table table-responsive delivery-Area">
            <tr>
                <td><input  class="input-sm form-control" name="area" id="area-add" type="text" placeholder="Area name"></td>
                <td><input  class="input-sm form-control" id="area-pincode" name="pincode" type="text" placeholder="pincode"></td>
                <td><select class="form-control chzn-select"  name="city_id" id="area-city" data-required="true">
                        <option value="">-- select --</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_description}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button class="btn-info btn btn-sm add-area-btn">Add</button>
                </td>
            </tr>
        </table>
    </div>
<div class="padding-md clearfix">
    <table class="table table-responsive city-table">
        <thead>
        <th>Area</th>
        <th>Pincode</th>
        <th>City</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($deliveryarea as $areas)
        <tr id="id-{{$areas->id}}">
            <td>{{$areas->area}} </td>
            <td>{{$areas->area_pincode}}</td>
            <td>
                <select class="form-control chzn-select"  name="city" data-required="true">
                    <option value="-1">-- select --</option>
                    @foreach($cities as $city)
                    <option value="{{$city->id}}" @if($city->id==$areas->city->id)selected @endif>{{$city->city_description}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <button class="btn-info btn btn-sm edit-area">Edit</button>
                <button class="btn-info btn btn-sm update-area displayNone">Update</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
{{Form::close()}}
    <div class="text-center">{{$deliveryarea->links()}}</div>


</div>
@endsection

@section('css')
<link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/gritter/jquery.gritter.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{asset('assets/common/js/typeahead.bundle.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var $currentObject;
        $(".chzn-select").chosen();
        $("body").on("click",".edit-area",function(e){
           e.preventDefault();
           var $area = $.trim($(this).closest("tr").find("td:eq(0)").text());
            var $pincode = $.trim($(this).closest("tr").find("td:eq(1)").text());
           var $html = '<input  class="input-sm form-control" type="text">';
           $(this).closest("tr").find("td:eq(0)").html($html).find("input").val($area);
           $(this).closest("tr").find("td:eq(1)").html($html).find("input").val($pincode);
           $currentObject=this;
           var $input=$(this).closest("tr").find("td:eq(0) input");
           var autocomplete = new google.maps.places.Autocomplete($($input)[0], {
               componentRestrictions: {country: "in"}
              // types: ['(cities)']
           });
           google.maps.event.addListener(autocomplete, 'place_changed', function() {
               notification('Notification', 'Please Wait..', 'gritter-info');
               var place = autocomplete.getPlace();
               var $token = '{{ Session::token() }}';
               var query =  place.address_components[0].long_name;
               var $locality ;
               var $html = $.parseHTML((place.adr_address).replace(/,/g , ""));
               $.each( $html, function( i, el ) {
                    if($(el).hasClass('locality')){
                        $locality = $(el).html();
                    }
               });
               var city = place.address_components[1].long_name;
               $data={
                 search_query : query,
                   _token: $token
               };
               ajax('{{action('AdminAuthController@addOrUpdateDeliveryArea')}}', 'POST', $data, 'json', function (msg) {
                   if(msg.pincode!='') {
                       $($currentObject).closest("tr").find("td:eq(1) input").val(msg.pincode);
                      $($currentObject).closest('tr').find(".chzn-select option").filter(function(){
                           return $.trim($(this).text().toLowerCase()) == $.trim($locality.toLowerCase());
                      }).prop('selected', true);
                       $($currentObject).closest('tr').find(".chzn-select").trigger("chosen:updated");
                       notification('Notification', 'Pincode retrived Sucessfully', 'gritter-success');
                   }
                   else{
                       notification('Notification', 'Pincode not Available', 'gritter-error');
                   }
               });
           });
           $(this).hide();
           $(this).closest("td").find(".update-area").show();
       });

        $("body").on("click",".update-area",function(e){
            e.preventDefault();
            $currentObject=this;
            var $token = '{{ Session::token() }}';
            var $area  = $(this).closest("tr").find("td:eq(0) input").val().split(",")[0];
            var $pincode = $(this).closest("tr").find("td:eq(1) input").val();
            var $deliveryID = $(this).closest("tr").prop("id").split("-")[1];
            var $city =  $(this).closest("tr").find(".chzn-select").val();
            $data={
                action : 'update',
                area   : $area,
                pincode:$pincode,
                delivery_id:$deliveryID,
                city_id : $city,
                _token: $token
            };
            ajax('{{action('AdminAuthController@addOrUpdateDeliveryArea')}}', 'POST', $data, 'json', function (msg) {
                    if(msg=="true") {
                        $($currentObject).closest("tr").find("td:eq(0)").text($area);
                        $($currentObject).closest("tr").find("td:eq(1)").text($pincode);
                        $($currentObject).hide( );
                        $($currentObject).closest("td").find(".edit-area").show('slow');
                        notification('Notification', 'Area and Pincode updated sucessfully', 'gritter-info');
                    }
                    else{
                        var error="" ;
                        $.each(msg,function(index,value){
                            error+= msg[index][0]+"<br/>"
                        });
                        notification('Error', error, 'gritter-info');
                    }
            });
        });
        var autocomplete = new google.maps.places.Autocomplete($("#area-add")[0], {
            componentRestrictions: {country: "in"}
            // types: ['(cities)']
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            notification('Notification', 'Please Wait..', 'gritter-info');
            var place = autocomplete.getPlace();
            var $token = '{{ Session::token() }}';
            var query =  place.address_components[0].long_name;
            var $locality ;
            var $html = $.parseHTML((place.adr_address).replace(/,/g , ""));
            $.each( $html, function( i, el ) {
                if($(el).hasClass('locality')){
                    $locality = $(el).html();
                }
            });
            var city = place.address_components[1].long_name;
            $data={
                search_query : query,
                _token: $token
            };
            ajax('{{action('AdminAuthController@addOrUpdateDeliveryArea')}}', 'POST', $data, 'json', function (msg) {
                if(msg.pincode!='') {
                    $("#area-add").val(query);
                    $("#area-pincode").val(msg.pincode);
                    $("#area-pincode option").filter(function(){
                        return $.trim($(this).text().toLowerCase()) == $.trim($locality.toLowerCase());
                    }).prop('selected', true);
                    $(".chzn-select").trigger("chosen:updated");
                    notification('Notification', 'Pincode retrived Sucessfully', 'gritter-success');
                }
                else{
                    notification('Notification', 'Pincode not Available', 'gritter-error');
                }
            });
        });
    });
</script>
@endsection