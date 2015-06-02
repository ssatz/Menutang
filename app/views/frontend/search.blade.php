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
                <?php $image='uploads/'.$buDetails->business_slug.'/logo75.png' ?>
                <td><img src="{{asset($image)}}" width="75" height="75"  title="{{$buDetails->business_name}}"
                         class="pull-left hidden-sm hidden-xs" alt="{{$buDetails->business_name}}">
                    <a href="{{action('FrontEndController@restaurantsProfile',[$buDetails->business_slug])}}"><h4>{{$buDetails->business_name}}</h4></a>
                    <p>
                        {{$buDetails->address->address_line_1}},{{$buDetails->address->address_line_2}} <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                    </p>
                    <p>
                        <i class="fa fa-clock-o"></i>
                        <?php $time=''; ?>
                        @foreach($buDetails->businessHours as $buHours)
                        <?php
                              $OpenTime= new \DateTime($buHours->open_time);
                              $closeTime= new \DateTime($buHours->close_time);
                                $time.= $OpenTime->format('g:i a').'-'.$closeTime->format('g:i a').',';
                            ?>
                        @endforeach
                        @replaceComma($time)
                    </p>
                    <div class="clearfix"></div>
                </td>
                <td>
                    <?php $type='';?>
                    @foreach($buDetails->cuisineType as $cuisines)
                    <?php $type.='<a href="#">'.$cuisines->cuisine_description.'</a>,'; ?>
                    @endforeach
                    @replaceComma($type)
                </td>
                <td>Fast</td>
                <td><span class="badge"><i class="fa fa-inr"></i>{{$buDetails->minimum_delivery_amt}}</span></td>
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
                    <a href="{{action('FrontEndController@restaurantsProfile',[$buDetails->business_slug])}}" class="btn btn-primary btn-xs">Order Now</a>
                </td>
            </tr>
            @endforeach
            </tbody>
            </table>
<hr>
{{$results->links('frontend._partials.pagination')}}
@endsection
