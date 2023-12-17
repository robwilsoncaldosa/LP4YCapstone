@extends('layouts.layout') @section('title', 'Book A Room') @section('content')


<!--******************************************  FIXED-ICONS  ***********************************************-->

@include('partials._fixed-icons')



<!--******************************************  Header  ***********************************************-->
@include('partials._header')

<!-- ************************************** Content *************************************************** -->



<!-- ************************************** Content *************************************************** -->
<style>


.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    margin: auto;
}

    .review-card {
        transition: transform 0.3s ease-in-out;
    }

    .review-card:hover {
        transform: scale(1.03);
    }


    .star-rating {
        color: #ffd700; /* Gold color for stars */
        font-size: 25px;
    }

    .user-details {
        flex-grow: 1;
    }

    .card-title {
        margin-bottom: 0.5rem;
    }

    .card-text {
        color: #555;
    }
    ul{
        margin: 0!important;
        padding: 0!important;
    }.reserved-date {
    background-color: #FFA07A; /* Light Salmon color */
    color: white;
    font-weight: bold;
    position: relative;
}

.reserved-date::before {
    content: "Reserved";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(50deg);
    font-size: 10px; /* Adjust the font size as needed */
    color: black;
    font-weight: bolder;
}



</style>

<div class="container">

<input type="hidden" value="{{$room->id}}" id="room_id">
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
                        <p class="room-description w-75">{{ $room->description }}

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




                <div class="input-container p-2 d-flex justify-content-between align-items-center">
                    <span class="">Total:</span>
                    <div class="total-display" style="font-size:30px;"></div>
                    <input class="total" name="total" hidden>
                </div>


                <button type="submit" class="btn btn-dark w-100 rounded-0 book_now" style="margin-top:20px;"
                    id="book-now">Book Now</button>



            </div>

            <br>
            <br>
<div class="card d-flex p-2 text-center alert alert-danger ">
    <p> <i class="fas fa-info-circle" style="font-size:15px"></i>
   <strong>
    Check-out is available from Tuesday to Saturday, and the maximum stay is 4 nights.
    </strong>
    </p>
</div>

              <!-- Display reviews for the room -->
    @if ($roomReviews->count() > 0)
    <h5>Reviews</h5>
    <br>
    <br>

    <ul>
        @foreach ($roomReviews as $review)
            <li class="card review-card">
                <div class="card-body d-flex align-items-start">
                    @php
                        $initial = strtoupper(substr($review->user->name, 0, 1));
                        $randomColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                    @endphp


                    <div class="user-details ml-3 mt-2 ms-3 text-center ">
                        @php
                        $initial = strtoupper(substr($review->user->name, 0, 1));
                        $randomColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                    @endphp
                    <div class="user-avatar" style="background-color: {{ $randomColor }};">
                        <span>{{ $initial }}</span>
                    </div>
                        <strong>{{ $review->user->name }}</strong> <br> {{ $review->room_comment }} <br>
                        <span class="star-rating d-flex align-items-center justify-content-center">
                            @for ($i = 1; $i <= $review->rating; $i++)
                                &#9733;
                            @endfor
                            @for ($i = $review->rating + 1; $i <= 5; $i++)
                                &#9734;
                            @endfor
                        </span>
                        <!-- Add other review details you want to display -->
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p>No reviews for {{ $room->room_name }} Room yet.</p>
@endif
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
                    <div class="text-danger text-start " style="display: flex;">

                                 <input id="total" class="total text-danger text-center" name="total" hidden style="border:none;display:inline;background-color:transparent" readonly>


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
                        <input type="number" id="downpaymentinput" class="form-control w-50" name="downpayment" required>
                        <div class="alert alert-dark  mt-4 text-center">
                            <strong><i class="fas fa-info-circle"></i> Minimum Downpayment would be 15% of the total price</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="acceptTerms" name="acceptTerms" required>
                            <label class="form-check-label" for="acceptTerms">
                                I have read and accept the <a href="{{ route('terms_and_conditions') }}" target="_blank">terms and conditions</a>.
                            </label>
                        </div>
                    </div>

                    <br>
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

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="acceptTerms" name="acceptTerms" required>
                            <label class="form-check-label" for="acceptTerms">
                                I have read and accept the <a href="{{ route('terms_and_conditions') }}" target="_blank">terms and conditions</a>.
                            </label>
                        </div>
                    </div>
 <br>
 <br>
                    <button type="submit" class="btn btn-dark">Pay in Full</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

///script for phone number is below
const input = document.querySelector("#phone");
const input2 = document.querySelector("#phone2");

const errorMsg = document.querySelector("#error-msg");
const validMsg = document.querySelector("#valid-msg");
const validMsg2 = document.querySelector("#valid-msg2");

const errorMsg2 = document.querySelector("#error-msg2");



// here, the index maps to the error code returned from getValidationError - see readme
const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
const errorMap2 = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];


const iti = window.intlTelInput(input, {
    nationalMode: true,
    initialCountry: "auto",
    geoIpLookup: callback => {
        fetch("https://ipapi.co/json")
            .then(res => res.json())
            .then(data => callback(data.country_code))
            .catch(() => callback("us"));
    },
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
});

const iti2 = window.intlTelInput(input2, {
    nationalMode: true,
    initialCountry: "auto",
    geoIpLookup: callback => {
        fetch("https://ipapi.co/json")
            .then(res => res.json())
            .then(data => callback(data.country_code))
            .catch(() => callback("us"));
    },
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
});



const reset = () => {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
    input2.classList.remove("error");
    errorMsg2.innerHTML = "";
    errorMsg2.classList.add("hide");
    validMsg2.classList.add("hide");



};


// on input: validate
input.addEventListener('input', () => {
    reset();
    if (input.value.trim()) {
        if (iti.isValidNumber()) {
            validMsg.classList.remove("hide");
        } else {
            input.classList.add("error");
            const errorCode = iti.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            errorMsg.classList.remove("hide");
        }
    }
});


// on input: validate
input2.addEventListener('input', () => {
    reset();
    if (input2.value.trim()) {
        if (iti2.isValidNumber()) {
            validMsg2.classList.remove("hide");
        } else {
            input2.classList.add("error");
            const errorCode = iti2.getValidationError();
            errorMsg2.innerHTML = errorMap2[errorCode];
            errorMsg2.classList.remove("hide");
        }
    }
});

</script>


<!--******************************************  Contact  ***********************************************-->
@include('partials._contact')

<!--******************************************  Footer  ***********************************************-->

@include('partials._footer') @endsection
