@extends('layouts.layout') @section('title', 'LP4Y Guest House') @section('content')
<!--***************************************Fixed-icons******************************************-->
@include('partials._fixed-icons')
<!--***************************************Header***********************************************-->
@include('partials._header')
<!--***************************************Home***********************************************-->
@if(session('success'))
    <div id="custom-alert" class="alert alert-success text-center fade show">
        <h4 class="alert-heading">Success!</h4>
        {!! session('success') !!}
        @if(session('contactMessage'))
            <hr>
            <p class="mb-0">{!! session('contactMessage') !!}</p>
        @endif
    </div>

    <style>
        /* Add your custom styles for the pop-up transition */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 10%, 0);
            }
            to {
                opacity: 1;
                transform: none;
            }
        }

        #custom-alert {
            animation: fadeInUp 0.5s ease;
        }
    </style>

    <script>
        // Auto-hide the alert after 5 seconds (5000 milliseconds)
        setTimeout(function(){
            $("#custom-alert").alert('close');
        }, 5000);

        // Add fade transition when closing the alert
        $("#custom-alert").on('closed.bs.alert', function(){
            // Add any additional actions after the alert is closed
        });
    </script>
@endif


<section class="home d-flex justify-content-center" id="home">
    <div class="text-center container w-75 m-auto ">HOST 4 <br> CHANGE <br> CEBU <br><span class="fst-italic">Guesthouse &
            Training center </span></div>
</section>

<!--***************************************About************************************************-->
<section class="about text-center mt-5 " id="about">
    <div style="width:60%;display: block;">
        <h1>ABOUT</h1>
        <br>
        <h5><i>Looking for an unique experience? Welcome in our guest house HOST 4 CHANGE !</i></h5>
        <br>
        <h5>
            <i>We have 3 spacious rooms with private bathrooms, located near the international Airport of Cebu. More
                than a guest House, HOST 4 CHANGE is a Training center. So the service is different from a "classic"
                hotel, and during the day the team are in training. By booking your room, you also support the Youth
                professional integration.</i>
        </h5>
        <br>
        <h5><i>Your booking is considered as donations and will finance the development of the project.</i></h5>
    </div>


</section>
<br>
<!--***************************************Rooms***********************************************-->
<section class="rooms" id="rooms" style="background-image: url('./img/Mantigue_room.png');">
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
    <div class="service-card  d-flex  m-auto w-100 flex-wrap ">
        <div class="card border-0 align-items-center col-12 col-lg-4 px-0 mt-3 mt-lg-0 p-5 ">
            <i class="fas fa-utensils m-4" style="font-size:50px;color:#808080"></i>
            <h5>Delicious Meals</h5>
            <p class="text-center w-75 mt-4">Experience the delight of Filipino cuisine. Enjoy mouthwatering specialties and learn culinary secrets with our expert-led sessions.</p>
        </div>

        <div class="card border-0 align-items-center col-12 col-lg-4 px-0 mt-3 mt-lg-0 p-5 ">
            <i class="fas fa-book m-4" style="font-size:50px;color:#808080"></i>
            <h5>Engaging Lessons</h5>
            <p class="text-center w-75 mt-4">Discover something new. Unlock skills and insights through engaging lessons guided by seasoned instructors in a welcoming environment.</p>
        </div>

        <div class="card border-0 align-items-center col-12 col-lg-4 px-0 mt-3 mt-lg-0 p-5 ">
            <i class="fas fa-bed m-4" style="font-size:50px;color:#808080"></i>
            <h5>Comfortable Stays</h5>
            <p class="text-center w-75 mt-4">Luxury redefined. Enjoy a comfortable stay with complimentary amenities, including free WiFi and a fully equipped kitchen.</p>
        </div>

        <div class="card border-0 align-items-center col-12 col-lg-4 px-0 mt-3 mt-lg-0 p-5 ">
            <i class="fas fa-globe m-4" style="font-size:50px;color:#808080"></i>
            <h5>Local Exploration</h5>
            <p class="text-center w-75 mt-4">Discover local gems. Immerse yourself in the beauty of our community with personalized tours and insights from savvy locals.</p>
        </div>

        <div class="card border-0 align-items-center col-12 col-lg-4 px-0 mt-3 mt-lg-0 p-5 ">
            <i class="fas fa-gift m-4" style="font-size:50px;color:#808080"></i>
            <h5>Souvenirs Galore</h5>
            <p class="text-center w-75 mt-4">Capture the magic. Elevate your journey with handpicked souvenirs, crafted to encapsulate the enchantment of your unforgettable experience.</p>
        </div>

        <div class="card border-0 align-items-center col-12 col-lg-4 px-0 mt-3 mt-lg-0 p-5 ">
            <i class="fas fa-hands-helping m-4" style="font-size:50px;color:#808080"></i>
            <h5>Positive Impact</h5>
            <p class="text-center w-75 mt-4">Join us in making a difference. Experience hospitality that goes beyond, creating a positive impact through vibrant community engagement.</p>
        </div>


    </div>
</section>
<br>
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

    <div id="fullImageContainer">
        <img id="fullImage" class="d-block w-100" alt="Full Image">
    </div>
    <script>
        // Get references to elements
        const carouselImages = document.querySelectorAll('.carousel-item img');
        const fullImageContainer = document.getElementById('fullImageContainer');
        const fullImage = document.getElementById('fullImage');

        // Add click event listeners to carousel images
        carouselImages.forEach((img) => {
            img.addEventListener('click', () => {
                // Get the source of the clicked image
                const imgSrc = img.src;

                // Display the full image
                fullImage.src = imgSrc;
                fullImageContainer.style.display = 'flex';

                // Disable scrolling
                document.body.style.overflow = 'hidden';
            });
        });

        // Add click event listener to the fullImageContainer to hide the modal
        fullImageContainer.addEventListener('click', () => {
            // Hide the full image container
            fullImageContainer.style.display = 'none';

            // Enable scrolling
            document.body.style.overflow = 'auto';
        });

        // Prevent clicks on the image from closing the modal
        fullImage.addEventListener('click', (event) => {
            event.stopPropagation();
        });
    </script>
<br><br>
    <h2 class="text-center mt-5">Explore & Engage at LP4Y Guest House Where Experiences Come to Life!</h2>
    <br>
    <br>
    <br>
    <div class="gallery-card d-flex justify-content-between">
        <div class="card border-0 w-100 align-items-center">
            <i class="fas fa-guitar" style="font-size: 50px; color: #808080;"></i> <br>

            <p class="text-center w-75">
                <b>Strum and Shine: </b> <br> Jam with the Youth for Guitar Training Fun!
            </p>
        </div>

        <div class="card border-0 w-100 align-items-center">
            <i class="fas fa-language" style="font-size: 50px; color: #808080;"></i> <br>
            <p class="text-center w-75">
                <b>Unlock the Beauty of Bisaya:</b> <br> Join our Youth-led Bisaya Dialect Training!
            </p>
        </div>

        <div class="card border-0 w-100 align-items-center">
            <i class="fas fa-coffee" style="font-size: 50px; color: #808080;"></i> <br>
            <p class="text-center w-75">
                <b> Fun Lunching with the Youth:</b> <br> A Delightful Fusion of Fun, Good Vibes, and Cherished Moments.
            </p>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="gallery-card d-flex justify-content-between">
        <div class="card border-0 w-100 align-items-center">
            <i class="fas fa-sun" style="font-size: 50px; color: #808080;"></i> <br>
            <p class="text-center w-75">
                <b> Start Your Day Right: </b><br> Savor Breakfast with the Youth for a Special and Unforgettable Guest House Experience.
            </p>
        </div>

        <div class="card border-0 w-100 align-items-center">
            <i class="fas fa-book" style="font-size: 50px; color: #808080;"></i> <br>
            <p class="text-center w-75">
                <b> Enriching Lessons:</b> <br> Embark on a Journey of Knowledge and Excellence with the Youth.
            </p>
        </div>

        <div class="card border-0 w-100 align-items-center">
            <i class="fas fa-bed" style="font-size: 50px; color: #808080;"></i> <br>
            <p class="text-center w-75">
                <b>Quality Rest:</b> <br> Time to relax!
            </p>
        </div>
    </div>
    <br><br><br>
    <!--********************************************* GUEST REVIEW *****************************************-->
    <section class="guest-review"">
        <div class="card shadow  ">
            <h4>GUEST REVIEW</h4>
            <br>

            <br>
            <div class="review-container">
                <div class="review active">
                    <blockquote>
                        “Amazing stay in LP4Y Guest House! The room is super clean with AC and private comfort room and hot shower! Thank you again so much LP4Y for the accommodation”
                        <p class="card-text">
                            <span class="star-rating">
                               &#9733;&nbsp;&#9733;&nbsp;&#9733;&nbsp;&#9733;&nbsp;&#9733;
                            </span>
                          </p>
                    </blockquote>
                    <p class="review-author">Albane d'Harcourt</p>
                </div>
                <div class="review">
                    <blockquote>
                        "Amazing experience in this guesthouse! The youth were very welcoming! As well , the guest house is super close to Cebu airport and well located for touristic visit!""

                        <p class="card-text">
                            <span class="star-rating">
                                &#9733;&nbsp;&#9733;&nbsp;&#9733;&nbsp;&#9733;&nbsp;&#9733;
                            </span>
                          </p>
                    </blockquote>
                    <p class="review-author">Maiwenn Lion</p>
                </div>
                <div class="review">
                    <blockquote>
                        “A great organization where you can actually travel for a cause.”

                        <p class="card-text">
                            <span class="star-rating">
                               &#9733;&nbsp;&#9733;&nbsp;&#9733;&nbsp;&#9733;&nbsp;&#9733;
                            </span>
                          </p>
                    </blockquote>
                    <p class="review-author">Kévin Labbé</p>
                </div>

                <div class="review">
                    <blockquote>
                        “The rooms are super nice and very affordable”

                        <p class="card-text">
                            <span class="star-rating">
                               &#9733;&nbsp;&#9733;&nbsp;&#9733;&nbsp;&#9733;&nbsp;&#9733;
                            </span>
                          </p>
                    </blockquote>
                    <p class="review-author">Vince Samer</p>
                </div>
            </div>

            <div class="radio-buttons">
                <input class="text-dark" type="radio" name="review-radio" id="review1" checked>
                <label for="review1"></label>
                <input class="text-dark" type="radio" name="review-radio" id="review2">
                <label for="review2"></label>
                <input class="text-dark" type="radio" name="review-radio" id="review3">
                <label for="review3"></label>
                <input class="text-dark" type="radio" name="review-radio" id="review4">
                <label for="review4"></label>
            </div>
<div class="d-flex mt-5 ">
       <!-- Add Review Button (Lower Left) -->
       <button class="btn-dark btn mt-3 text-white " id="addReviewBtn" style=" width: calc(50% - 30px); border-radius: 4px; margin: 30px; padding: 5px;" onclick="location.href='{{ route('review') }}'">Add Review</button>
       <!-- See More Reviews Button (Lower Right) -->
       <button class=" btn-dark  btn mt-3 text-white " id="seeMoreReviewsBtn" style="width: calc(50% - 30px); border-radius: 4px; margin: 30px; padding:5px;">See More Reviews</button>
</div>



    </section>
    </div>

    <br>
    <br>
    <br>
    <br>


</section>

<!--********************************************* CONTACT *******************************************-->
@include('partials._contact')

<!-- Messenger Chat plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "201607076359123");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v18.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));



    // Add a click event listener to the button
    document.getElementById('seeMoreReviewsBtn').addEventListener('click', function() {
        // Redirect to the allreviews page
        window.location.href = "{{ route('all-reviews') }}";
    });
</script>


<!--********************************************* FOOTER *******************************************-->
@include('partials._footer') @endsection
