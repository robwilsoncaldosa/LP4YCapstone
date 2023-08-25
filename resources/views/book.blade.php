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


        <!--------------------------- Start room -------------------------->
        <div class="room">
            @foreach ($rooms as $room)
                <!-- 1st room container -->
                <div class="room-container" id="room1">
                    <div class="room-image">
                        <a href="{{ route('moreinfo', ['name' => $room->room_name]) }}">
                            <img src="{{ $room->image_path }}" alt="Room Image" width="100%"
                                data-room_name="{{ $room->room_name }}">
                            <div class="more-info-hov" data-room_name="{{ $room->room_name }}">
                                More Info
                            </div>
                        </a>

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
                                <a href="{{ route('moreinfo', ['name' => $room->room_name]) }}">
                                    <button class="more-info-button" data-room_name="{{ $room->room_name }}">More
                                        Info</button></a>

                            </div>
                        </div>
                        <!-- end r_content -->

                    </div>
                    <!-- end room-details -->

                </div>
                <hr class="divider">



                <!-- End room -->
            @endforeach

        </div>

    </div>
    <!-- End book_container -->
    <!-- =========================================================================== -->


    </div>







    <!--******************************************  Contact  ***********************************************-->
    @include('partials._contact')

    <!--******************************************  Footer  ***********************************************-->

    @include('partials._footer')


@endsection
