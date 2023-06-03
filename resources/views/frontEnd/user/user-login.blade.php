@extends('frontEnd.master')
@section('title')
    Register
@endsection
@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">

            <div class="col-lg-12 text-center mb-5">
                <h3 class="page-title">Login</h3>
            </div>
        </div>

        <div class="form mt-2 col-md-8 m-auto">
            <form action="{{ route('user.login') }}" method="post" class="php-email-form">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User name" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                </div>
                <div class="my-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit" >login</button></div>
            </form>
        </div><!-- End Contact Form -->

        </div>
    </section>
@endsection

