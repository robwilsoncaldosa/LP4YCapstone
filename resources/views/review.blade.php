@extends('layouts.layout')
@section('title','LP4Y Guest House')
@section('content')
<!--***************************************Fixed-icons******************************************-->


<style>
   
  
    input, textarea {
        border: 1px solid black !important; /* Add black border to input fields */
        background-color: transparent !important; /* Set background to transparent or white */
        border-radius: 0 !important; /* Remove border radius */
        margin-top:20px;
    }
      
 

    .container-xl {
        width: 50%;
        margin: 100px auto;
        background-color: white; /* Set background to transparent or white */
        padding: 30px;
        border: 1px solid black; 
       text-align:center;
        
    }

    .form-floating>.form-control,
    .form-floating>.form-control-plaintext {
        padding: 1rem 0;
        background-color: transparent; /* Set background to transparent or white */
        border: 1px solid black; /* Add black border to input fields */
    }

    .form-floating>.form-control,
    .form-floating>.form-control-plaintext,
    .form-floating>.form-select {
        height: calc(2rem + calc(var(--bs-border-width) * 2));
        min-height: calc(2rem + calc(var(--bs-border-width) * 2));
        line-height: 1.25;
        border: 1px solid black; /* Add black border to input fields */
    }

    .form-control:focus {
        color: var(--bs-body-color);
        outline: 0;
        box-shadow: none;
        box-shadow: 0 1px 0 #1a82e2;
    }

    .form-floating>label {
        padding: .5rem 0rem;
    }

    /* button {
        margin-top: 20px;
        margin-bottom: 20px;
    
    } */

    button.btn-secondary {
    margin-top: 20px;
    margin-bottom: 20px;
    text-align: right;
    margin-left:20px;
    background-color: transparent;
    border: 1px solid black;
    color: black;
    transition: background-color 0.3s; 
  
}


button.btn-primary {
    margin-top: 20px;
    margin-bottom: 20px;
    text-align:right;
    background-color: black;
    border: 1px solid black;
    color: white;
    transition: background-color 0.3s;

}

button.btn-primary:hover,
button.btn-secondary:hover {
    background-color: white;
    color:grey;
    border: 1px solid black;
}

    img {
        width: 100%;
        max-width: 150px;
        height: auto;
        margin-right: 15px;
    }

    h1 {
        margin-right: 15px;
        margin-top: 40px;
        color: black;
    }


    @media (max-width: 768px) {
        img {
            max-width: 30%;
        }

        .container-xl {
            text-align: center;
            width: 95%;
            margin: 50px auto;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin-top: 10px;
        }

        .form-control {
            font-size: 12px;
        }

        label {
            color: black;
        }
    }
    #error-popup {
        display: none;
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #ffcccc;
        border: 1px solid #ff0000;
        border-radius: 5px;
        z-index: 1000;
    }

    #close-error-popup {
        position: absolute;
        top: 5px;
        right: 5px;
        cursor: pointer;
    }
    
</style>

<div class="container-xl">
    <div class="row">
        <div class="col-lg-3 col-md-12 mx-auto"> 
            <img src="../img/HostLogo.png" alt="Logo">
        </div>
        <div class="col-lg-9 col-md-12 mx-auto">
            <h1>Leave a Review</h1>
        </div>
    </div>
    


    <form action="{{ route('submit-review') }}" method="post" id="review-form">
    @csrf

    <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" style="height: 50px;" placeholder="Enter your email..." required>
    </div>

    <div class="form-group">
    <!-- Add a dropdown for room names -->
    <select class="form-control" id="room_name" name="room_name" style="height: 50px; margin-top:20px" required>
        <option value="" disabled selected>Select room</option>
        <!-- Populate the options dynamically from your database -->
        @foreach($rooms as $room)
            <option value="{{ $room }}">{{ $room }}</option>
        @endforeach
    </select>
</div>

    <div class="form-group">
        <textarea class="form-control" id="room_comment" name="room_comment" style="height: 100px;" placeholder="What can you say about this room?" required></textarea>
    </div>

    <div class="form-group">
        <input type="number" class="form-control" id="rating" name="rating" style="height: 50px;" min="1" max="5" placeholder="Rating (1-5)" required>
    </div>

    <div class="form-group">
        <textarea class="form-control" id="comment" name="comment" style="height: 100px;" placeholder="Write your overall experience" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Publish</button>
    <button type="button" class="btn btn-secondary" onclick="cancelReview()">Cancel</button>
</form>



 
</div>

<div id="error-popup">
    <span id="close-error-popup">&times;</span>
    <p id="error-message"></p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add this script block to the end of your blade file, after including jQuery -->

<!-- Add this script block to the end of your blade file, after including jQuery -->

<script>
   $(document).ready(function () {
        $('#review-form').on('submit', function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function (response) {
                    console.log(response);

                   

                    // Show the success message
                    showSuccessPopup();

                    // Optionally, you can redirect after a delay
                    setTimeout(function() {
                        window.location.href = '/';
                    }, 3000); // 3000 milliseconds (3 seconds) delay before redirecting
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    showErrorPopup(xhr.responseText);
                }
            });
        });

        // Confirmation popup when clicking the "Cancel" button
        $('button.btn-secondary').on('click', function () {
            var isConfirmed = confirm('Are you sure you want to cancel writing the review?');
            if (isConfirmed) {
                // User clicked "OK" in the confirmation popup
                window.location.href = '/';
            }
            // If the user clicked "Cancel," do nothing
        });

        // Close the error popup when the close button is clicked
        $('#close-error-popup').on('click', function () {
            $('#error-popup').hide();
        });

        // Close the error popup when clicking anywhere outside the popup
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#error-popup').length && !$(e.target).is('#error-popup')) {
                $('#error-popup').hide();
            }
        });

        // Function to show the success popup
        function showSuccessPopup() {
            // Display your success message or any other content
            alert('Review submitted successfully!');

            // Optionally, you can customize a modal or use a library like Bootstrap modal for a better user experience
        }

        // Function to show the error popup
        function showErrorPopup(errorMessage) {
            // Display your error message or any other content
            alert('Error: ' + errorMessage);

            // Optionally, you can customize a modal or use a library like Bootstrap modal for a better user experience
        }
    });
</script>

@endsection
