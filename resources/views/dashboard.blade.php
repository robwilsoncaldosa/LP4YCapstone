

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
            overflow-y: auto; /* Add this to enable vertical scrolling for the navigation */
            max-height: 80vh; /* Adjust this based on your needs */
        }

        .content {
            order: 1;
            overflow-y: auto; /* Add this to enable vertical scrolling for the content */
            max-height: 80vh; /* Adjust this based on your needs */
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
                <h5 class="card-title">Total Bookings</h5>
                <p class="card-text" style="font-size: 2em; color: yellow;"><strong>{{ $totalBookings }}</strong></p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h5 class="card-title">New Bookings This Month</h5>
                <p class="card-text" style="font-size: 2em; color: yellow;"><strong>{{ $newClientsThisMonth }}</strong></p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <h5 class="card-title">Returning Clients</h5>
                <p class="card-text" style="font-size: 2em; color: yellow;"><strong>{{ $returningClients }}</strong></p>
            </div>
        </div>
    </div>
</div>

@endif


            @if(request()->is('dashboard/reservations'))
                <!-- Add the 'active' class to highlight the RESERVATION link -->
                <h2>Reservations</h2>
                <div class="table-responsive">
                <table class="table">
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
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->user->email }}</td>
                                <td>{{ $reservation->room->room_name }}</td>
                                <td>{{ $reservation->check_in_date }}</td>
                                <td>{{ $reservation->check_in_time }}</td>
                                <td>{{ $reservation->check_out_date }}</td>
                                <td>{{ $reservation->check_out_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            @endif

            @if(request()->is('dashboard/rooms'))
                <!-- Add the 'active' class to highlight the ALL ROOMS link -->
                <h2>All Rooms</h2>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
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
                <div class="table-responsive">
                <table class="table">
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
                @endif


                @if(request()->is('dashboard/personnel'))
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
                                    @foreach($personnels as $personnel)
                                        @if($personnel->id !== auth()->user()->id)
                                            <tr class="personnel-row">
                                                <td>{{ $personnel->name }}</td>
                                                <td>{{ $personnel->email }}</td>
                                                <td>{{ $personnel->role }}</td>
                                                <td>{{ $personnel->status }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <form action="{{ route('personnel.destroy', $personnel->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-outline-dark" style="border-radius: 5px;">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


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
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <input type="text" class="form-control" id="role" name="role" required>
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add User</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
                    <script>
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
                @endif





        </main>

    </div>

</nav>

@endif
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


   
</script>





@endsection
 