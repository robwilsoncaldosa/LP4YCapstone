@extends('layouts.layout')
@section('title', 'Book A Room')

@section('content')


    <!--******************************************  FIXED-ICONS  ***********************************************-->

    @include('partials._fixed-icons')



    <!--******************************************  Header  ***********************************************-->
    @include('partials._header')

    <!-- ************************************** Content *************************************************** -->

    <!-- start book_container -->
    <div class="book_container">

        <div class="book_t_content">
            <h1 class="mb-5">BOOK A ROOM</h1>
            <p class="mb-0" style="font-size: 24px;">Our Rooms</p>
            <div class="h_line"></div>
        </div>
        <!-- End book_t_content -->
        <!-- Start search_book -->
        <div class="search_book d-flex m-auto" style="width: 64%;">
            <div class="position-relative col-2">
                <div class="input-container">
                    <label for="check-in">Check In</label>
                    <input type="text" class="form-control" id="check-in" placeholder="Check In"
                        onchange="updateLabel(this)">
                </div>
            </div>
            <div class="position-relative col-2">
                <div class="input-container">
                    <label for="check-out">Check Out</label>
                    <input type="text" class="form-control" id="check-out" placeholder="Check Out"
                        onchange="updateLabel(this)">
                </div>
            </div>
            <div class="position-relative col-3">
                <div class="input-container">
                    <label for="adults">Adults</label>
                    <input type="number" class="form-control" id="adults" placeholder="Adults">
                </div>
            </div>
            <div class="position-relative col-3">
                <div class="input-container">
                    <label for="kids">Kids</label>
                    <input type="number" class="form-control" id="kids" placeholder="Kids">
                </div>
            </div>
            <div class="position-relative search-button col-2 btn btn-dark">Search</div>
        </div>
        <!-- End search_book -->

        <div class="book_t_content">
            <div class="h_line"></div>
        </div>

        <!--------------------------- Start room -------------------------->
        <div class="room">
            @foreach ($rooms as $room)
                <!-- 1st room container -->
                <div class="room-container" id="room1">
                    <div class="room-image">
                        <img src="{{ $room->image_path }}" alt="Room Image" width="100%" data-room_name="{{$room->room_name}}">
                        <div class="more-info-hov" data-room_name="{{$room->room_name}}">
                            More Info
                        </div>
                    </div>
                    <!-- starts room-details -->
                    <div class="room-details">
                        <!-- start l_content -->
                        <div class="l_content">
                            <h2 class="room-name">{{ $room->room_name }}</h2>
                            <p class="room-description">Spacious and bright room with private bathroom. Possibility of
                                having two single beds or a double bed.</p>
                            <!-- <p class="room-features"></p> -->
                            <p class="room-beds"><span class="circle"></span> {{ $room->bed_type }}</p>
                            <hr class="divider">

                            <!-- start i_content -->
                            <div class="i_content">
                                <i class="fas fa-snowflake"></i>
                                <i class="fas fa-wifi"></i>
                                <i class="fas fa-shower"></i>
                                <i class="fas fa-bath"></i>
                            </div>
                            <!-- end i_content -->
                        </div>
                        <!-- end l_content -->
                        <!-- start r_content -->
                        <div class="r_content">
                            <p class="from">From</p>
                            <p class="room-price">₱ {{ $room->price_per_night }} </p>

                            <div class="more-info">
                                <!-- <button class="more-info-button" onclick="redirectToRoomDetails('room1')">More Info</button> -->
                                <button class="more-info-button" data-room_name="{{$room->room_name}}">More Info</button>

                            </div>
                        </div>
                        <!-- end r_content -->

                    </div>
                    <!-- end room-details -->

                </div>
                <dialog autofocus="false" id="modal-{{$room->room_name}}">
                    <!-- ************************************** Content *************************************************** -->


                    <div class="container">


                        <div class="room-details-container">
                            <!-- ---room details---- -->
                            <div class="room-details-deets" id="room_details">
                                <h2 class="text-center">BOOK A ROOM</h2>

                                <div class="room-name-container d-flex align-items-center justify-content-around mb-2"
                                    style="width:30%">
                                    <a href="/book?" class="back-btn text-decoration-none"><i class="fas fa-arrow-left"
                                            style="font-size: 25px;color:#242323;"></i></a>
                                    <div class="separator"></div>
                                    <h3 id="room-name">{{ $room->room_name }} Room</h3>
                                </div>

                                <img src="{{ $room->image_path }}" alt="Room Image" id="room-image">

                                <div class="room-details-con">
                                    <div class="property-details">
                                        <h5>Properties:</h5>
                                        <div class="properties-deets-container">
                                            <div class="prop-menu">
                                                <p id="accommodates">Accommodates: </p>
                                            </div>

                                            <div class="prop-menu">
                                                <p id="beds">Beds:{{ $room->bed_type }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="divider">
                                    <div class="more-info_deets d-flex justify-content-between align-items-center">
                                        <div class="more-info-text">
                                            <h5 style="margin-right: 5px; margin-top: 0px;">More Info:
                                            </h5>
                                        </div>
                                        <div class="more-info-details"></div>
                                        <p class="room-description">Spacious and bright room with private bathroom.
                                            Possibility of having two single beds or a double bed.

                                        </p>
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
                                                <p class="check-in">Check-In: 12:00PM</p>
                                            </div>

                                            <div class="check-deets" style="margin-left: 110px">
                                                <p class="check-out">Check-Out: 02:00PM</p>
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
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d490.68891707319847!2d123.9490603791058!3d10.300900522871656!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9999278be73df%3A0x375659c7ec469226!2sLife%20Project%204%20Youth%20(LP4Y)%20-%20Center%20and%20Guest%20houses!5e0!3m2!1sen!2sph!4v1688547750578!5m2!1sen!2sph"
                                            width="100%" height="450" style="border:0;" allowfullscreen=""
                                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>

                            <div class="room-details-content">
                                <div class="room-details-box">

                                    <p>From</p>
                                    <p class="room-details-price" style="font-size:30px">1000 ₱</p>
                                    <p>Per Night</p>
                                    <hr>

                                    <div class="input-container position-relative">
                                        <input type="text" class="form-control rounded-0 check-in m-5"                                             placeholder="Check In" >
                                        <i class="far fa-calendar position-absolute"
                                            style="top:10px;right:20px;pointer-events: none;"></i>

                                    </div>

                                    <div class="input-container position-relative">
                                        <input type="text" class="form-control rounded-0 check-out m-5" 
                                            placeholder="Check Out" >
                                        <i class="far fa-calendar position-absolute"
                                            style="top:10px;right:20px;pointer-events: none;"></i>

                                    </div>

                                    <div class="input-container">
                                        <input type="number" class="form-control rounded-0" id="adults"
                                            placeholder="Adults">
                                    </div>

                                    <button class="btn btn-dark w-100 rounded-0" style="margin-top:20px;">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </dialog>
                <!-- End room-container -->
                <hr class="divider">


                <!-- End room -->
            @endforeach
        </div>

    </div>
    <!-- End book_container -->
    <!-- =========================================================================== -->


    </div>




    <script>
    $(".check-in, .check-out").datepicker();



            const showModalButtons = document.querySelectorAll('.room-image img, .more-info-hov,.more-info-button');

            showModalButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const roomName = button.getAttribute('data-room_name');
                const modal = document.getElementById('modal-' + roomName);

                if (modal) {
                    modal.showModal();
                }

                modal.addEventListener("click", e => {
                const dialogDimensions = modal.getBoundingClientRect()
                if (
                    e.clientX < dialogDimensions.left ||
                    e.clientX > dialogDimensions.right ||
                    e.clientY < dialogDimensions.top ||
                    e.clientY > dialogDimensions.bottom
                ) {

                    modal.close()
                }
            })
            });
        });






    </script>

    <!--******************************************  Contact  ***********************************************-->
    @include('partials._contact')

    <!--******************************************  Footer  ***********************************************-->

    @include('partials._footer')


@endsection
