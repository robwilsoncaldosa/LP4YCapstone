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
        text-align: left;
        margin-top: 35px;
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
</style>

<div class="container-xl">
    <div class="row">
        <div class="col-lg-3 col-md-12 mx-auto"> <!-- Center the column -->
            <img src="../img/HostLogo.png" alt="Logo">
        </div>
        <div class="col-lg-9 col-md-12">
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
    <select class="form-control" id="room_name" name="room_name" style="height: 50px;" required>
        <option value="" disabled selected>Select room</option>
        <!-- Populate the options dynamically from your database -->
        @foreach($rooms as $room)
            <option value="{{ $room->room_name }}">{{ $room->room_name }}</option>
        @endforeach
    </select>
</div>

    <div class="form-group">
        <textarea class="form-control" id="room_comment" name="room_comment" style="height: 200px;" placeholder="What can you say about this room?" required></textarea>
    </div>

    <div class="form-group">
        <input type="number" class="form-control" id="rating" name="rating" style="height: 50px;" min="1" max="5" placeholder="Rating (1-5)" required>
    </div>

    <div class="form-group">
        <textarea class="form-control" id="comment" name="comment" style="height: 200px;" placeholder="Write your overall experience" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Publish</button>
    <button type="button" class="btn btn-secondary" onclick="cancelReview()">Cancel</button>
</form>



    <!-- Thank you message div -->
    <div id="thank-you-message" style="display: none; margin-top: 20px;">
        Thank you dear guest! We appreciate your time and effort for writing a review.
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                console.log(response); // Log the response to the console
                $('#review-form').hide();
                $('#thank-you-message').show();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Log the error to the console
            }
        });
    });
});

</script>
@endsection
