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
const roomid = $('#room_id').val();

$.datepicker.setDefaults({
    dateFormat: "MM d, yy"
}); // Fetch reserved dates for the specific room from the server
$.ajax({
    url: '/dashboard/reserved-dates/' + roomid,
    method: 'GET',
    success: function(data) {
        const reservedDates = data.reservedDates;
        console.log(reservedDates);

        // Create date ranges every two elements in the array
        const dateRanges = [];
        for (let i = 0; i < reservedDates.length; i += 2) {
            const startDate = reservedDates[i];
            const endDate = reservedDates[i + 1];
            dateRanges.push(`${startDate} to ${endDate}`);
        }

        // Initialize datepicker for check-in
        $('#check-in').datepicker({
            minDate: today,
            numberOfMonths: 2,
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
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
                const dateString = $.datepicker.formatDate("yy-mm-dd", date);

                // Check if the date falls within a range of reserved dates
                const isReservedRange = dateRanges.some(range => {
                    const [start, end] = range.split(" to ");
                    return dateString >= start && dateString <= end;
                });

                // Ensure that the current date is not reserved, not on Monday or Sunday, and not within the range
                return [(day !== 0 && day !== 1) && !isReservedRange, isReservedRange ? 'reserved-date' : ''];
            },

            onSelect: function(selectedDate) {
                const selected = new Date(selectedDate);
                const checkoutDate = new Date(selected.getTime() + defaultCheckoutDays * 24 * 60 * 60 * 1000);

                // Configure check-out datepicker
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
    },
    error: function(err) {
        // Initialize datepicker for check-in
        $('#check-in').datepicker({
            minDate: today,
            numberOfMonths: 2,
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
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


                // Ensure that the current date is not reserved, not on Monday or Sunday, and not within the range
                return [(day !== 0 && day !== 1)];
            },

            onSelect: function(selectedDate) {
                const selected = new Date(selectedDate);
                const checkoutDate = new Date(selected.getTime() + defaultCheckoutDays * 24 * 60 * 60 * 1000);

                // Configure check-out datepicker
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
    }
});


// Fetch reserved dates for the specific room from the server
$.ajax({
    url: '/dashboard/reserved-dates/' + roomid, // Replace with your actual endpoint
    method: 'GET',
    success: function(data) {
        const reservedDates = data.reservedDates;

        $('#check-out').datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 2,
            showButtonPanel: true,
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
                const dateString = $.datepicker.formatDate("yy-mm-dd", date);
                const isReserved = reservedDates.indexOf(dateString) !== -1;
                return [(day !== 0 && day !== 1) && !isReserved];
            },
            onSelect: function() {
                updateTotal();
            }
        });

    },
    error: function(err) {
        console.error('Error fetching reserved dates:', err);

        $('#check-out').datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 2,
            showButtonPanel: true,
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

// Function to handle radio button change
function handleRadioChange(index) {
    reviews.forEach(review => review.classList.remove('active'));
    reviews[index].classList.add('active');
}

// Add event listener for radio button change
reviewRadios.forEach((radio, index) => {
    radio.addEventListener('change', () => {
        handleRadioChange(index);
    });
});

// Initialize Hammer.js for swipe detection
var hammer = new Hammer(document.querySelector('.review-container'));
var currentIndex = 0;

hammer.on('swipeleft', function() {
    // Handle swipe left
    currentIndex = (currentIndex + 1) % reviewRadios.length;
    reviewRadios[currentIndex].checked = true;
    handleRadioChange(currentIndex);
});

hammer.on('swiperight', function() {
    // Handle swipe right
    currentIndex = (currentIndex - 1 + reviewRadios.length) % reviewRadios.length;
    reviewRadios[currentIndex].checked = true;
    handleRadioChange(currentIndex);
});


document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling when clicking on a nav-link
    var navLinks = document.querySelectorAll('a.nav-link:not(.btn-book-room)');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var target = this.getAttribute('href');
            var currentPage = window.location.pathname; // Get the current page URL

            if (currentPage !== '/') {
                // If the current page is not '/', redirect to "/"
                window.location.href = "/" + target;
            }

            // Perform smooth scrolling
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
        // Check if the screen width is 425px
        if (window.innerWidth <= 425) {
            $(".navbar-toggler").click();
        }
    });
});
