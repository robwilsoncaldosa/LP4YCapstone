@extends('layouts.layout') @section('title', 'Login') @section('content')
<style>
    label {
        font-size: 13px;
        padding: 0;
        color: #546b81;
    }

    input {
        border-bottom: 1px solid rgb(212, 218, 223);
    }

    .container-xl {
        width: 525px;
        box-shadow: 2px 2px 6px 0 rgba(41, 70, 97, .1);
        padding: 0;
        height: 665px;
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

    a {
        color: #489be8;
        text-decoration: none;
    }

    .btn {
        padding: 11px 30px;
        color: #fff;
        background-color: #1188e6;
        border-color: #1288e5;
    }

    body {
        overflow: hidden;
        font-family: Colfax, Helvetica, Arial, sans-serif;
        font-style: normal;
        font-weight: 400;
        color: #546b81;
    }

    span {
        font-size: 13px;
        font-weight: normal;
    }
</style>


<div class="d-flex mt-5" style="height: 100vh;">
    <div class="container-xl  position-relative ">
        <div class="row w-75 m-auto">
            <div class="col-lg-12 mt-5">
                <div class="text-center justify-content-center align-items-center">
                    <img src="../img/HostLogo.png" width="150px" class="mx-auto d-block mt-4" alt="Logo">

                </div>
            </div>

            <div class="col-lg-12 mt-5">

                <form id="login-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-floating bg-transparent  mb-5 mt-3 w-100 m-auto">
                        <input required type="email"
                            class="form-control border-top-0 border-start-0 border-end-0 rounded-0 focus-ring-light " id="email"
                            name="email" placeholder="" value="{{ old('email') }}">
                        <label for="username">Email</label>
                    </div>

                    @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif


                    <div class="form-floating mb-2 mt-3 w-100 m-auto ">
                        <input required type="password"
                            class="form-control border-top-0 border-start-0 border-end-0  rounded-0 " id="password"
                            name="password" placeholder="">
                        <label for="password">Password</label>
                    </div>
                    @if ($errors->has('password'))
                    <div class="alert alert-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                    <div class="text-end ">
                        <a href="#">Forgot your password?</a>
                    </div>
                    <div class="d-flex  justify-content-center ">
                        <button type="submit" class="sign-in btn btn-primary mt-5 rounded-0 text-center">Sign
                            in</button>

                    </div>
                </form>

            </div>
        </div>
        <div class="container position-absolute  bottom-0 text-center p-4 " style="background: hsla(0,0%,62%,.1);">
            <span> Don't have a LP4Y Guesthouse Account?</span>
            <a href="#"> Sign Up Now!</a>
        </div>
    </div>

</div>

@endsection

