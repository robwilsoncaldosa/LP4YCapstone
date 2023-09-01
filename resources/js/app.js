import './bootstrap';

import '../sass/app.scss';

import '~@fortawesome';
import '~jquery';
import '~jquery-ui';
import '~jquery-ui-css';





$(document).ready(function() {
    const today = new Date();
    const defaultCheckoutDays = 3;
    $.datepicker.setDefaults({
        dateFormat: "MM d, yy"
    })
    $('#check-in').datepicker({
        minDate: today,
        beforeShowDay: function(date) {
            const day = date.getDay();
            return [(day !== 0 && day !== 1)];
        },
        onSelect: function(selectedDate) {
            const selected = new Date(selectedDate);
            const checkoutDate = new Date(selected.getTime() + defaultCheckoutDays * 24 * 60 * 60 * 1000);

            $('#check-out').datepicker("option", "minDate", selected);
            $('#check-out').datepicker("option", "maxDate", checkoutDate);

            $('#check-out').datepicker("option", "beforeShowDay", function(date) {
                const day = date.getDay();
                const isWithin3Days = date >= selected && date <= checkoutDate;
                const isCheckin = date.getTime() === selected.getTime();
                return [(day !== 0 && day !== 1) && isWithin3Days && !isCheckin];
            });
        }
    });
    $('#check-out').datepicker({
        beforeShowDay: function(date) {
            const day = date.getDay();
            return [(day !== 0 && day !== 1)];
        }
    })
})


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