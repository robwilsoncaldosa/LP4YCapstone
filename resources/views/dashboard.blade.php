

@extends('layouts.layout') @section('title', 'Dashboard') @section('content')

<style>
     body{

        overflow-x: hidden;
     }
   .nav-link,
    p {
        color: #888b92;
        font-size: 16px;
    }

    i {
        margin-right: 20px;
        font-size: 20px;
    }

    ul .nav-item:hover,
    .nav-item.active {
        color: black;
        background-color: #f6f7f6;
        border-radius: 25px;
        border-top-right-radius: 0px;
        border-end-end-radius: 0px;
    }

    .content {
        background-color: #f6f7f6;
        min-height: 100vh;
        height: 100%;
    }

    .circle-portrait {
        display: inline-block;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: rgb(70, 70, 70);
        text-align: center;
        line-height: 35px;
        font-size: 18px;
        font-weight: bold;
        color: white;
        margin-right: 10px;
    }

    .search-filter {
        border: 1px solid #000; 
        border-radius: 0; 
    }


    .btn-edit {
        background: transparent;
        border: 1px solid #000;
        border-radius: 0; 
        color: #000;
        transition: background-color 0.3s ease; 
    }

   
    .btn-delete {
        background: transparent;
        border: 1px solid #000;
        border-radius: 0;
        color: #000; 
        transition: background-color 0.3s ease;
    }

 
    .btn-edit:hover,
    .btn-delete:hover {
        background-color: #000;
        color: #fff; 
    }
   

    /* Responsive styles */
    @media (max-width: 767px) {
        .container-fluid.row {
            flex-direction: column;
        }

        .nav {
            width: 100%;
            min-width: 0;
            order: 2;
            margin-top: 20px;
            overflow-y: auto; 
            max-height: 80vh; 
        }

        .content {
            order: 1;
            overflow-y: auto; 
            max-height: 80vh; 
    }

    @media (min-width: 768px) {
        .container-fluid.row {
            flex-direction: row;
        }

        .navbar-nav {
            justify-content: flex-start;
        }

        .col-lg-2 {
            flex: 0 0 20%;
            max-width: 20%;
            padding-right: 15px;
            padding-left: 15px;
            background-color: white;
        }

        .content.col-10 {
            flex: 0 0 80%;
            max-width: 80%;
            padding-right: 15px;
            padding-left: 15px;
        }
    }
}
    
</style>

@if(auth()->check())
    @php
        $user = auth()->user();
    @endphp

<nav class="container-fluid row p-0 m-0" style="height: 100vh;">
    <div class="col-lg-2  h-100 position-relative p-0 m-0" style="background-color: white;">
        <div class="container mt-3">
            <img src="../img/HostLogo.png" width="100px" />
            <h5 class=" fw-bold" style="color: #888b92;display: inline;">Dashboard</h5>
        </div>

        <div class="container mt-5 ps-4 pe-0">
            <h5 class="text-uppercase fw-bold" style="color: #776061;font-size: 18px;">Menu</h5>

            <ul class="navbar-nav flex-grow-1 justify-content-start align-items-start">
                <li class="nav-item w-100  p-2">
                    <a class="nav-link " href="{{ route('dashboard.home') }}"><i class="fas fa-home"></i>HOME</a>
                </li>
           

                <li class="nav-item w-100 p-2">
                  <a class="nav-link" href="{{ route('dashboard.reservations') }}"><i class="far fa-calendar-check"></i> RESERVATION</a>
                </li>

                <li class="nav-item w-100 p-2">
                    <a class="nav-link" href="{{ route('dashboard.roomStatuses') }}"><i class="fas fa-door-closed"></i> ROOM STATUS</a>
                </li>

            </ul>
        </div>



        @if ($user->role === 'admin')
            <div class="container mt-4 ps-4 pe-0">
                <h5 class="text-uppercase fw-bold" style="color: #776061;font-size: 18px;">Maintenance</h5>

                <ul class="navbar-nav flex-grow-1 justify-content-start align-items-start">
                    <li class="nav-item w-100 p-2">
                        <a class="nav-link " href="{{ route('dashboard.rooms') }}"><i class="fas fa-door-open"></i>ROOM</a>
                    </li>
                    
                    <li class="nav-item w-100 p-2">
                    <a class="nav-link" href="{{ route('dashboard.transactions') }}"><i class="fas fa-exchange-alt"></i> TRANSACTIONS</a>
                </li>
                    
                    <li class="nav-item w-100 p-2">
                        <a class="nav-link" href="{{ route('dashboard.users') }}"><i class="fas fa-users"></i>USERS</a>
                    </li>

                    <li class="nav-item w-100 p-2">
                        <a class="nav-link" href="{{ route('dashboard.personnel') }}"><i class="fas fa-id-badge"></i> PERSONNEL</a>
                    </li>
                </ul>
            </div>
        @endif

        <div class="container position-absolute  bottom-0 pb-3 ps-4">
            <h5 class="text-uppercase fw-bold" style="color: #776061">Profile</h5>
            <div class="container mt-3">

                <a class="nav-link d-flex " href="#" style="color: black;font-weight:bold;"><span
                        class="circle-portrait">{{ $user->name[0] }}</span>

                    <p class="d-flex flex-column text-center role  ">
                        <span style="font-size:16px;font-weight:400;">
                            {{ $user->name }}
                        </span>

                        <span class="text-uppercase">
                            {{ $user->role }}

                        </span>

                    </p>
                </a>

                </li>
                <div class="container d-flex p-0  mb-3 w-100 ">
                    <form action="{{ route('logout') }}" method="post" style="width:90%">
                        @csrf
                        <button type="submit" class="btn d-flex justify-content-start align-items-center w-100"
                            style="color:#888b92 ;font-size: 20px;margin-right: 15px;">
                            <i class="fas fa-sign-out-alt" style="transform:rotate(180deg)"></i> Sign out
                        </button>
                    </form>
                </div>

            </div>
        </div>



    </div>
    <div class="content col-10 p-0">
        <header class="w-100 bg-white d-flex justify-content-between " style="height: 15%;">
            <div class="welcome p-4">
                <h1 class="fw-bold p-2">Welcome, {{ $user->name }}🎉</h1>
                <h4 class="p-2" style="color:#776061">Here's what's happening in your account today.</h4>
            </div>

            <div class="notification p-4">
                <ul class="navbar-nav flex-row  p-4">
                    <li class="nav-item p-3">
                        <a class="nav-link" href="#"><i class="far fa-envelope"
                                style="color:black;font-size: 35px;"></i> </a>
                    </li>
                    <li class="nav-item p-3">
                        <a class="nav-link" href="#"><i class="far fa-bell"
                                style="color:black;font-size: 35px;"></i> </a>
                    </li>
                </ul>

            </div>
        </header>

        <main class="p-5 ">

        @if(request()->is('dashboard/home'))
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: white;">Total Bookings</h5>
                    <p class="card-text" style="font-size: 2em; color: yellow;"><strong>{{ $totalBookings }}</strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: white;">New Bookings This Month</h5>
                    <p class="card-text" style="font-size: 2em; color: yellow;"><strong>{{ $newClientsThisMonth }}</strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: white;">Returning Guests</h5>
                    <p class="card-text" style="font-size: 2em; color: yellow;"><strong>{{ $returningClients }}</strong></p>
                </div>
            </div>
        </div>
    </div>
@endif

@if(request()->is('dashboard/reservations'))
    <!-- Add the 'active' class to highlight the RESERVATION link -->
    <h2>Reservations</h2>

    <div class="row">
        <!-- Search Bar -->
        <div class="col-md-6 mb-3">
            <label for="reservationSearch">Search:</label>
            <input type="text" id="reservationSearch" class="form-control search-filter" placeholder="Enter name, email, or room name">
        </div>

        <!-- Filter by Date -->
        <div class="col-md-6 mb-3">
            <label for="dateFilter">Filter by Date:</label>
            <input type="date" id="dateFilter" class="form-control search-filter" placeholder="Select date">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table" id="reservationsTable">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Room Name</th>
                    <th>Check-in Date</th>
                    <th>Check-in Time</th>
                    <th>Check-out Date</th>
                    <th>Check-out Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Sort reservations by creation date in descending order
                    $sortedReservations = $reservations->sortByDesc('created_at');
                ?>

                @foreach($sortedReservations as $reservation)
                    <tr class="reservationRow">
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->user->email }}</td>
                        <td>{{ $reservation->room->room_name }}</td>
                        <td>{{ $reservation->check_in_date }}</td>
                        <td>{{ date('g:i A', strtotime($reservation->check_in_time)) }}</td>
                        <td>{{ $reservation->check_out_date }}</td>
                        <td>{{ date('g:i A', strtotime($reservation->check_out_time)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle date filter change
            $('#dateFilter').change(function() {
                var selectedDate = $(this).val();

                // Show/hide rows based on the selected date
                $('.reservationRow').each(function() {
                    var checkInDate = $(this).find('td:eq(3)').text(); // Adjust the index based on your table structure
                    if (selectedDate === '' || checkInDate === selectedDate) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Handle search bar input
            $('#reservationSearch').keyup(function() {
                var searchText = $(this).val().toLowerCase();

                // Filter rows based on user input
                $('.reservationRow').each(function() {
                    var userName = $(this).find('td:eq(0)').text().toLowerCase(); // Adjust the index based on your table structure
                    var userEmail = $(this).find('td:eq(1)').text().toLowerCase();
                    var roomName = $(this).find('td:eq(2)').text().toLowerCase();

                    if (userName.includes(searchText) || userEmail.includes(searchText) || roomName.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endif


                @if(request()->is('dashboard/rooms'))
                 
                    <h2 class="mt-4">All Rooms</h2>

                    <!-- Add Room Button -->
                    <button class="btn btn-outline-dark mb-3" type="button" id="addRoomButton" data-bs-toggle="modal" data-bs-target="#addRoomModal">Add Room</button>

                  <!-- Modal for Add/Update Room -->
                    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addRoomModalLabel">Add Room</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add Room Form -->
                                    <form action="{{ route('rooms.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="room_name" class="form-label">Room Name</label>
                                            <input type="text" class="form-control" id="room_name" name="room_name" required>
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" required></textarea>
                                        </div>

                                        <!-- Accommodates -->
                                        <div class="mb-3">
                                            <label for="accommodates" class="form-label">Accommodates</label>
                                            <input type="number" class="form-control" id="accommodates" name="accommodates" required>
                                        </div>

                                        <!-- Beds -->
                                        <div class="mb-3">
                                            <label for="beds" class="form-label">Beds</label>
                                            <input type="number" class="form-control" id="beds" name="beds" required>
                                        </div>

                                        <!-- Bed Type -->
                                        <div class="mb-3">
                                            <label for="bed_type" class="form-label">Bed Type</label>
                                            <input type="text" class="form-control" id="bed_type" name="bed_type" required>
                                        </div>

                                        <!-- Amenities -->
                                        <div class="mb-3">
                                            <label for="amenities" class="form-label">Amenities</label>
                                            <input type="text" class="form-control" id="amenities" name="amenities" required>
                                        </div>

                                        <!-- Price per Night -->
                                        <div class="mb-3">
                                            <label for="price_per_night" class="form-label">Price per Night</label>
                                            <input type="text" class="form-control" id="price_per_night" name="price_per_night" required>
                                        </div>

                                        <!-- Image -->
                                                        
                                        <div class="mb-3">
                                            <label for="image_path" class="form-label">Upload Image</label>
                                            <input type="file" class="form-control" id="image_path" name="image_path">
                                        </div>


                                        <!-- Add other room fields as needed -->

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add Room</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Room Table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Room Name</th>
                                    <th>Description</th>
                                    <th>Accommodates</th>
                                    <th>Beds</th>
                                    <th>Bed Type</th>
                                    <th>Amenities</th>
                                    <th>Price per Night</th>
                                    <th>Image</th>
                                    <th>Action</th> <!-- Add this column for Delete and Update buttons -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td>{{ $room->room_name }}</td>
                                        <td>{{ $room->description }}</td>
                                        <td>{{ $room->accommodates }}</td>
                                        <td>{{ $room->beds }}</td>
                                        <td>{{ $room->bed_type }}</td>
                                        <td>{{ $room->amenities }}</td>
                                        <td>{{ $room->price_per_night }}</td>
                                        <td><img src="{{ asset($room->image_path) }}" alt="Room Image" style="width: 50px; height: 50px;"></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Update Button -->
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateRoomModal{{ $room->id }}">
                                                    Update
                                                </button>
                                                <!-- Delete Button -->
                                                <form action="{{ route('rooms.destroy', $room->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger" style="border-radius: 5px;">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                <!-- Modal for Update Room -->
                            <div class="modal fade" id="updateRoomModal{{ $room->id }}" tabindex="-1" aria-labelledby="updateRoomModalLabel{{ $room->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateRoomModalLabel{{ $room->id }}">Update Room</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Update Room Form -->
                                            <form action="{{ route('rooms.update', $room->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')

                                                <!-- Room Name -->
                                                <div class="mb-3">
                                                    <label for="room_name" class="form-label">Room Name</label>
                                                    <input type="text" class="form-control" id="room_name" name="room_name" value="{{ $room->room_name }}" required>
                                                </div>

                                                <!-- Description -->
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" id="description" name="description" required>{{ $room->description }}</textarea>
                                                </div>

                                                <!-- Accommodates -->
                                                <div class="mb-3">
                                                    <label for="accommodates" class="form-label">Accommodates</label>
                                                    <input type="number" class="form-control" id="accommodates" name="accommodates" value="{{ $room->accommodates }}" required>
                                                </div>

                                                <!-- Beds -->
                                                <div class="mb-3">
                                                    <label for="beds" class="form-label">Beds</label>
                                                    <input type="number" class="form-control" id="beds" name="beds" value="{{ $room->beds }}" required>
                                                </div>

                                                <!-- Bed Type -->
                                                <div class="mb-3">
                                                    <label for="bed_type" class="form-label">Bed Type</label>
                                                    <input type="text" class="form-control" id="bed_type" name="bed_type" value="{{ $room->bed_type }}" required>
                                                </div>

                                                <!-- Amenities -->
                                                <div class="mb-3">
                                                    <label for="amenities" class="form-label">Amenities</label>
                                                    <input type="text" class="form-control" id="amenities" name="amenities" value="{{ $room->amenities }}" required>
                                                </div>

                                                <!-- Price per Night -->
                                                <div class="mb-3">
                                                    <label for="price_per_night" class="form-label">Price per Night</label>
                                                    <input type="text" class="form-control" id="price_per_night" name="price_per_night" value="{{ $room->price_per_night }}" required>
                                                </div>

                                                <!-- Image Upload -->
                                                <div class="mb-3">
                                                    <label for="image_path" class="form-label">Room Image</label>
                                                    <img src="{{ asset($room->image_path) }}" alt="Room Image" style="width: 50px; height: 50px;">
                                                    <input type="file" class="form-control" id="image_path" name="image_path">
                                                </div>

                                                <!-- Add other room fields as needed -->

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update Room</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- JavaScript to Handle Modal Actions -->
                    <script>
                        $(document).ready(function () {
                            // Open modal and clear form when the modal is shown
                            $('#addRoomModal, [id^="updateRoomModal"]').on('show.bs.modal', function (event) {
                                var modalId = $(this).attr('id');
                                var roomId = modalId.replace(/\D/g, ''); // Extract room ID from modal ID
                                // Clear form fields
                                $('#' + modalId + ' form').trigger('reset');
                                // You can also populate the form fields if updating a room
                                // For example: $('#room_name').val('Existing Room Name');
                            });
                        });
                    </script>
                @endif

 
            @if(request()->is('dashboard/roomStatuses'))
            <h2>Room Status</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($roomStatuses as $roomStatus)
                            <tr>
                                <td>{{ $roomStatus->room_name }}</td>
                                <td>{{ $roomStatus->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @endif


                @if(request()->is('dashboard/users'))
                <div class="container-fluid">
                    <h2 class="mt-4">Guest</h2>
                    <form class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search guest...(name, email, mobile)" style="border-radius: 0; background-color: #f2f2f2; border: 1px solid #ccc;">
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table" id="userTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->contact_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <style>
                    #searchInput {
                        border-radius: 0;
                        background-color: #FFFAFA;
                        border: 1px solid #ccc;
                      
                    }
                </style>

                <script>
                    $(document).ready(function () {
                        // Add an input event listener to the search input
                        $('#searchInput').on('input', function () {
                            // Get the search value
                            var searchText = $(this).val().toLowerCase();

                            // Filter the table rows based on the search value
                            $('#userTable tbody tr').filter(function () {
                                $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                            });
                        });
                    });
                </script>
            @endif



                        @if(session('error'))
                            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Trigger the error modal automatically -->
                            <script>
                                $(document).ready(function () {
                                    $('#errorModal').modal('show');
                                });
                            </script>
                        @endif




            @if(request()->is('dashboard/transactions'))
                    <h2>Transactions</h2>

                    <div class="total_net text-center mb-3">
                        <div class="row justify-content-center">
                            <div class="col-md-5 text-end">
                                <strong><i class="fas fa-coins"></i> Total Receivable:</strong> <span id="totalRemainingBalance">PHP 0</span>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5 text-start">
                                <strong><i class="fas fa-money-bill-wave"></i> Current Total Income:</strong> <span id="totalAmountPaid">PHP 0</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nameFilter">Filter by Name:</label>
                        <input type="text" class="form-control" id="nameFilter" name="nameFilter" placeholder="Enter name...">
                    </div>

                    <!-- Display transaction data in a table -->
                    <div class="table-responsive">
                        <table class="table" id="transactionsTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Amount Paid</th>
                                    <th>Remaining Balance</th>
                                    <th>Payment Method</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr class="paymentRow">
                                        <td>{{ $payment->reservation->user->name }}</td>
                                        <td>{{ $payment->reservation->room->price_per_night }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->remaining_total }}</td>
                                        <td>{{ $payment->payment_method }}</td>
                                        <td>{{ $payment->created_at }}</td>
                                        <td>
                                            <!-- Trigger modal for editing -->
                                            <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editPaymentModal{{ $payment->id }}">
                                                Edit
                                            </button>

                                            <!-- Delete button -->
                                            <form action="{{ route('dashboard.transactions.destroy', ['id' => $payment->id]) }}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this payment?')">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            function updateTotalAmount() {
                                // Fetch the total amount and total remaining balance from the server
                                $.get('/dashboard/transactions/total-amount', function (data) {
                                    var totalAmount = data.totalAmount || 0;
                                    var totalRemainingBalance = data.totalRemainingBalance || 0;
                                    
                                    // Display the updated total amount and total remaining balance with PHP label
                                    $('#totalAmountPaid').text('PHP ' + totalAmount);
                                    $('#totalRemainingBalance').text('PHP ' + totalRemainingBalance);
                                });
                            }

                            // Fetch the initial total amount and total remaining balance
                            updateTotalAmount();

                            // Listen for input changes in the name filter field
                            $('#nameFilter').on('input', function () {
                                // Get the entered filter text
                                var filterText = $(this).val().toLowerCase();

                                // Fetch and display the updated total amount and total remaining balance
                                updateTotalAmount();

                                // Loop through each row in the table body
                                $('#transactionsTable tbody tr').each(function () {
                                    // Get the text content of the third cell (amount paid)
                                    var rowAmount = parseFloat($(this).find('td:nth-child(3)').text());

                                    // Show or hide the row based on whether it matches the filter
                                    var isVisible = rowAmount && (filterText === '' || $(this).text().toLowerCase().includes(filterText));
                                    $(this).toggle(isVisible);
                                });
                            });
                        });
                    </script>

                    @foreach($payments as $payment)
                        <!-- Modal for editing payment -->
                        <div class="modal fade" id="editPaymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="editPaymentModalLabel{{ $payment->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPaymentModalLabel{{ $payment->id }}">Edit Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Error message -->
                                        <div class="alert alert-danger mb-3" id="amountError{{ $payment->id }}" style="display: none;">
                                            Overpriced Amount! Please check the remaining balance.
                                        </div>

                                        <!-- Your payment edit form goes here -->
                                        <form action="{{ route('dashboard.transactions.update', ['id' => $payment->id]) }}" method="post" onsubmit="return validateAmount{{ $payment->id }}()">
                                            @csrf
                                            @method('PUT')

                                            <!-- Add your form fields for editing payment data -->
                                            <div class="mb-3">
                                                <label for="amount">Add amount:</label>
                                                <input type="number" class="form-control" id="amount{{ $payment->id }}" name="amount" value="{{ $payment->amount }}" step="0.01" min="0" placeholder="Enter amount..." oninput="checkAndDisplayError{{ $payment->id }}(this)">
                                            </div>
                                            <!-- Add other fields as needed -->

                                            <button type="submit" class="btn btn-primary">Update Payment</button>
                                        </form>

                                        <script>
                                            // Function to validate amount on form submission
                                            function validateAmount{{ $payment->id }}() {
                                                // You can perform additional validation here if needed
                                                return true;
                                            }

                                            // Function to check and display the error message on input change
                                            function checkAndDisplayError{{ $payment->id }}(inputElement) {
                                                var amountToAdd = parseFloat(inputElement.value);
                                                var remainingBalance = parseFloat("{{ $payment->remaining_total }}");

                                                // Display the error message if the added amount is greater than the remaining balance
                                                if (amountToAdd > remainingBalance) {
                                                    document.getElementById('amountError{{ $payment->id }}').style.display = 'block';
                                                } else {
                                                    document.getElementById('amountError{{ $payment->id }}').style.display = 'none';
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
        </main>

    </div>

</nav>

@endif

<!-- Add this script at the end of your Blade layout file -->
@if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
   
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current full URL
        var currentUrl = window.location.href;

        // Select all nav-links
        var navLinks = document.querySelectorAll('.nav-link');

        // Iterate over each nav-link
        navLinks.forEach(function(link) {
            // Get the href attribute of the link
            var href = link.getAttribute('href');

            // Check if the current URL contains the href
            if (currentUrl.includes(href)) {
                // Add the 'active' class to highlight the link
                link.classList.add('active');

              
              
            }


        });
        
    });

    

    $(document).ready(function() {
    $('#searchInput').on('input', function() {
        const searchText = $(this).val().toLowerCase();

        $('.personnel-row').each(function() {
            const name = $(this).find('td:eq(0)').text().toLowerCase();
            const email = $(this).find('td:eq(1)').text().toLowerCase();
            const role = $(this).find('td:eq(2)').text().toLowerCase();
            const status = $(this).find('td:eq(3)').text().toLowerCase();

            const isMatch = name.includes(searchText) || email.includes(searchText) || role.includes(searchText) || status.includes(searchText);
            $(this).toggle(isMatch);
        });
    });

    $('#createButton').on('click', function() {
        $('#createModal').modal('show');
    });

});




</script>


~


@endsection
 