@extends('template.master')
@section('content')
    <div class="main" role="main">
        <div class="wrap clearfix">
            <div class="content clearfix">
            <!--breadcrumbs-->
            <nav role="navigation" class="breadcrumbs clearfix">
                <!--crumbs-->
                <ul class="crumbs">
                    <li><a href="#" title="Home">Home</a></li>
                    <li><a href="#" title="Hotels">Hotels</a></li>
                    <li><a href="#" title="United Kingdom">United Kingdom</a></li>
                    <li><a href="#" title="London">London</a></li>
                    <li>Search results</li>
                </ul>
                <!--//crumbs-->

                <!--top right navigation-->
                <ul class="top-right-nav">
                    <li><a href="search_results.html" title="Back to results">Back to results</a></li>
                    <li><a href="#" title="Change search">Change search</a></li>
                </ul>
                <!--//top right navigation-->
            </nav>
            <!--//breadcrumbs-->
            <section class="three-fourth">
                <!--gallery-->
            <?php
                $images = json_decode($hotel->images);
            ?>
                <section class="gallery" id="crossfade">
                    @foreach($images as $image)
                        <img src="{!! asset('resources/upload/imagehotel/'.$image) !!}" alt="" width="850" height="531" />
                    @endforeach
                </section>
                <!--//gallery-->

                <!--inner navigation-->
                <nav class="inner-nav">
                    <ul>
                        <li class="availability"><a href="#availability" title="Availability">Availability</a></li>
                        <li class="description"><a href="#description" title="Description">Description</a></li>
                        <li class="facilities"><a href="#facilities" title="Facilities">Facilities</a></li>
                        <li class="location"><a href="#location" title="Location">Location</a></li>
                        <li class="reviews"><a href="#reviews" title="Reviews">Reviews</a></li>
                    </ul>
                </nav>
                <!--//inner navigation-->

                <!--availability-->
                <section id="availability" class="tab-content">
                    <article>
                        <h1 id="hotelid" data-id="{!! $hotel->id !!}" data-star="{!! $hotel->star !!}" data-location="{!! $hotel->location !!}">{!! $hotel->name !!}</h1>
                        <div class="text-wrap">
                            <a href="#" class="gradient-button right" title="Change dates">Change dates</a>
                            <p>Available rooms from <span class="date">Thurs 29 Nov 2012</span> to <span class="date">Fri 30 Nov 2012</span>.</p>
                        </div>

                        <h1>Room types</h1>
                        <!--room-->
                        <ul class="room-types">

                           @foreach($listrooms as $room)
                            <li>
                                <figure class="left"><img src="{!! asset('resources/upload/imageroom/'.$room->images) !!}" alt="" width="270" height="152" /><a href="{!! asset('resources/upload/imageroom/'.$room->images) !!}" class="image-overlay" rel="prettyPhoto[gallery1]"></a></figure>
                                <div class="meta">
                                    <h2>{!! $room->name !!}</h2>
                                    <p>Prices are per room<br />20 % VAT Included in price</p>
                                    <p>Non-refundable<br />Full English breakfast $ 24.80 </p>
                                    <a href="javascript:void(0)" title="more info" class="more-info">+ more info</a>
                                </div>
                                <div class="room-information">
                                    <div class="row">
                                        <span class="first">Max:</span>
                                        <span class="second">
                                            @for($i = 0;$i<$room->maxperson;$i++)
                                                <img src="{!! url('public/template/images/ico/person.png') !!}" alt="" />
                                            @endfor

                                        </span>

                                    </div>
                                    <div class="row" style="width: 130px">
                                        <span class="first">Price:</span>
                                        <span class="second" style="width: 50px">$ {!! $room->price !!}</span>
                                    </div>
                                    <a href="javascript:void(0)" class="gradient-button calendar" data-token="{!! csrf_token() !!}" data-id="{!! $room->id !!}" data-type="bookhotel" title="Select Date">Select Date</a><br/>

                                </div>
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <div class="more-information">
                                    <p>Stylish and individually designed room featuring a satellite TV, mini bar and a 24-hour room service menu.</p>
                                    <p><strong>Bed Size(s):</strong> 1 Double </p>
                                    <p><strong>Room Size:</strong>  16 square metres</p>
                                    <p><strong>Room Facilities:</strong><br/>
                                    @foreach($roomsfac as $key=>$roomfac)
                                        @if($key == $room->id)
                                            @for($i=0;$i<count($roomfac);$i++)
                                                @foreach($roomfac[$i] as $val)
                                                    @if($val->images !="")
                                                        <img style="float: left;margin-left: 10px" title="{!! $val->name !!}" width="35px" height="35px"  src="{!! asset('/resources/upload/thumbfac/'.$val->images) !!}" />
                                                    @else
                                                        <i title="{!! $val->name !!}" style="font-size:35px;margin-left: 10px"  class="ace-icon fa {!! $val->icon !!}"></i>
                                                    @endif
                                                @endforeach
                                            @endfor
                                        @endif
                                    @endforeach
                                    </p><br/>
                                </div>
                                <div style="padding-top:200px" id="frontend{!! $room->id !!}" display="none";></div>
                            </li>
                             <input type="hidden" name="_token" value="{!! csrf_token()!!}"/>
                           @endforeach

                             </ul>
                        <!--//room-->
                    </article>
                </section>
                <!--//availability-->

                <!--description-->
                <section id="description" class="tab-content">
                    <article>
                        <h1>General</h1>
                        <div class="text-wrap">
                            <p>{!! $hotel->des !!}</p>
                        </div>

                        <h1>Check-in</h1>
                        <div class="text-wrap">
                            <p>From {!! $hotel->checkin !!} hours </p>
                        </div>

                        <h1>Check-out</h1>
                        <div class="text-wrap">
                            <p>Untill {!! $hotel->checkout !!} hours </p>
                        </div>

                        <h1>Children and extra beds</h1>
                        <div class="text-wrap">
                            <p>{!! $hotel->extrarule !!}</p>
                        </div>

                        <h1>Pets</h1>
                        <div class="text-wrap">
                            <p>{!! $hotel->pet !!}</p>
                        </div>

                        <h1>Accepted credit cards</h1>
                        <div class="text-wrap">
                            <span style="float: left">
                            <?php
                                    $url = url('public/template/images/ico/');
                                $payment = $hotel->payment;
                                if(strpos($payment,'1')){echo '<img style ="float:left;margin-left:5px;" img src="'.$url.'/paylater.png"/>';}
                                if(strpos($payment,'2')){echo '<img style ="float:left;margin-left:5px" src="'.$url.'/visa.png"/>';}
                                if(strpos($payment,'3')){echo '<img style ="float:left;margin-left:5px" src="'.$url.'/master.png"/>';}
                                if(strpos($payment,'4')){echo '<img style ="float:left;margin-left:5px" src="'.$url.'/amex.png"/>';}
                                if(strpos($payment,'5')){echo '<img style ="float:left;margin-left:5px" src="'.$url.'/discover.png"/>';}
                                if(strpos($payment,'6')){echo '<img style ="float:left;margin-left:5px" src="'.$url.'/paypal.png"/>';}
                                if(strpos($payment,'7')){echo '<img style ="float:left;margin-left:5px" src="'.$url.'/banktransfer.png"/>';}
                            ?>
                            </span>
                        </div>
                    </article>
                </section>
                <!--//description-->

                <!--facilities-->
                <section id="facilities" class="tab-content">
                    <article>
                        <h1>Facilities</h1>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr align="center" >
                                <th style="text-align: center;" >Name</th>
                                <th style="text-align: center;" >Image</th>
                            </tr>
                            </thead>
                            <tbody>

                            @for($i=0;$i <count($hotelfac);$i++)
                                @foreach($hotelfac[$i] as $item)
                                    <tr class="odd gradeX" align="center">
                                        <td>{!! $item->name !!}</td>
                                        <td>
                                            @if($item->images !="")
                                            <img src="{!! asset('/resources/upload/thumbfac/'.$item->images) !!}" />
                                            @else
                                                <i style="font-size:50px;" class="ace-icon fa {!! $item->icon !!}"></i>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            @endfor
                            </tbody>
                        </table>
                    </article>
                </section>
                <!--//facilities-->

                <!--location-->
                <section id="location" class="tab-content">
                    <article>
                        <!--map-->
                        <div class="gmap" id="map_canvas">{!! $hotel->map !!}</div>
                        <!--//map-->
                    </article>
                </section>
                <!--//location-->

                <!--reviews-->
                <section id="reviews" class="tab-content">
                    <article>
                        <h1>Hotel Score and Score Breakdown</h1>
                        <div class="score">
                            <span class="achieved">8 </span>
                            <span> / 10</span>
                            <p class="info">Based on 782 reviews</p>
                            <p class="disclaimer">Guest reviews are written by our customers <strong>after their stay</strong> at Hotel Best Ipsum.</p>
                        </div>

                        <dl class="chart">
                            <dt>Clean</dt>
                            <dd><span id="data-one" style="width:80%;">8&nbsp;&nbsp;&nbsp;</span></dd>
                            <dt>Comfort</dt>
                            <dd><span id="data-two" style="width:60%;">6&nbsp;&nbsp;&nbsp;</span></dd>
                            <dt>Location</dt>
                            <dd><span id="data-three" style="width:80%;">8&nbsp;&nbsp;&nbsp;</span></dd>
                            <dt>Staff</dt>
                            <dd><span id="data-four" style="width:100%;">10&nbsp;&nbsp;&nbsp;</span></dd>
                            <dt>Services</dt>
                            <dd><span id="data-five" style="width:70%;">7&nbsp;&nbsp;&nbsp;</span></dd>
                            <dt>Value for money</dt>
                            <dd><span id="data-six" style="width:90%;">9&nbsp;&nbsp;&nbsp;</span></dd>
                        </dl>
                    </article>

                    <article>
                        <h1>Guest reviews</h1>
                        <ul class="reviews">
                            <!--review-->
                            <li>
                                <figure class="left"><img src="images/uploads/avatar.jpg" alt="avatar" /></figure>
                                <address><span>Anonymous</span><br />Solo Traveller<br />Norway<br />22/06/2012</address>
                                <div class="pro"><p>It was a warm friendly hotel. Very easy access to shops and underground stations. Staff very welcoming.</p></div>
                                <div class="con"><p>noisy neigbourghs spoilt the rather calm environment</p></div>
                            </li>
                            <!--//review-->

                            <!--review-->
                            <li>
                                <figure class="left"><img src="images/uploads/avatar.jpg" alt="avatar" /></figure>
                                <address><span>Anonymous</span><br />Solo Traveller<br />Norway<br />22/06/2012</address>
                                <div class="pro"><p>It was a warm friendly hotel. Very easy access to shops and underground stations. Staff very welcoming.</p></div>
                                <div class="con"><p>noisy neigbourghs spoilt the rather calm environment</p></div>
                            </li>
                            <!--//review-->

                            <!--review-->
                            <li>
                                <figure class="left"><img src="images/uploads/avatar.jpg" alt="avatar" /></figure>
                                <address><span>Anonymous</span><br />Solo Traveller<br />Norway<br />22/06/2012</address>
                                <div class="pro"><p>It was a warm friendly hotel. Very easy access to shops and underground stations. Staff very welcoming.</p></div>
                                <div class="con"><p>noisy neigbourghs spoilt the rather calm environment</p></div>
                            </li>
                            <!--//review-->

                            <!--review-->
                            <li>
                                <figure class="left"><img src="images/uploads/avatar.jpg" alt="avatar" /></figure>
                                <address><span>Anonymous</span><br />Solo Traveller<br />Norway<br />22/06/2012</address>
                                <div class="pro"><p>It was a warm friendly hotel. Very easy access to shops and underground stations. Staff very welcoming.</p></div>
                                <div class="con"><p>noisy neigbourghs spoilt the rather calm environment</p></div>
                            </li>
                            <!--//review-->

                            <!--review-->
                            <li>
                                <figure class="left"><img src="images/uploads/avatar.jpg" alt="avatar" /></figure>
                                <address><span>Anonymous</span><br />Solo Traveller<br />Norway<br />22/06/2012</address>
                                <div class="pro"><p>It was a warm friendly hotel. Very easy access to shops and underground stations. Staff very welcoming.</p></div>
                                <div class="con"><p>noisy neigbourghs spoilt the rather calm environment</p></div>
                            </li>
                            <!--//review-->
                        </ul>
                    </article>
                </section>
                <!--//reviews-->

                <!--things to do-->
                <!--//things to do-->
            </section>
            <!--//hotel content-->
    </div>
    </div>
@endsection