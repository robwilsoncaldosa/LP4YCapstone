import './bootstrap';

import '../sass/app.scss';

import '~@fortawesome';
import '~jquery';
import '~jquery-ui';
import '~jquery-ui-css';


$("#check-in,#check-out").datepicker();



const reviewRadios = document.querySelectorAll('input[name="review-radio"]');
const reviews = document.querySelectorAll('.review');

reviewRadios.forEach((radio, index) => {
    radio.addEventListener('change', () => {
        reviews.forEach(review => review.classList.remove('active'));
        reviews[index].classList.add('active');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling when clicking on a nav-link
    var navLinks = document.querySelectorAll('a.nav-link:not(.btn-book-room)');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var target = this.getAttribute('href');
            var currentPage = window.location.pathname; // Get the current page URL
            if (currentPage !== '/book') { // Replace '/book' with the correct URL for book.blade.php
                var targetElement = document.querySelector(target);
                if (targetElement) {
                    var offsetTop = targetElement.offsetTop - 150; // Subtract 150 pixels offset
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            } else {
                var currentPage = window.location.href; // Get the current page URL
                var updatedUrl = currentPage.replace('/book', '') + target;
                window.location.href = updatedUrl;
            }
        });
    });




    // Add 'active' class to nav-link when corresponding section is in view
    window.addEventListener('scroll', function() {
        var scrollPosition = window.scrollY;
        var sections = document.querySelectorAll('section');
        sections.forEach(function(section) {
            var sectionTop = section.offsetTop - 150 // Adjust the offset if needed
            var sectionId = section.getAttribute('id');
            if (scrollPosition >= sectionTop) {
                navLinks.forEach(function(link) {
                    link.classList.remove('active');
                });
                var currentPage = window.location.pathname; // Get the current page URL
                if (currentPage !== '/book') {
                    var correspondingLink = document.querySelector('a.nav-link[href="#' + sectionId + '"]');
                    if (correspondingLink) {
                        correspondingLink.classList.add('active');
                    }
                }
            }
        });
    });
});

// --------------------------START BOOK------------------

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

    window.location.href = `room_details.blade.php?${urlParams.toString()}`;
}

// --------------------END BOOK----------------

// --------------------STARTS BOOK_DETAILS---------------

window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    const roomName = urlParams.get('name');
    const roomDescription = urlParams.get('description');
    const roomPrice = urlParams.get('price');
    const roomImage = urlParams.get('image');

    document.getElementById('room-name').textContent = roomName;
    document.getElementById('room-image').src = roomImage;
    document.querySelector('.room-description').textContent = roomDescription;
    document.querySelector('.room-details-price').textContent = roomPrice;
};
