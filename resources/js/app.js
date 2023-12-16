import './bootstrap';

import '../sass/app.scss';

import '~@fortawesome';
import '~jquery';
import '~jquery-ui';
import '~jquery-ui-css';







function updateTotal() {
    const checkInDate = $('#check-in').datepicker('getDate');
    const checkOutDate = $('#check-out').datepicker('getDate');
    const pricePerNight = parseFloat($('.room-details-price').text()); // Get the price per night as a float

    if (checkInDate && checkOutDate && !isNaN(pricePerNight)) {
        const timeDifference = checkOutDate.getTime() - checkInDate.getTime();
        const daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));

        // Calculate the total price
        const totalPrice = pricePerNight * daysDifference;

        // Update the element with the class "total" to display the total price
        $('.total').val(`${totalPrice.toFixed(0)}`);
        $('.total-display').text(`₱${totalPrice.toFixed(0)}`);


    } else {
        // If either date is not selected or price is not valid, clear the "total" element
        $('.total').val('');
        $('.total-display').text('');


    }
}

$(document).ready(function() {
    // Get the downpayment and total input elements
    const $downpaymentInput = $('#downpaymentinput');
    const $totalInput = $('.total');
    const $bookNowButton = $('.book_now'); // Get the book-now button

    // Add a click event listener to the book-now button
    $bookNowButton.on('click', function() {
        // Calculate 15% of the total
        const minDownpayment = parseFloat($totalInput.val()) * 0.15;
        $downpaymentInput.val(minDownpayment);

        // Set the minimum value for the downpayment input
        $downpaymentInput.attr('min', minDownpayment);
    });
});


const checkInButton = $('#check-in');
const checkOutButton = $('#check-out');
const dialogContent = $('#dialog-content');
const closeDialogButton = $('#close-dialog');
const dialog = $("dialog");
const book_now = $(".book_now")

book_now.click(function() {
    if (checkInButton.val() && checkInButton.val().trim() !== '' &&
        checkOutButton.val() && checkOutButton.val().trim() !== '') {
        $('.showmodal').click();
        $('.modal-body .check-in').val(checkInButton.val());
        $('.modal-body .check-out').val(checkOutButton.val());


    } else {
        checkInButton.focus();

    }
});

checkInButton.focus(function() {
    dialogContent.html(` <i class="fas fa-info-circle" style="font-size:15px"></i> Check-in is available from Tuesday to Saturday.`);
    dialog.show();
});

checkOutButton.focus(function() {
    dialogContent.html(` <i class="fas fa-info-circle"  style="font-size:15px"></i> Check-out is available from Tuesday to Saturday, and the maximum stay is 4 nights.`);
    dialog.show();
});

closeDialogButton.click(function() {
    dialog.hide();
});
// Attach a click event handler to the check-in element
$("#check-in").click(function() {
    // Clear the value of the check-out element
    $("#check-out").val("");
    $('.total').text("");


});

const today = new Date();
const defaultCheckoutDays = 3;
$.datepicker.setDefaults({
    dateFormat: "MM d, yy"
});

$('#check-in').datepicker({
    minDate: today,
    beforeShow: function(input, inst) {
        // Position the datepicker to the left of the input field
        var inputWidth = $(input).outerWidth();
        inst.dpDiv.css({
            top: $(input).offset().top + $(input).outerHeight(),
            left: $(input).offset().left - inputWidth + 5 // Adjust as needed
        });
    },
    beforeShowDay: function(date) {
        const day = date.getDay();
        return [(day !== 0 && day !== 1)];
    },
    onSelect: function(selectedDate) {
        const selected = new Date(selectedDate);
        const checkoutDate = new Date(selected.getTime() + defaultCheckoutDays * 24 * 60 * 60 * 1000);

        $('#check-out').datepicker('option', 'minDate', selected);
        $('#check-out').datepicker('option', 'maxDate', checkoutDate);

        $('#check-out').datepicker('option', 'beforeShowDay', function(date) {
            const day = date.getDay();
            const isWithin3Days = date >= selected && date <= checkoutDate;
            const isCheckin = date.getTime() === selected.getTime();
            return [(day !== 0 && day !== 1) && isWithin3Days && !isCheckin];
        });

        // Delay showing the check-out datepicker by a small amount of time
        setTimeout(function() {
            $("#check-out").datepicker("show");
        }, 100);

        // Update the total when the check-in date is selected
        updateTotal();
    }

});

$('#check-out').datepicker({
    beforeShow: function(input, inst) {
        // Calculate the position of the datepicker relative to the input field
        var inputOffset = $(input).offset();
        var inputWidth = $(input).outerWidth();
        var dpWidth = $(inst.dpDiv).outerWidth();

        // Position the datepicker to the left of the input field
        $(inst.dpDiv).css({
            top: inputOffset.top + $(input).outerHeight(),
            left: inputOffset.left - dpWidth + inputWidth,
        });
    },
    beforeShowDay: function(date) {
        const day = date.getDay();
        return [(day !== 0 && day !== 1)];
    },
    onSelect: function() {
        updateTotal();
    }
});





document.addEventListener('DOMContentLoaded', function() {
    // Get all h5 elements
    var h5Elements = document.querySelectorAll('h5');

    // Loop through each h5 element
    h5Elements.forEach(function(element) {
        // Check if the text content contains "/"
        if (element.textContent.includes('/')) {
            // Hide the element
            element.style.display = 'none';
        }
    });
});




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

            if (target.startsWith('#')) {
                // Check if target is a valid selector
                var targetElement = document.querySelector(target);
                if (targetElement) {
                    var offsetTop = targetElement.offsetTop - 150; // Subtract 150 pixels offset
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            } else {
                // Check if target is a valid URL
                window.location.href = target;
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

$(document).ready(function() {
    $(".navbar-nav .nav-link").on("click", function() {
        $(".navbar-toggler").click();
    });


});



///script for phone number is below
const input = document.querySelector("#phone");
const input2 = document.querySelector("#phone2");
const input3 = document.querySelector("#phone3");

const button = document.querySelector("#btn");
const errorMsg = document.querySelector("#error-msg");
const validMsg = document.querySelector("#valid-msg");
const errorMsg2 = document.querySelector("#error-msg2");
const validMsg2 = document.querySelector("#valid-msg2");


// here, the index maps to the error code returned from getValidationError - see readme
const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
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
            const errorCode = iti.getValidationError();
            errorMsg2.innerHTML = errorMap[errorCode];
            errorMsg2.classList.remove("hide");
        }
    }
});


// on input: validate
input3.addEventListener('input', () => {
    reset();
    if (input3.value.trim()) {
        if (iti3.isValidNumber()) {
            validMsg3.classList.remove("hide");
        } else {
            input3.classList.add("error");
            const errorCode = iti.getValidationError();
            errorMsg3.innerHTML = errorMap[errorCode];
            errorMsg3.classList.remove("hide");
        }
    }
});