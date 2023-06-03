@extends('frontEnd.master')
@section('title')
    Register
@endsection
@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">

            <div class="col-lg-12 text-center mb-5">
                <h3 class="page-title">Registration</h3>
            </div>
        </div>

            <div class="form mt-2 col-md-8 m-auto">
                <form action="{{ route('user.registration') }}" method="post" class="php-email-form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="phone" id="phone_number" placeholder="Your Phone Number" required>
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
                    <div class="text-center"><button type="submit" >Send Message</button></div>
                </form>
            </div><!-- End Contact Form -->

        </div>
    </section>
@endsection

