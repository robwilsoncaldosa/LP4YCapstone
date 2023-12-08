@extends('layouts.layout')
@section('title','LP4Y Guest House')
@section('content')
<!--***************************************Fixed-icons******************************************-->


<style>
   
    input {
        border-bottom: 1px solid rgb(212, 218, 223);
    }

    .container-xl {
        width: 50%;
        margin: 100px auto; /* Center the container */
        background-color: #08080815;
        padding: 30px;
        border-radius: 10px;
    }

    .form-floating>.form-control,
    .form-floating>.form-control-plaintext {
        padding: 1rem 0;
    }

    .form-floating>.form-control,
    .form-floating>.form-control-plaintext,
    .form-floating>.form-select {
        height: calc(2rem + calc(var(--bs-border-width) * 2));
        min-height: calc(2rem + calc(var(--bs-border-width) * 2));
        line-height: 1.25;
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

    button {
        margin-top: 20px;
        text-align: center;
        margin-bottom: 20px;
    }

    img {
        width: 100%; /* Make the image responsive */
        max-width: 150px; /* Set maximum width */
        height: auto; /* Maintain aspect ratio */
        margin-right: 15px;
    }

    h1 {
        text-align: left; 
        margin-top:35px;
        color:black;
    }

    @media (max-width: 768px) {
        img {
            max-width: 30%; /* Set smaller maximum width for smaller screens */
        }

        .container-xl {
            text-align: center;
            width: 95%; /* Full width on screens with a maximum width of 768 pixels */

            margin: 50px auto;
        }

        h1 {
            font-size: 20px;
            text-align:center;
            margin-top:10px;
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
            <h1>Write a Review</h1>
        </div>
    </div>

    <form action="{{ route('submit-review', ['reservation' => $reservation->id]) }}" method="post" id="review-form">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" style="height: 50px;" placeholder="Your Name" required>
        </div>

        <div class="form-group">
            <input type="number" class="form-control" id="rating" name="rating" style="height: 50px;" min="1" max="5"
                placeholder="Rating (1-5)" required>
        </div>

        <div class="form-group">
            <textarea class="form-control" id="comment" name="comment" style="height: 200px;" placeholder="Write your review here" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
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
                success: function () {
                    $('#review-form').hide();
                    $('#thank-you-message').show();
                }
            });
        });
    });
</script>
@endsection
