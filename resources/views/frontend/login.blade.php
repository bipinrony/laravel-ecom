@extends('layouts.frontend.app')
@section('title', $title)
@section('content')
    <div class="container-fluid pt-5 ">
        <div class="row px-xl-5">
            <div class="col-md-3"></div>
            <div class="col-lg-5 mb-5 shadow p-3">
                <div class="contact-form">
                    <center class="my-3">
                        <h3>{{ __('auth.login') }}</h3>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- {{ __('auth.failed') }} --}}

                    <form action="{{ route('login.post') }}" method="post">
                        @csrf
                        <div class="control-group">
                            <input type="email" name="email" class="form-control bg-white" placeholder="Email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <center><button class="btn btn-primary py-2 px-4" type="submit"
                                    id="sendMessageButton">Login</button></center>
                        </div>
                    </form>

                    <a href="{{ route('google_login') }}" class="btn btn-primary btn-block" style="margin-top: 10px;">
                        Google login
                    </a>

                    <a href="{{ route('facebook_login') }}" class="btn btn-primary btn-block" style="margin-top: 10px;">
                        Facebook login
                    </a>
                </div>
            </div>
            <div class="col-lg-3 mb-5">

            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
