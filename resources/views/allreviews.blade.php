@extends('layouts.layout')
@section('title', 'All Reviews')
@section('content')
@include('partials._header')
@include('partials._fixed-icons')

<style>
    .review-card {
    transition: transform 0.3s ease-in-out;
}

.review-card:hover {
    transform: scale(1.03);
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
}

.star-rating {
    color: #ffd700; /* Gold color for stars */
    font-size: 25px;
}

.user-details {
    flex-grow: 1;
}

.card-title {
    margin-bottom: 0.5rem;
}

.card-text {
    color: #555;
}

</style>
<div class="container-xl mt-5">
    <h1 class="text-center mb-4">All Reviews</h1>

    <div class="row">
        @foreach ($reviews as $review)
            <div class="col-md-6 mb-4">
                <div class="card review-card">
                    <div class="card-body d-flex align-items-start">
                        @php
                            $initial = strtoupper(substr($review->user->name, 0, 1));
                            $randomColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                        @endphp
                        <div class="user-avatar" style="background-color: {{ $randomColor }};">
                            <span>{{ $initial }}</span>
                        </div>

                        <div class="user-details ml-3 mt-2 ms-3">
                            <h5 class="card-title">{{ $review->user->name }}</h5>
                            <p class="card-text">
                                Rating:
                                <span class="star-rating">
                                    @for ($i = 1; $i <= $review->rating; $i++)
                                        &#9733;
                                    @endfor
                                    @for ($i = $review->rating + 1; $i <= 5; $i++)
                                        &#9734;
                                    @endfor
                                </span>
                            </p>

                            <p class="card-text">Comment: {{ $review->comment }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection
