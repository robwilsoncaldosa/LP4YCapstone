@extends('layouts.layout') @section('title', 'Dashboard') @section('content')

<style>
    body {
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

    ul .nav-item:hover>.nav-link.active,
    ul .nav-item:hover {
        color: black;
        background-color: #f6f7f6 !important;
        border-radius: 25px;
        border-top-right-radius: 0px;
        border-end-end-radius: 0px;
    }

    ul .nav-item .nav-link.active,
    {
        color: black;
        background-color: #f6f7f6;
        border-radius: 25px;
        border-top-right-radius: 0px;
        border-end-end-radius: 0px;
    }

    ul .nav-item:has(.nav-link.active) {
        color: black;
        background-color: #f6f7f6 !important;
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
        /* Black border */
        border-radius: 0;
        /* No border radius */
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
            /* Add this to enable vertical scrolling for the navigation */
            max-height: 80vh;
            /* Adjust this based on your needs */
        }
        .content {
            order: 1;
            overflow-y: auto;
            /* Add this to enable vertical scrolling for the content */
            max-height: 80vh;
            /* Adjust this based on your needs */
        }
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
    /* Additional styles for customization */

    .notification .nav-link {
        position: relative;
    }

    .notification-count {
        position: absolute;
        top: 0;
        right: 0;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 5px 8px;
        font-size: 12px;
    }
    /* Notification styles */

    .notification {
        position: relative;
    }
    /* Modal styles */

    .modal {
        display: none;
        position: absolute;
        bottom: 0;
        left: 70%;
        transform: translateY(18%);
        background-color: #fff;
        /* White background */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        z-index: 1;
        width: 500px;
        /* Adjust the width as needed */
        height: 640px;
        border-radius: 12px;
    }

    .modal-content {
        color: #000;
        /* Black text */
        width: 100%;
        padding: 16px;
        border-radius: 0px!important;
        border-bottom: none;
        border-right: none;
        border-left: none;
    }

    .modal::-webkit-scrollbar {
        width: 12px;
        /* Width of the scrollbar */
    }

    .modal::-webkit-scrollbar-thumb {
        background-color: #f2f2f2;
        /* Color of the scrollbar handle */
    }

    .modal::-webkit-scrollbar-track {
        background-color: #fff;
        /* Color of the scrollbar track */
    }
    /* YouTube-inspired color palette */

    .notification-count {
        background-color: #c4302b;
        /* Red */
        color: #fff;
        /* White text */
        border-radius: 50%;
        padding: 4px 8px;
        font-size: 14px;
    }

    .modal p {
        margin: 8px 0;
    }
</style>

@if (auth()->check()) @php $user = auth()->user(); @endphp

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
                    <a class="nav-link" href="{{ route('dashboard.reservations') }}"><i
                                class="far fa-calendar-check"></i> RESERVATION</a>
                </li>

                <li class="nav-item w-100 p-2">
                    <a class="nav-link" href="{{ route('dashboard.roomStatuses') }}"><i
                                class="fas fa-door-closed"></i> ROOM STATUS</a>
                </li>

            </ul>
        </div>



        @if ($user->role === 'admin')
        <div class="container mt-4 ps-4 pe-0">
            <h5 class="text-uppercase fw-bold" style="color: #776061;font-size: 18px;">Maintenance</h5>

            <ul class="navbar-nav flex-grow-1 justify-content-start align-items-start">
                <li class="nav-item w-100 p-2">
                    <a class="nav-link " href="{{ route('dashboard.rooms') }}"><i
                                    class="fas fa-door-open"></i>ROOM</a>
                </li>
                <li class="nav-item w-100 p-2">
                    <a class="nav-link" href="{{ route('dashboard.users') }}"><i
                                    class="fas fa-users"></i>USERS</a>
                </li>

                <li class="nav-item w-100 p-2">
                    <a class="nav-link" href="{{ route('dashboard.personnel') }}"><i
                                    class="fas fa-id-badge"></i> PERSONNEL</a>
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
                        <button type="submit" class="btn d-flex justify-content-start align-items-center w-100" style="color:#888b92 ;font-size: 20px;margin-right: 15px;">
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


            <!-- Updated Notification Icon -->
            <div class="notification p-4" id="notificationContainer">
                <ul class="navbar-nav flex-row p-4">
                    <li class="nav-item p-3">
                        <a class="nav-link" href="#" onclick="showReservations()">
                            <i class="far fa-bell" style="color:black; font-size: 35px;"></i>
                            <span class="notification-count" id="notificationCount">3</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Pop-up Modal for Reservations -->
            <div id="reservationModal" class="modal">
                <h4 class="p-2 m-2" style="font-size:16px">Notifications</h4>
                <div class="modal-content">
                    <?php
        // Sort reservations by creation date in descending order
        $sortedReservations = $reservations->sortByDesc('created_at');
        ?>
                        @foreach ($sortedReservations as $reservation)
                        <div class="reservationRow d-flex justify-content-evenly align-items-center ">
                            <div class="">
                                <p>{{ $reservation->user->name }}</p>
                            </div>
                            <div>
                                <p>{{ $reservation->room->room_name }}</p>

                            </div>
                            <div>
                                <p>{{ $reservation->check_in_date }} {{ date('g:i A', strtotime($reservation->check_in_time)) }}</p>
                                <p>{{ $reservation->check_out_date }} {{ date('g:i A', strtotime($reservation->check_out_time)) }}</p>
                            </div>

                        </div>
                        @endforeach
                </div>
            </div>
            <script>
                function showReservations() {
                    var modal = document.getElementById("reservationModal");

                    // Check if the modal is currently visible
                    var isVisible = window.getComputedStyle(modal).display !== "none";

                    // Toggle the display based on the current state
                    modal.style.display = isVisible ? "none" : "block";
                }
            </script>



        </header>

        <main class="p-5 ">

            @if (request()->is('dashboard/home'))
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Total Bookings</h5>
                            <p class="card-text" style="font-size: 2em; color: yellow;">
                                <strong>{{ $totalBookings }}</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">New Bookings This Month</h5>
                            <p class="card-text" style="font-size: 2em; color: yellow;">
                                <strong>{{ $newClientsThisMonth }}</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Returning Guests</h5>
                            <p class="card-text" style="font-size: 2em; color: yellow;">
                                <strong>{{ $returningClients }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif @if (request()->is('dashboard/reservations'))
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

                            @foreach ($sortedReservations as $reservation)
                            <tr class="reservationRow">
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->user->email }}</td>
                                <td>{{ $reservation->room->room_name }}</td>
                                <td>{{ $reservation->check_in_date }}</td>
                                <td>{{ $reservation->check_in_time ? date('g:i A', strtotime($reservation->check_in_time)) : '' }}</td>
                                <td>{{ $reservation->check_out_date }}</td>
                                <td>{{ $reservation->check_out_time ? date('g:i A', strtotime($reservation->check_out_time)) : '' }}</td>
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
                            var checkInDate = $(this).find('td:eq(3)')
                                .text(); // Adjust the index based on your table structure
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
                            var userName = $(this).find('td:eq(0)').text()
                                .toLowerCase(); // Adjust the index based on your table structure
                            var userEmail = $(this).find('td:eq(1)').text().toLowerCase();
                            var roomName = $(this).find('td:eq(2)').text().toLowerCase();

                            if (userName.includes(searchText) || userEmail.includes(searchText) || roomName
                                .includes(searchText)) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    });
                });
            </script>
            @endif @if (request()->is('dashboard/rooms'))

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
                            <th>Action</th>
                            <!-- Add this column for Delete and Update buttons -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
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
                                        @csrf @method('delete')
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
                                            @csrf @method('put')

                                            <!-- Room Name -->
                                            <div class="mb-3">
                                                <label for="room_name" class="form-label">Room
                                                                Name</label>
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
                                                <label for="price_per_night" class="form-label">Price per
                                                                Night</label>
                                                <input type="text" class="form-control" id="price_per_night" name="price_per_night" value="{{ $room->price_per_night }}" required>
                                            </div>

                                            <!-- Image Upload -->
                                            <div class="mb-3">
                                                <label for="image_path" class="form-label">Room
                                                                Image</label>
                                                <img src="{{ asset($room->image_path) }}" alt="Room Image" style="width: 50px; height: 50px;">
                                                <input type="file" class="form-control" id="image_path" name="image_path">
                                            </div>

                                            <!-- Add other room fields as needed -->

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update
                                                            Room</button>
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
                $(document).ready(function() {
                    // Open modal and clear form when the modal is shown
                    $('#addRoomModal, [id^="updateRoomModal"]').on('show.bs.modal', function(event) {
                        var modalId = $(this).attr('id');
                        var roomId = modalId.replace(/\D/g, ''); // Extract room ID from modal ID
                        // Clear form fields
                        $('#' + modalId + ' form').trigger('reset');
                        // You can also populate the form fields if updating a room
                        // For example: $('#room_name').val('Existing Room Name');
                    });
                });
            </script>
            @endif @if (request()->is('dashboard/roomStatuses'))
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
                        @foreach ($roomStatuses as $roomStatus)
                        <tr>
                            <td>{{ $roomStatus->room_name }}</td>
                            <td>{{ $roomStatus->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif @if (request()->is('dashboard/users'))
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
                            @foreach ($users as $user)
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
                $(document).ready(function() {
                    // Add an input event listener to the search input
                    $('#searchInput').on('input', function() {
                        // Get the search value
                        var searchText = $(this).val().toLowerCase();

                        // Filter the table rows based on the search value
                        $('#userTable tbody tr').filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                        });
                    });
                });
            </script>
            @endif @if (request()->is('dashboard/personnel'))
            <div class="container-fluid">
                <h2 class="mt-4">Personnel Management</h2>

                <!-- Add Search Bar -->

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <form class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search personnel...">
                        </div>
                    </form>
                    <button class="btn btn-outline-dark" type="button" id="createButton" data-bs-toggle="modal" data-bs-target="#createPersonnelModal">Create</button>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <!-- Add more columns as needed -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personnels as $personnel) @if ($personnel->id !== auth()->user()->id)
                            <tr class="personnel-row">
                                <td>{{ $personnel->name }}</td>
                                <td>{{ $personnel->email }}</td>
                                <td>{{ $personnel->role }}</td>
                                <td>{{ $personnel->status }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('personnel.destroy', $personnel->id) }}" method="post">
                                            @csrf @method('delete')
                                            <button type="submit" class="btn btn-outline-dark" style="border-radius: 5px;">Delete</button>
                                        </form>
                                        <form action="{{ route('personnel.resetPassword', $personnel->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-dark" style="border-radius: 5px;">Reset</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            @endif @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Create Modal -->
            <!-- Create Modal -->
            <div class="modal fade" id="createPersonnelModal" tabindex="-1" aria-labelledby="createPersonnelModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createPersonnelModalLabel">Create Personnel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Create Personnel Form -->
                            <form action="{{ route('personnel.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </main>

    </div>

</nav>

@endif

<!-- Add this script at the end of your Blade layout file -->
@if (session('success'))
<script>
    alert('{{ session('
        success ') }}');
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

                const isMatch = name.includes(searchText) || email.includes(searchText) || role
                    .includes(searchText) || status.includes(searchText);
                $(this).toggle(isMatch);
            });
        });

        $('#createButton').on('click', function() {
            $('#createModal').modal('show');
        });

    });
</script>





@endsection
