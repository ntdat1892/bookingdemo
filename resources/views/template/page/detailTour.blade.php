@extends('template.master')
@section('content')
    <div class="main" role="main">
        <div class="wrap clearfix">
            <!--main content-->
            <div class="content clearfix">
                <!--breadcrumbs-->
                <nav role="navigation" class="breadcrumbs clearfix">
                    <!--crumbs-->
                    <ul class="crumbs">
                        <li><a href="#" title="Home">Home</a></li>
                        <li><a href="#" title="Travel guides">Travel guides</a></li>
                        <li>London</li>
                    </ul>
                    <!--//crumbs-->

                </nav>
                <!--//breadcrumbs-->

                <!--three-fourth content-->
                <section class="three-fourth">
                    <!--gallery-->
                    <?php
                    $images = json_decode($tour->images);
                    ?>
                    <section class="gallery" id="crossfade">
                        @foreach($images as $image)
                            <img src="{!! asset('resources/upload/imagetour/'.$image) !!}" alt="" width="850" height="531" />
                        @endforeach
                    </section>
                    <!--//gallery-->

                    <!--inner navigation-->
                    <nav class="inner-nav">
                        <ul>
                            <li><a href="#general_info" title="General information">General information</a></li>
                            <li><a href="#sports_and_nature" title="Sports and nature">Sports and nature</a></li>
                            <li><a href="#nightlife" title="Nightlife">Nightlife</a></li>
                            <li><a href="#culture" title="Culture and history">Culture and history</a></li>
                            <li><a href="#hotels" title="Hotels">Hotels</a></li>
                            <li><a href="#car_rental" title="Car rental">Car rental</a></li>
                        </ul>
                    </nav>
                    <!--//inner navigation-->

                    <!--General information-->
                    <section id="general_info" class="tab-content">
                        <article>
                            <h1>{!! $tour->name."- Basic Information"!!}</h1>

                            <table>
                                <tr>
                                    <th>Country</th>
                                    <td>{!! $tour->name !!}</td>
                                </tr>
                                <tr>
                                    <th>Area</th>
                                    <td>{!! $tour->area !!} km2 (607 sq mi)</td>
                                </tr>
                                <tr>
                                    <th>Time zone</th>
                                    <td>{!! $tour->timezone !!}</td>
                                </tr>
                                <tr>
                                    <th>Languages spoken</th>
                                    <td>{!! $tour->language !!}</td>
                                </tr>
                                <tr>
                                    <th>Currency</th>
                                    <td>{!! $tour->currency !!}</td>
                                </tr>
                                <tr>
                                    <th>Visa requirements</th>
                                    <td>
                                        @if($tour->visa == 1)
                                            {!! "Visa needed" !!}
                                        @else
                                            {!! "No Visa needed" !!}
                                        @endif

                                    </td>
                                </tr>
                            </table>
                        </article>
                    </section>
                    <!--//General information-->
                    <?php

                    $smallimg = reset($images);
                    ?>
                    <!--Sports and nature-->
                    <section id="sports_and_nature" class="tab-content">
                        <article>

                            <h1>Sports and nature</h1>
                            <figure class="left_pic"><img src="{!! asset('resources/upload/imagetour/'.$smallimg) !!}" alt="Things to do - London Sports and nature" /></figure>
                            {!! $tour->nature !!}
                        </article>
                    </section>
                    <!--//Sports and nature-->

                    <!--Nightlife-->
                    <section id="nightlife" class="tab-content">
                        <article>
                            <h1>Nightlife</h1>
                            <figure class="left_pic"><img src="{!! asset('resources/upload/imagetour/'.$smallimg) !!}" alt="Things to do - London Sports and nature" /></figure>
                            {!! $tour->nightlife !!}
                        </article>
                    </section>
                    <!--//Nightlife-->

                    <!--Culture and history-->
                    <section id="culture" class="tab-content">
                        <article>
                            <h1>Culture and history</h1>
                            <figure class="left_pic"><img src="{!! asset('resources/upload/imagetour/'.$smallimg) !!}" alt="Things to do - London Sports and nature" /></figure>
                           {!! $tour->history !!}
                        </article>
                    </section>
                    <!--//Culture and history-->

                    <!--Hotels-->
                    <section id="hotels" class="tab-content">

                        <div class="deals">
                            @foreach($hotels as $hotel)
                            <!--deal-->
                            <article class="full-width">
                                <?php
                                    $hotelimg = json_decode($hotel->images);
                                    $hotelimg = reset($hotelimg);
                                ?>
                                <figure><a href="hotel.html" title=""><img src="{!! asset('resources/upload/imagehotel/'.$hotelimg) !!}" alt="" width="270" height="152" /></a></figure>
                                <div class="details">
                                    <h1>{!! $hotel->name !!}
										<span class="stars">
                                            @for($i = 0;$i<$hotel->star;$i++)
											<img src="{!! asset('public/template/images/ico/star.png') !!}" alt="" />
                                            @endfor
										</span>
                                    </h1>
                                    <span class="address">{!! $hotel->location !!}  �  <a href="#">Show on map</a></span>
                                    <span class="rating"> 8 /10</span>
                                    <span class="price">Price per room per night from  <em>
                                            <?php
                                            $price = \App\Room::select('price')->where('hotel_id',$hotel->id)->orderBy('price', 'asc')->get()->first();
                                            echo "$ ".$price['price'];
                                            ?>
                                        </em> </span>
                                    <div class="description">
                                        {!! str_limit($hotel->des, $limit = 200)!!}


                                        <a href="{!! url('template/hotel',$hotel->id) !!}">More info</a>
                                    </div>
                                    <a href="hotel.html" title="Book now" class="gradient-button">Book now</a>
                                </div>
                            </article>
                        @endforeach
                            <!--//deal-->
                            <!--bottom navigation-->
                            <div class="bottom-nav">
                                <!--back up button-->
                                <a href="#" class="scroll-to-top" title="Back up">Back up</a>
                                <!--//back up button-->

                                <!--pager-->
                                <div class="pager">
                                    <span><a href="#">First page</a></span>
                                    <span><a href="#">&lt;</a></span>
                                    <span class="current">1</span>
                                    <span><a href="#">2</a></span>
                                    <span><a href="#">3</a></span>
                                    <span><a href="#">4</a></span>
                                    <span><a href="#">5</a></span>
                                    <span><a href="#">&gt;</a></span>
                                    <span><a href="#">Last page</a></span>
                                </div>
                                <!--//pager-->
                            </div>
                            <!--//bottom navigation-->
                        </div>
                    </section>
                    <!--//Hotels-->
                    <!--Car rental-->
                    <section id="car_rental" class="tab-content">
                        <div class="deals">
                            <!--deal-->
                            @foreach($cars as $car)
                            <article class="full-width">
                                <?php
                                    $listimgcar = json_decode($car->images);
                                    $imgcar = reset($listimgcar);
                                        ?>
                                <figure><a href="#" title=""><img src="{!! asset('resources/upload/imagecar/'.$imgcar) !!}" alt="" width="270" height="152" /></a></figure>
                                <div class="details">
                                    <h1>{!! $car->name !!}</h1>
                                    <span class="price">Price per day from  <br /><em>$ {!! $car->price !!}</em> </span>
                                    <div class="description">
                                        <p>{!! $car->des !!} <a href="{!! url('template/car',$car->id) !!}">More info</a></p>
                                    </div>
                                    <a href="{!! url('template/car',$car->id) !!}" title="Book now" class="gradient-button">Book now</a>
                                </div>
                            </article>
                            @endforeach
                            <!--//deal-->
                            <!--bottom navigation-->
                            <div class="bottom-nav">
                                <!--back up button-->
                                <a href="#" class="scroll-to-top" title="Back up">Back up</a>
                                <!--//back up button-->

                                <!--pager-->
                                <div class="pager">
                                    <span><a href="#">First page</a></span>
                                    <span><a href="#">&lt;</a></span>
                                    <span class="current">1</span>
                                    <span><a href="#">2</a></span>
                                    <span><a href="#">3</a></span>
                                    <span><a href="#">4</a></span>
                                    <span><a href="#">5</a></span>
                                    <span><a href="#">&gt;</a></span>
                                    <span><a href="#">Last page</a></span>
                                </div>
                                <!--//pager-->
                            </div>
                            <!--//bottom navigation-->
                        </div>
                    </section>
                    <!--//Car rental-->

                </section>
                <!--//three-fourth content-->

                <!--sidebar-->
                <aside class="right-sidebar">

                    <!--Need Help Booking?-->
                    <article class="default clearfix">
                        <h2>Need Help Booking?</h2>
                        <p>Call our customer services team on the number below to speak to one of our advisors who will help you with all of your holiday needs.</p>
                        <p class="number">1- 555 - 555 - 555</p>
                    </article>
                    <!--//Need Help Booking?-->

                    <!--Why Book with us?-->
                    <article class="default clearfix">
                        <h2>Why Book with us?</h2>
                        <h3>Low rates</h3>
                        <p>Get the best rates, or get a refund.<br />No booking fees. Save money!</p>
                        <h3>Largest Selection</h3>
                        <p>140,000+ hotels worldwide<br />130+ airlines<br />Over 3 million guest reviews</p>
                        <h3>We�re Always Here</h3>
                        <p>Call or email us, anytime<br />Get 24-hour support before, during, and after your trip</p>
                    </article>
                    <!--//Why Book with us?-->

                    <!--Popular hotels in the area-->
                    <article class="default clearfix">
                        <h2>Popular hotels in the area</h2>
                        <ul class="popular-hotels">
                            <li>
                                <a href="#">
                                    <h3>Plaza Resort Hotel &amp; SPA
										<span class="stars">
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
										</span>
                                    </h3>
                                    <p>From <span class="price">$ 100 <small>/ per night</small></span></p>
                                    <span class="rating"> 8 /10</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <h3>Lorem Ipsum Inn
										<span class="stars">
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
										</span>
                                    </h3>
                                    <p>From <span class="price">$ 110 <small>/ per night</small></span></p>
                                    <span class="rating"> 7 /10</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <h3>Best Eastern London
										<span class="stars">
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
										</span>
                                    </h3>
                                    <p>From <span class="price">$ 125 <small>/ per night</small></span></p>
                                    <span class="rating"> 8 /10</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <h3>Plaza Resort Hotel &amp; SPA
										<span class="stars">
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
											<img src="images/ico/star.png" alt="" />
										</span>
                                    </h3>
                                    <p>From <span class="price">$ 100 <small>/ per night</small></span></p>
                                    <span class="rating"> 8 /10</span>
                                </a>
                            </li>
                        </ul>
                        <a href="#" title="Show all" class="show-all">Show all</a>
                    </article>
                    <!--//Popular hotels in the area-->

                    <!--Deal of the day-->
                    <article class="default clearfix">
                        <h2>Deal of the day</h2>
                        <div class="deal-of-the-day">
                            <a href="hotel.html">
                                <figure><img src="images/slider/img3.jpg" alt="" width="230" height="130" /></figure>
                                <h3>Plaza Resort Hotel &amp; SPA
									<span class="stars">
										<img src="images/ico/star.png" alt="" />
										<img src="images/ico/star.png" alt="" />
										<img src="images/ico/star.png" alt="" />
										<img src="images/ico/star.png" alt="" />
									</span>
                                </h3>
                                <p>From <span class="price">$ 100 <small>/ per night</small></span></p>
                                <span class="rating"> 8 /10</span>
                            </a>
                        </div>
                    </article>
                    <!--//Deal of the day-->
                </aside>
                <!--//sidebar-->
            </div>
            <!--//main content-->
        </div>
    </div>
@endsection