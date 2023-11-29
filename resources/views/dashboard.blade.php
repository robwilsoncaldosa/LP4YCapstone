@extends('layouts.layout') @section('title', 'Dashboard') @section('content')
<style>
    .nav-link,
    p {
        color: #888b92;
        font-size: 16px;
    }

    i {
        margin-right: 20px;
        font-size: 20px;
    }

    ul .nav-item:hover {
        color: black;
        background-color: #f6f7f6;
        border-radius: 25px;
        border-top-right-radius: 0px;
        border-end-end-radius: 0px;
    }

    .content {
        background-color: #f6f7f6;
        min-height: 100vh;
        height: 100vh;
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
</style>




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
                    <a class="nav-link " href="#"><i class="fas fa-home"></i>HOME</a>
                </li>
                <li class="nav-item w-100 p-2">
                    <a class="nav-link" href="#"><i class="far fa-calendar-check"></i> RESERVATION</a>
                </li>

                <li class="nav-item w-100 p-2">
                    <a class="nav-link" href="#"><i class="fas fa-clock"></i> CHECK-IN/ CHECK-OUT</a>
                </li>

                <li class="nav-item w-100 p-2">
                    <a class="nav-link" href="#"><i class="fas fa-door-closed"></i> ROOM STATUS</a>
                </li>


            </ul>
        </div>

        @if ($user->role === 'admin')
            <div class="container mt-4 ps-4 pe-0">
                <h5 class="text-uppercase fw-bold" style="color: #776061;font-size: 18px;">Maintenance</h5>

                <ul class="navbar-nav flex-grow-1 justify-content-start align-items-start">
                    <li class="nav-item w-100 p-2">
                        <a class="nav-link " href="#"><i class="fas fa-door-open"></i>ROOM</a>
                    </li>
                    <li class="nav-item w-100 p-2">
                        <a class="nav-link" href="#"><i class="fas fa-users"></i>USERS</a>
                    </li>

                    <li class="nav-item w-100 p-2">
                        <a class="nav-link" href="#"><i class="fas fa-id-badge"></i> PERSONNEL</a>
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

        </main>

    </div>

</nav>




@endsection
