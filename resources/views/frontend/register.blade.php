@extends('layouts.frontend.app')
@section('title', $title)
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-md-3"></div>
            <div class="col-lg-6 mb-5 shadow py-3">
                <div class="contact-form">
                    <center class="my-3">
                        <h3>Sign Up</h3>
                    </center>

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <span>{{ Session('success') }}</span>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            <span>{{ Session('error') }}</span>
                        </div>
                    @endif

                    {{ __('auth.failed') }}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="post">
                        @csrf

                        <div class="control-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                required="required" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email"
                                required="required" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="tel" name="phone_number" class="form-control" placeholder="Phone"
                                required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <center><button class="btn btn-primary py-2 px-4" type="submit"
                                    id="sendMessageButton">Register</button></center>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 mb-5">

            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
