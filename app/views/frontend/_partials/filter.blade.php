<?php use Services\SearchEnum;
$all = SearchEnum::ALL();
?>

<div class="col-lg-2 col-md-2 col-sm-3 hidden-xs">
    <!-- Menu Navigation -->
    <div class="search-side-menu side-menu">

        <div class="refine-search">
            <div class="well">

                <!-- Refine Header -->
                <h4>Filter Results</h4>
                <small><a href="#reset" id="reset-filter">Reset</a></small>

                <hr>

                <!-- Filter by Cuisine -->
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#cuisine">
                    <h5>Select Cuisine</h5>
                </a>
                <div id="cuisine" class="collapse in">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="all-filter" name="cuisineType" @if(preg_match('/'.$all.'/i',Input::get('cuisineType')) || !Input::get('cuisineType')) checked @endif value="{{$all}}"> All
                        </label>
                    </div>
                    @foreach($cuisinetype as $type)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="cuisineType" @if(preg_match('/'.$type->cuisine_code.'/',Input::get('cuisineType'))) checked @endif  value="{{$type->cuisine_code}}"> {{$type->cuisine_description}}
                        </label>
                    </div>
                    @endforeach
                    <small><a href="#">+ More</a></small>
                </div>

                <hr>

                <!-- Delivery/Pickup -->
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#service">
                    <h5>Service Type</h5>
                </a>

                <div id="service" class="collapse in">
                    <div class="radio">
                        <label>
                            <input type="radio" class="all-filter" name="serviceType" @if(Input::get('serviceType')==$all || !Input::get('serviceType')) checked @endif  value="{{$all}}"> All
                        </label>
                    </div>
                    @foreach($servicetype as $key => $type)
                    <div class="radio">
                        <label>
                            <input type="radio" name="serviceType" @if(Input::get('serviceType')==ucfirst(strtolower($key))) checked @endif   value="{{$type}}"> {{ucfirst(strtolower($key))}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <hr>

                <!-- Filter by Payment Method -->
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#payment">
                    <h5>Payment Method</h5>
                </a>
                <div id="payment" class="collapse @if(Input::get('paymentType')) in @endif">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="all-filter" name="paymentType" @if(preg_match('/'.$all.'/i',Input::get('paymentType')) || !Input::get('paymentType'))
                                   checked @endif  value="{{$all}}"> All
                        </label>
                    </div>
                    @foreach($paymenttype as $type)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="paymentType" @if(preg_match('/'.$type->payment_code.'/',Input::get('paymentType')))  checked @endif  value="{{$type->payment_code}}"> {{ucfirst($type->payment_description)}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <hr>

            </div>
        </div>
        <a href="#top" class="btn btn-link page-scroll"><i class="fa fa-fw fa-angle-up"></i> Back to Top</a>
    </div>
</div>
@section('scripts')
function getUrlVars()
{
var vars = [], hash;
var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
for(var i = 0; i < hashes.length; i++)
{
hash = hashes[i].split('=');
vars.push(hash[0]);
vars[hash[0]] = hash[1];
}
return vars;
}
$(function() {
    $("#reset-filter").click(function(e){
        e.preventDefault();
        var url=window.location.href.split("?")[0];
        window.location.href =url;
    });
    $("input[type='radio']").change(function() {
        var url=window.location.href,
        seperator = (url.indexOf("?")===-1)?"?":"";
        var pattern = new RegExp($(this).prop('name')+'(.*?)&','g');
        var newUrl=url;
        if(pattern.test(url)){
        newUrl=url.replace(pattern,$(this).prop('name')+'='+$(this).val()+'&');
        }
        else{
        newParam=seperator + $(this).prop('name')+'='+ $(this).val()+'&';
        newUrl+=newParam;
        }
        window.location.href =newUrl;
    });
    $("input[type='checkbox']").change(function() {
           var value = $(this).val();
            var url=window.location.href,
            seperator = (url.indexOf("?")===-1)?"?":"";
           var newUrl;
            if(value.toLowerCase()=='all' || getUrlVars()[$(this).prop('name')] ==undefined)
            {
                    var pattern =  new RegExp('('+$(this).prop('name')+'.*?)&','g')
                    if(pattern.test(url)){
                        url =  url.replace(pattern,'');
                    }
                newParam =seperator + $(this).prop('name')+'='+ $(this).val()+'&';
                url+=newParam;
                newUrl = url;
            }
            else{
                var alValue = getUrlVars()[$(this).prop('name')];
                var pattern =  new RegExp('('+value+',?|$)','g')
                if(pattern.test(alValue)){
                    alValue =  alValue.replace(pattern,'');
                }
                var newPattern = new RegExp($(this).prop('name')+'(.*?)&','g');
                if($(this).is(':checked')){
                    newParam = alValue+','+value;
                    newUrl =    url.replace(newPattern,$(this).prop('name')+'='+newParam+'&');
                }
                else{
                    newParam = alValue;
                    newUrl =    url.replace(newPattern,$(this).prop('name')+'='+newParam+'&');
                }
            }
        window.location.href =newUrl;
    });
});
@endsection