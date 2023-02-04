@extends('front_end_layouts.app_layout')

@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Get Support</p>
                        <h1>Contact us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- contact form -->
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Have you any question?</h2>

                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
                            <p>
                                <input type="text" placeholder="Name" name="name" id="name" />
                                <input type="email" placeholder="Email" name="email" id="email" />
                            </p>
                            <p>
                                <input type="tel" placeholder="Phone" name="phone" id="phone" />
                                <input type="text" placeholder="Subject" name="subject" id="subject" />
                            </p>
                            <p>
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                            </p>
                            <p><input type="submit" value="Submit" /></p>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-form-wrap">
                        <div class="contact-form-box">
                            <h4><i class="fas fa-map"></i> Shop Address</h4>
                            <p>
                                {{$public_contact->address_en}}
                            </p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="far fa-clock"></i> Shop Hours</h4>
                            <p>always open</p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="fas fa-address-book"></i> Contact</h4>
                            <p>
                                Phone: {{$public_contact->phone}} <br />
                                Email: {{$public_contact->email}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact form -->

    <!-- find our location -->
    <div class="find-location blue-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p><i class="fas fa-map-marker-alt"></i> Find Our Location</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end find our location -->

    <!-- google map section -->
    <div class="embed-responsive embed-responsive-21by9">
        <iframe src="https://maps.google.com/maps?q=amman&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
            width="600" height="450" frameborder="0" style="border: 0" allowfullscreen=""
            class="embed-responsive-item"></iframe>
    </div>
    <!-- end google map section -->
@endsection
