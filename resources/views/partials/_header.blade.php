<!--******************************************  Header  ***********************************************-->
<nav class="navbar navbar-expand-lg navbar-dark   navbar-custom sticky-top  ">
    <div class="container d-flex flex-column flex-lg-row justify-content-center  ">
        <a class="navbar-brand  d-flex align-items-center" href="{{route('app')}}">
            <div class="border-white border  border-1 d-lg-none  m-4 m-lg-0 w-100"></div>
            <img src="../img/LP4Y_Logo.webp" alt="Logo" width="75px">
            <div class="border-white border  border-1 d-lg-none  m-4 m-lg-0 w-100">
            </div>
        </a>

        <li class="nav-item  d-lg-none d-flex justify-content-center w-100 align-items-center ">
            <a class="nav-link  btn btn-book-room  border border-1 border-white hover m-3 col-8 p-4"
                href="{{ route('book') }}">
                Book a Room
            </a>
            <button class="navbar-toggler col-4 border-white p-4 m-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>
        </li>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav   flex-grow-1 justify-content-evenly align-items-center  ">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                        href="#home">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#rooms">ROOMS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">SERVICES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">GALLERY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">CONTACT</a>
                </li>

                <li class="nav-item d-none d-lg-block ">
                    <a href="{{route('book')}}" class="nav-link btn btn-book-room p-2">
                        <span class="p-4">Book a Room</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<script>

$(document).ready(function() {

function toggleW100Class() {
    var windowWidth = $(window).width();
    var navbarBrand = $('.navbar-brand');

    if (windowWidth <= 992) {
        navbarBrand.addClass('w-100');
    } else {
        navbarBrand.removeClass('w-100');
    }
}

// Call the function on page load
toggleW100Class();

// Call the function on window resize
$(window).resize(function() {
    toggleW100Class();
});
});
</script>
