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
                    @foreach($butype as $type)
                    <div class="radio">
                        <label>
                            <input type="radio" name="butype_{{$type->business_code}}" id="type1" value="{{$type->business_type}}"
                             @if($type->business_code=='RES') checked @endif   > {{$type->business_type}}
                        </label>
                    </div>
                    @endforeach

                    <div class="form-group">
                        <input type="text" class="form-control input-sm" placeholder="Name contains...">
                    </div>

                    <button class="btn btn-sm btn-primary">Search</button>
                </div>

                <hr>

                <!-- Delivery/Pickup -->
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#service">
                    <h5>Service Type</h5>
                </a>

                <div id="service" class="collapse in">
                    @foreach($servicetype as $key => $type)
                    <div class="radio">
                        <label>
                            <input type="radio" name="servicetype_{{$key}}" id="type1" value="{{$type}}"> {{ucfirst(strtolower($key))}}
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
                            <input type="checkbox" checked value=""> All
                        </label>
                    </div>
                    @foreach($cuisinetype as $type)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="cutype_{{$type->cuisine_code}}" value=""> {{$type->cuisine_description}}
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
                            <input type="checkbox" checked value=""> All
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> Cash
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> Visa
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> Mastercard
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> Discover
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> American Express
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> PayPal
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> Google Wallet
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> Apple Pay
                        </label>
                    </div>
                </div>

                <hr>

            </div>
        </div>
        <a href="#top" class="btn btn-link page-scroll"><i class="fa fa-fw fa-angle-up"></i> Back to Top</a>
    </div>
</div>