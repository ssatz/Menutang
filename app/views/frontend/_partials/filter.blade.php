<div class="col-lg-2 col-md-2 col-sm-3 hidden-xs">
    <!-- Menu Navigation -->
    <div class="search-side-menu side-menu">

        <div class="refine-search">
            <div class="well">

                <!-- Refine Header -->
                <h4>Filter Results</h4>
                <small><a href="#">Reset</a></small>

                <hr>

                <!-- Search by Type -->
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#type">
                    <h5>Search by Type</h5>
                </a>

                <div id="type" class="collapse in">
                    <div class="radio">
                        <label>
                            <input type="radio" name="buType"  value="All"
                                   @if(Input::get('buType')=='All' || !Input::get('buType')) checked @endif   >All
                        </label>
                    </div>
                    @foreach($butype as $type)
                    <div class="radio">
                        <label>
                            <input type="radio" name="buType" id="type1" value="{{$type->business_code}}"
                             @if(Input::get('buType')==$type->business_code) checked @endif   > {{$type->business_type}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <hr>

                <!-- Delivery/Pickup -->
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#service">
                    <h5>Service Type</h5>
                </a>

                <div id="service" class="collapse in">
                    <div class="radio">
                        <label>
                            <input type="radio" name="serviceType" @if(Input::get('serviceType')=='All' || !Input::get('serviceType')) checked @endif  value="All"> All
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

                <!-- Filter by Cuisine -->
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#cuisine">
                    <h5>Select Cuisine</h5>
                </a>
                <div id="cuisine" class="collapse in">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="cuisineType" @if(Input::get('cuisineType')) checked @endif value="all"> All
                        </label>
                    </div>
                    @foreach($cuisinetype as $type)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="cuisineType"  value="{{$type->cuisine_code}}"> {{$type->cuisine_description}}
                        </label>
                     </div>
                    @endforeach
                    <small><a href="#">+ More</a></small>
                </div>

                <hr>

                <!-- Filter by Payment Method -->
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#payment">
                    <h5>Payment Method</h5>
                </a>
                <div id="payment" class="collapse">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="paymentType" checked value="all"> All
                        </label>
                    </div>
                    @foreach($paymenttype as $type)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="paymentType"  value="{{$type->payment_code}}"> {{ucfirst($type->payment_description)}}
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
            if(getUrlVars()[$(this).prop('name')] ==undefined || value=='All')
            {
                newParam =seperator + $(this).prop('name')+'='+ $(this).val()+'&';
                url+=newParam;
                newUrl = url;
            }
            else{
                var alValue = getUrlVars()[$(this).prop('name')];
                var pattern =  new RegExp('('+value+',?|$)','g')
                if(pattern.test(alValue)){
                    alValue =  alValue.replace(pattern,'');
                    alert(alValue);
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