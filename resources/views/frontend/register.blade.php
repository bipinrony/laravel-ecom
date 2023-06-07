@extends('layouts.frontend.app')
@section('title', $title)
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-md-3"></div>
            <div class="col-lg-6 mb-5 shadow py-3">
                <div class="contact-form">
                    <center class="my-3"><h3>Sign Up</h3></center>
                    <div id="success"></div>
                    <form action="" method="post">
                        <div class="control-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Your Email"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="tel" name="phone_number" class="form-control" id="subject" placeholder="Phone"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" name="password" class="form-control" id="subject" placeholder="Password"
                            required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                        <center><button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Register</button></center>
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