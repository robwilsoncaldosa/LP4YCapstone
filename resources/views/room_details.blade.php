
@extends('layouts.layout')
@section('title','Book A Room')

@section('content')


    <!--******************************************  FIXED-ICONS  ***********************************************-->

    @include('partials._fixed-icons')



    <!--******************************************  Header  ***********************************************-->
    @include('partials._header')

    <!-- ************************************** Content *************************************************** -->


    <div class="container">
        <div class="title_head">
            <h2>BOOK A ROOM</h2>
        </div>

        <div class="room-details-container">

            <!-- ---room details---- -->
            <div class="room-details-deets" id="room_details">
                <div class="room-name-container">
                    <a href="main.html#rooms" class="back-btn"><i class="fas fa-arrow-left"></i></a>
                    <h3 id="room-name">Room Name</h3>
                </div>

                <img src="" alt="Room Image" id="room-image">

                <div class="room-details-con">
                    <div class="property-details">
                        <h5>Properties:</h5>
                        <div class="properties-deets-container">
                            <div class="prop-menu">
                                <p id="accommodates">Accommodates: </p>
                            </div>

                            <div class="prop-menu">
                                <p id="beds">Beds: </p>
                            </div>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="more-info">
                        <div class="more-info-text">
                            <h5 style="margin-right: 5px; margin-top: 0px;">More Info:</h5>
                        </div>
                        <div class="more-info-details"></div>
                        <p class="room-description"></p>
                    </div>
                    <hr class="divider">

                    <div class="amenities">
                        <h5>Amenities:</h5>
                        <div class="amenit-icons-container">
                            <div class="amenit">

                                <div>
                                    <i class="fas fa-snowflake"></i>
                                    <li>A/C</li>
                                </div>
                                <div>
                                    <i class="fas fa-wifi"></i>
                                    <li>WiFi</li>
                                </div>
                            </div>

                            <div class="amenit">
                                <div>
                                    <i class="fas fa-shower"></i>
                                    <li>Shower</li>
                                </div>

                                <div>
                                    <i class="fas fa-bath"></i>
                                    <li>Towels</li>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="divider">

                    <div class="check-in-out">
                        <h5>Check-In and Out:</h5>
                        <div class="check-deets-container">

                            <div class="check-deets">
                                <p id="check-in">Check-In: 12:00PM</p>
                            </div>

                            <div class="check-deets" style="margin-left: 110px">
                                <p id="check-out">Check-Out: 02:00PM</p>
                            </div>

                        </div>
                    </div>

                    <hr class="divider">

                    <div class="terms">
                        <h5>Terms:</h5>
                        <div class="terms-deets-container">
                            <div class="terms-deets">
                                <p id="maximum-nights">Maximum nights: 4</p>
                            </div>

                            <div class="terms-deets" style="margin-left: 110px">
                                <a href="#">Read Our Policies</a>
                            </div>
                        </div>
                    </div>
                    <hr class="divider">


                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d490.68891707319847!2d123.9490603791058!3d10.300900522871656!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9999278be73df%3A0x375659c7ec469226!2sLife%20Project%204%20Youth%20(LP4Y)%20-%20Center%20and%20Guest%20houses!5e0!3m2!1sen!2sph!4v1688547750578!5m2!1sen!2sph"
                            width="100%" height="450" style="border:0;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <div class="room-details-content">
                <div class="room-details-box">
                    <p>From</p>
                    <p class="room-details-price">1000 ₱</p>
                    <p>Per Night</p>
                    <hr>

                    <div class="input-container">
                        <label for="check-in">Check In</label>
                        <input type="date" class="form-control" id="check-in" placeholder="Check In" onchange="updateLabel(this)">
                    </div>

                    <div class="input-container">
                        <label for="check-out">Check Out</label>
                        <input type="date" class="form-control" id="check-out" placeholder="Check Out" onchange="updateLabel(this)">
                    </div>

                    <div class="input-container">
                        <label for="adults">Adults</label>
                        <input type="number" class="form-control" id="adults" placeholder="Adults">
                    </div>

                    <button class="btn btn-dark" style="margin-top:20px;">Book Now</button>
                </div>
            </div>
        </div>
    </div>

    <!--******************************************  Contact  ***********************************************-->
    @include('partials._contact')

    <!--******************************************  Footer  ***********************************************-->

    @include('partials._footer')


    @endsection