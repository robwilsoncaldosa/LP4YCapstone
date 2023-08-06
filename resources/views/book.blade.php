@extends('layouts.layout')
@section('title','Book A Room')

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
                    <input type="date" class="form-control" id="check-in" placeholder="Check In"
                        onchange="updateLabel(this)">
                </div>
            </div>
            <div class="position-relative col-2">
                <div class="input-container">
                    <label for="check-out">Check Out</label>
                    <input type="date" class="form-control" id="check-out" placeholder="Check Out"
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

<!-- 1st room container -->
<div class="room-container" id="room1">
    <div class="room-image">
        <img src="img/sample_gallery_image (1).jpg" alt="Room Image" onclick="redirectToRoomDetails('room1')">
        <div class="more-info-hov" onclick="redirectToRoomDetails('room1')">
            More Info
        </div>
    </div>

    <!-- starts room-details -->
    <div class="room-details">
        <!-- start l_content -->
        <div class="l_content">
            <h2 class="room-name">Camiguin Room</h2>
            <p class="room-description">Spacious and bright room with private bathroom. Possibility of
                having two single beds or a double bed.</p>
            <!-- <p class="room-features"></p> -->
            <p class="room-beds"><span class="circle"></span> Beds: 1 Double(s)</p>
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
            <p class="room-price">1000 ₱</p>

            <div class="more-info">
                <!-- <button class="more-info-button" onclick="redirectToRoomDetails('room1')">More Info</button> -->
                <button class="more-info-button" onclick="redirectToRoomDetails('room1')">More Info</button>

            </div>
        </div>
        <!-- end r_content -->

    </div>
    <!-- end room-details -->

</div>
<!-- End room-container -->
<hr class="divider">
<!-- __________________________________________________________________________________________ -->
<!-- 2nd room container -->
<div class="room-container" id="room2">
    <div class="room-image">
        <img src="img/sample_gallery_image (2).jpg" alt="Room Image" onclick="redirectToRoomDetails('room2')">
        <div class="more-info-hov" onclick="redirectToRoomDetails('room2')">
            More Info
        </div>
    </div>
    <!-- <div class="room-content"> -->

    <!-- starts room-details -->
    <div class="room-details">
        <!-- start l_content -->
        <div class="l_content">
                  <h2 class="room-name">Mantique Room</h2>
            <p class="room-description">Spacious and bright room with private bathroom. Possibility of
                having two single beds or a double bed.</p>
            <!-- <p class="room-features"></p> -->
            <p class="room-beds"><span class="circle"></span> Beds: 1 Double(s)</p>
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
            <p class="room-price">1000 ₱</p>

            <div class="more-info">
                <button class="more-info-button" onclick="redirectToRoomDetails('room2')">More Info</button>
                <!-- <button class="more-info-button" onclick="redirectToRoomDetails('room1')">More Info</button> -->

                <!-- <button href=room_details.html class="more-info-button">More Info</button> -->
            </div>
        </div>
        <!-- end r_content -->

    </div>
    <!-- end room-details -->

     <!-- More Info text -->

    <!-- </div> -->
</div>
<!-- End room-container -->
<!-- <hr class="h_line"> -->
<hr class="divider">



<!-- __________________________________________________________________________________ -->
<!-- 3rd room container -->
<div class="room-container" id="room3">
    <div class="room-image">
        <img src="img/sample_gallery_image (3).jpg" alt="Room Image" onclick="redirectToRoomDetails('room3')">
        <div class="more-info-hov" onclick="redirectToRoomDetails('room3')">
            More Info
        </div>
    </div>

    
    <!-- starts room-details -->
    <div class="room-details">
        <!-- start l_content -->
        <div class="l_content">
            <h2 class="room-name">Malapascua Room</h2>
            <p class="room-description">Spacious and bright room with private bathroom. Possibility of
                having two single beds or a double bed.</p>
            <!-- <p class="room-features"></p> -->
            <p class="room-beds"><span class="circle"></span> Beds: 1 Double(s)</p>
            <!-- <p class="room-beds">Beds: 1 Double(s)</p> -->
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
            <p class="room-price">1200 ₱</p>

            <div class="more-info">
                <button class="more-info-button" onclick="redirectToRoomDetails('room3')">More Info</button>
                <!-- <button class="more-info-button">More Info</button> -->
            </div>
        </div>
        <!-- end r_content -->

    </div>
    <!-- end room-details -->

</div>
<!-- End room-container -->
<hr class="divider">

</div>
        <!-- End room -->


    </div>
    <!-- End book_container -->
    <!-- =========================================================================== -->


    </div>


    

    <script>
       function redirectToRoomDetails(roomId) {
        const roomContainer = document.getElementById(roomId);
        const roomName = roomContainer.querySelector('.room-name').textContent;
        const roomDescription = roomContainer.querySelector('.room-description').textContent;
        const roomPrice = roomContainer.querySelector('.room-price').textContent;
        const roomImage = roomContainer.querySelector('.room-image img').getAttribute('src');

        const urlParams = new URLSearchParams();
        urlParams.append('name', roomName);
        urlParams.append('description', roomDescription);
        urlParams.append('price', roomPrice);
        urlParams.append('image', roomImage);

        window.location.href = `/room_details?${urlParams.toString()}`; 
    }
    </script>

    <!--******************************************  Contact  ***********************************************-->
    @include('partials._contact')

    <!--******************************************  Footer  ***********************************************-->

    @include('partials._footer')


    @endsection

