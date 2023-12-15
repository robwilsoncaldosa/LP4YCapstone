@extends('layouts.layout') @section('title', 'Book A Room') @section('content')


<!--******************************************  FIXED-ICONS  ***********************************************-->

@include('partials._fixed-icons')



<!--******************************************  Header  ***********************************************-->
@include('partials._header')

<!-- ************************************** Content *************************************************** -->



<!-- ************************************** Content *************************************************** -->


<div class="container">


    <div class="room-details-container">
        <!-- ---room details---- -->
        <div class="room-details-deets" id="room_details">
            <h2 class="text-center">BOOK A ROOM</h2>

            <div class="room-name-container d-flex  mb-2 mt-5" style="width:30%">
                <a href="{{ route('book') }}" class="back-btn text-decoration-none"><i class="fas fa-arrow-left"
                        style="font-size: 25px;color:#242323;"></i></a>
                <div class="separator">&nbsp;&nbsp;&nbsp;</div>
                <h3 id="room-name">{{ $room->room_name }} Room</h3>
            </div>

            <img src="../{{ $room->image_path }}" alt="Room Image" id="room-image">

            <div class="room-details-con">
                <div class="property-details">
                    <div class="more-info-text">
                        <h5> Properties:</h5>

                    </div>
                    <div class="properties-deets-container">
                        <div class="prop-menu">
                            <p id="accommodates">Accommodates: {{ $room->accommodates }}</p>
                        </div>

                        <div class="prop-menu">
                            <p id="beds">Beds: {{ $room->bed_type }} </p>
                        </div>
                    </div>
                </div>
                <hr class="divider">
                <div class="more-info_deets">
                    <div class="more-info-text">
                        <h5 style="margin-right: 5px; margin-top: 0px;">More Info:
                        </h5>
                    </div>
                    <div class="more-info-details">
                        <p class="room-description">{{ $room->description }}

                        </p>
                    </div>
                </div>
                <hr class="divider">

                <div class="amenities">
                    <h5>Amenities:</h5>
                    <div style="width:75%;display:flex;justify-content:flex-start">
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
                                    <img src="../img/towel.png" alt="Towel/Bath Icon" class="icon"
                                        style="width:18.5px">
                                    <li>Towels</li>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <hr class="divider">

                <div class="check-in-out">
                    <h5>Check-In and Out:</h5>
                    <div class="check-deets-container">

                        <div class="check-deets">
                            <p class="check-in">Check-In: <br> 12:00 PM</p>
                        </div>

                        <div class="check-deets">
                            <p class="check-out">Check-Out: <br> 02:00 PM</p>
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

                        <div class="terms-deets">
                            <a href="{{ route('policy') }}" target="_blank">Read Our Policies</a>
                        </div>
                    </div>
                </div>
                <hr class="divider">

              
              <!-- Display reviews for the room -->
                    @if ($roomReviews->count() > 0)
                        <h5>Reviews for {{ $room->room_name }} Room</h5>
                        <ul>
                            @foreach ($roomReviews as $review)
                                <li>
                                    <strong>{{ $review->user->name }}</strong> - {{ $review->room_comment }}
                                    <!-- Add other review details you want to display -->
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No reviews for {{ $room->room_name }} Room yet.</p>
                    @endif

                 <hr class="divider">      
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d490.68891707319847!2d123.9490603791058!3d10.300900522871656!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9999278be73df%3A0x375659c7ec469226!2sLife%20Project%204%20Youth%20(LP4Y)%20-%20Center%20and%20Guest%20houses!5e0!3m2!1sen!2sph!4v1688547750578!5m2!1sen!2sph"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <div class="room-details-content mt-5">
            <div class="room-details-box">

                <p>From</p>
                <p class="room-details-price ms-3" style="font-size:30px">{{ $room->price_per_night }} </p>
                <p>Per Night</p>
                <hr>


                <div class="input-container p-2 position-relative">
                    <input type="text" name="check-in" autocomplete="off" class="form-control rounded-0 check-in"
                        id="check-in" placeholder="Check In" readonly required>
                    <i class="far fa-calendar position-absolute" style="top:20px;right:20px;pointer-events: none;"></i>
                </div>


                <div class="input-container p-2 position-relative">
                    <input readonly type="text" class="form-control rounded-0 check-out" id="check-out"
                        placeholder="Check Out" name="check-out" autocomplete="off" required>
                    <i class="far fa-calendar position-absolute" style="top:20px;right:20px;pointer-events: none;"></i>
                </div>


                <div class="input-container p-2">
                    <input type="number" name='adult' class="form-control rounded-0" id="adults"
                        placeholder="Adults">
                </div>

                <div class="input-container p-2 d-flex justify-content-between align-items-center">
                    <span class="">Total:</span>
                    <div class="total-display" style="font-size:30px;"></div>
                    <input class="total" name="total" hidden>
                </div>


                <button type="submit" class="btn btn-dark w-100 rounded-0 book_now" style="margin-top:20px;"
                    id="book-now">Book Now</button>



            </div>

        </div>
        <dialog id="reservation-dialog">
            <p id="dialog-content"></p>
            <button id="close-dialog">Close</button>
        </dialog>
    </div>
    <button class="showmodal d-none" data-bs-toggle="modal" data-bs-target="#paymentModal"></button>


</div>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  " id="paymentModalLabel">Choose Payment Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex gap-4 ">


                <!-- Button to trigger the modal for downpayment -->
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#downpayment">Down
                    Payment</button>

                <!-- Button to trigger the modal for full payment -->
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#fullpayment">Full
                    Payment</button>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Downpayment -->
<div class="modal fade" id="downpayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Downpayment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('downpayment') }}">
                    @csrf

                    <input type="text" name="room_id" value="{{ $room->id }}" hidden>
                    <input type="text" name="product_name" value="{{ $room->room_name }}" hidden>

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone2" class="form-label">Phone (Optional):</label>
                        <input class="form-control" id="phone2" name="phone2" type="tel">
                        <span id="valid-msg2" class="hide">✓ Valid</span>
                        <span id="error-msg2" class="hide"></span>
                    </div>
                    <div class="text-danger" style="display: flex;">
                        <div class="text-center">
                            <i class="fas fa-info-circle"></i> Minimum Downpayment is 15% of the total price of
                            ₱  <input id="total" class="total text-danger text-center" name="total" style="border:none;display:inline" readonly>

                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="check-in" class="form-label d-none ">Check In:</label>
                        <input type="text" name="check-in" autocomplete="off" class="form-control check-in" id="check-in"
                            placeholder="Check In"  readonly required hidden>
                    </div>

                    <div class="mb-3">
                        <label for="check-out" class="form-label d-none">Check Out:</label>
                        <input readonly type="text" class="form-control check-out" id="check-out" placeholder="Check Out"
                            name="check-out" autocomplete="off" required hidden>
                    </div>
                    <div class="mb-3">
                        <label for="downpayment" class="form-label">Enter Downpayment Amount:</label>
                        <input type="number" id="downpaymentinput" class="form-control" name="downpayment" required>
                    </div>



                    <br>

                    <button type="submit" class="btn btn-dark">Confirm Payment</button>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal For Full Payment -->
<div class="modal fade" id="fullpayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Full Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('session') }}" class="d-inline">
                    @csrf

                    <input type="text" name="product_name" value="{{ $room->room_name }}" hidden>
                    <input type="text" name="room_id" value="{{ $room->id }}" hidden>


                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone (Optional):</label>
                        <input class="form-control" id="phone" name="phone" type="tel">
                        <span id="valid-msg" class="hide">✓ Valid</span>
                        <span id="error-msg" class="hide"></span>
                    </div>

                    <div class="mb-3">
                        <label for="check-in" class="form-label d-none ">Check In:</label>
                        <input type="text" name="check-in" autocomplete="off" class="form-control check-in" id="check-in"
                            placeholder="Check In"  readonly required hidden>
                    </div>

                    <div class="mb-3">
                        <label for="check-out" class="form-label d-none">Check Out:</label>
                        <input readonly type="text" class="form-control check-out" id="check-out" placeholder="Check Out"
                            name="check-out" autocomplete="off" required hidden>
                    </div>

                    <div class="mb-3">
                        <input class="total" name="total" hidden>
                    </div>

                    <button type="submit" class="btn btn-dark">Pay in Full</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!--******************************************  Contact  ***********************************************-->
@include('partials._contact')

<!--******************************************  Footer  ***********************************************-->

@include('partials._footer') @endsection
