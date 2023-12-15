@extends('layouts.layout')
@section('title', 'All Reviews')
@section('content')
@include('partials._header')
@include('partials._fixed-icons')
<div class="container-xl" style="margin-top:100px">
    <h1>All Reviews</h1>
    <div class="row">
        @foreach ($reviews as $review)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body" style="display: flex; align-items: center;">
                        @php
                            // Get the first letter of the user's name
                            $initial = strtoupper(substr($review->user->name, 0, 1));
                            // Generate random background color
                            $randomColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                        @endphp
                        <div style="margin-top: 0px; width: 50px; height: 50px; background-color: {{ $randomColor }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <span style="color: #fff; font-size: 20px; font-weight: bold;">{{ $initial }}</span>
                        </div>

                        <div style="margin-left: 10px;">
                            <h5 class="card-title">{{ $review->user->name }}</h5>
                            <p class="card-text">Rating: {{ $review->rating }}</p>
                            <p class="card-text">Comment: {{ $review->comment }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
