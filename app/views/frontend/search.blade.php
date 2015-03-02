@extends('frontend._layout')

@section('content')
        <table class="table result">
            <thead>
            <tr>
                <th>Name <i class="fa fa-sort"></i>
                </th>
                <th>Cuisine <i class="fa fa-sort"></i>
                </th>
                <th>Speed <i class="fa fa-sort"></i>
                </th>
                <th>Min. Order <i class="fa fa-sort"></i>
                </th>
                <th>Promotions <i class="fa fa-sort"></i>
                </th>
                <th>Rating <i class="fa fa-sort"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $buDetails)
            <tr>
                <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                    <a href="#"><h4>{{$buDetails->business_name}}</h4></a>
                    <p>
                        {{$buDetails->address->address_line_1}},{{$buDetails->address->address_line_2}} <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                    </p>
                    <p>
                        <i class="fa fa-clock-o"></i>
                        @foreach($buDetails->businessHours as $buHours)
                                    @formattime($buHours->open_time)
                                        -
                                    @formattime($buHours->close_time),
                        @endforeach
                    </p>
                    <div class="clearfix"></div>
                </td>
                <td>@foreach($buDetails->cuisineType as $cuisines)
                    {{ $cuisines->cuisine_description}},
                    @endforeach
                </td>
                <td>Fast</td>
                <td>{{$buDetails->minimum_delivery_amt}}</td>
                <td>
                    <ul class="list-unstyled">
                        <li>First Order</li>
                        <li>Meal Deals</li>
                        <li>10th Free</li>
                    </ul>
                </td>
                <td>
                    <a href="#">4 Reviews</a>
                    <div class="text-yellow">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                </td>
            </tr>
            @endforeach
            </tbody>
            </table>

@endsection