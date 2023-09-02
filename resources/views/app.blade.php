@extends('layouts.layout') @section('title','LP4Y Guest House') @section('content')
<!--***************************************Fixed-icons******************************************-->
@include('partials._fixed-icons')
<!--***************************************Header***********************************************-->
@include('partials._header')
<!--***************************************Home***********************************************-->
<section class="home d-flex justify-content-center mt-5" id="home" style="background-image: url('./img/sample_home_background.jpg');">
    <div class="text-center container w-75 m-auto ">HOST 4 <br> CHANGE <br> CEBU <br><span class="fst-italic">Guesthouse & Training center </span></div>
</section>

<!--***************************************About************************************************-->
<section class="about text-center mt-5 " id="about">
    <h2>ABOUT</h2>
    <br>
    <h5><i>Looking for an unique experience ? Welcome in our guest house HOST 4 CHANGE !</i></h5>
    <br>
    <h5>
        <i>We have 3 spacious rooms with private bathrooms, located near the international Airport of Cebu. More
                than a guest House, HOST 4 CHANGE is a Training center. So the service is different from a "classic"
                hotel, and during the day the team are in training. By booking your room, you also support the Youth
                professional integration.</i>
    </h5>
    <br>
    <h5><i>Your booking is considered as donations and will finance the development of the project.</i></h5>

</section>
<!--***************************************Rooms***********************************************-->
<section class="rooms" id="rooms" style="background-image: url('./img/sample_room_background.jpg'); ">
    <div class="container card">
        <h4>OUR ROOMS</h4>
        <br>
        <h5><i>Spacious and comfortable, you will <br>
                    appreciate your stay in our Guesthouse.</i></h5>
        <br>
        <a class="btn-sm btn  btn-book-room  p-2" href="{{ route('book') }}"><span>Book a Room</span></a>
    </div>
</section>






<!--***************************************Services**********************************************-->
<section class="services mt-5 m-auto" id="services">
    <h2 class="text-center mb-5  ">Our Services</h2>
    <br>
    <div class="service-card  d-flex justify-content-between m-auto w-100 flex-wrap ">
        <div class="card border-0  align-items-center col-12 col-lg-4 px-0 mt-3 mt-lg-0 ">
            <i class="fas fa-utensils m-4"></i>
            <h5>Breakfast & Lunch</h5>
            <p class="text-center mt-4 ">We cook delicious Filipino specialties<br>and can teach you our best recipes!
            </p>
        </div>

        <div class="card border-0   align-items-center col-12 col-lg-4 px-0 mt-3 mt-lg-0 ">
            <i class="fas fa-star m-4"></i>
            <h5>Recommendations</h5>
            <p class="text-center mt-4 ">Get the best touristic <br> recommendations from locals!</p>
        </div>
        <div class="card border-0   align-items-center col-12 col-lg-4 px-0 mt-3 mt-lg-0 ">
            <i class="fas fa-bed m-4"></i>
            <h5>Comfortable stay</h5>
            <p class="text-center mt-4 ">Free Wifi, Air conditionner, Hot<br> Water, Kitchen available to guests,<br> and more!
            </p>
        </div>
    </div>
</section>
<!--***************************************Gallery**********************************************-->
<section class="gallery" id="gallery">
    <h2 class="text-center mb-5">Gallery</h2>

    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-4">
                        <img src="./img/lunch_together_with_guest.png" class="d-block w-100 carousel-image" alt="Image 1">
                    </div>
                    <div class="col-4">
                        <img src="./img/guitar_training_with_guest.png" class="d-block w-100 carousel-image" alt="Image 2">
                    </div>
                    <div class="col-4">
                        <img src="./img/lessons_with_john_delaporte.png" class="d-block w-100 carousel-image" alt="Image 3">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-4">
                        <img src="./img/catalyst_eating_breakfast2.png" class="d-block w-100 carousel-image" alt="Image 4">
                    </div>
                    <div class="col-4">
                        <img src="./img/bisaya_training_with_guest.png" class="d-block w-100 carousel-image" alt="Image 5">
                    </div>
                    <div class="col-4">
                        <img src="./img/catalyst_eating_breakfast.png" class="d-block w-100 carousel-image" alt="Image 6">
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
    </div>


    <h2 class="text-center mt-5">SEE & DO ON LP4Y GUEST HOUSE</h2>
    <br>
    <br>
    <div class="gallery-card  d-flex justify-content-between">
        <div class="card border-0 w-100 align-items-center  ">
            <h5>Guitar Training</h5>
            <p class="text-center ">
                <!-- Cebu is known worldwide for the<br> coral, turtles and the fishes, don't<br> miss the opportunity. -->
                Guest can play guitar with the youth to have fun.
            </p>
            </p>
        </div>

        <div class="card border-0 w-100  align-items-center">
            <h5>Bisaya Training</h5>
            <p class="text-center ">
                Guest can learn bisaya dialect with the youth.
            </p>
        </div>
        <div class="card border-0 w-100  align-items-center">
            <h5>Lunch Together with the youth </h5>
            <p class="text-center ">
            Guest can have fun<br> Having lunch together with youth brings joy to the guest, and<br> appreciate the landscape.</p>
        </div>
    </div>
    <br>
    <div class="gallery-card  d-flex justify-content-between ">
        <div class="card border-0 w-100 align-items-center  ">
            <h5>Catalyst eating breakfast</h5>
            <p class="text-center ">Breakfast with youth makes your stay in guest house special and memorable
            </p>
        </div>

        <div class="card border-0 w-100  align-items-center">
            <h5>Freediving</h5>
            <p class="text-center ">Live an unique experience, sport and relaxation.</p>
        </div>
        <div class="card border-0 w-100  align-items-center">
            <h5>Beaches & Massages
            </h5>
            <p class="text-center ">Time to relax !</p>
        </div>
    </div>
    <!--********************************************* GUEST REVIEW *****************************************-->
    <section class="guest-review" style="background-image: url('./img/sample_guestreview_background.jpg');">
        <div class="card">
            <h4>GUEST REVIEW</h4>
            <br>

            <br>
            <div class="review-container">
                <div class="review active">
                    <blockquote>
                        “All of your welcoming was very nice and we really enjoyed our stay (too short unfortunately)”
                    </blockquote>
                    <p class="review-author">Tiphaine G.</p>
                </div>
                <div class="review">
                    <blockquote>
                        “Well! For me too it was a very good moment, you are great young people! I hope we can come back to see you again!!” ​
                    </blockquote>
                    <p class="review-author">Thomas A.</p>
                </div>
                <div class="review">
                    <blockquote>
                        “We are missing your pancit!”
                    </blockquote>
                    <p class="review-author">Alexandra B.</p>
                </div>
            </div>

            <div class="radio-buttons">
                <input type="radio" name="review-radio" id="review1" checked>
                <label for="review1"></label>
                <input type="radio" name="review-radio" id="review2">
                <label for="review2"></label>
                <input type="radio" name="review-radio" id="review3">
                <label for="review3"></label>
            </div>
        </div>
    </section>
    <br>
    <br>
    <br>
    <br>


</section>
<!--********************************************* CONTACT *******************************************-->
@include('partials._contact')

<!--********************************************* FOOTER *******************************************-->
@include('partials._footer') @endsection
