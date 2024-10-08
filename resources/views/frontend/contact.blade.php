<x-web-layout>


    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <h2>Contact</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Contact</li>
                    </ol>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>


    <!-- start contact-pg-section -->
    <section class="contact-pg-section section-padding">
        <div class="container">
            <div class="py-2">
                @if (Session::has('msgSend'))
                    <div class="alert alert-success">{{ Session::get('msgSend') }}</div>
                @endif
            </div>
            <div class="row">
                <div class="col col-md-3">
                    <div class="contact-info">
                        <ul>
                            <li>
                                <div class="icon"><i class="fa fa-phone"></i></div>
                                <p><span>Phone</span> +91-9953730559 </p>
                            </li>
                            <li>
                                <div class="icon"><i class="fa fa-envelope"></i></div>
                                <p><span>Email</span> arvindyadav.1072@rediffmail.com </p>
                            </li>
                            <li>
                                <div class="icon"><i class="fa fa-clock-o"></i></div>
                                <p><span>Working Hours:</span>24x7</p>
                            </li>
                            <li>
                                <div class="icon"><i class="fa fa-location-arrow"></i></div>
                                <p><span>Office</span> NH 27 Madhopur Bujurg, TamkuhiRaj, Kushinagar,Uttar Pradesh
                                    274406 </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col col-md-offset-1 col-md-8">
                    <div class="w-100" style="overflow:scroll">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2851.1399208884454!2d84.21080392643535!3d26.650545166114586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3993a1aa9d9b8483%3A0x23d25b2e45e43c4e!2sHP%20Petrolpump%20SHREE%20RADHA%20KRISHNA%20ENERGY!5e1!3m2!1sen!2sin!4v1728325178223!5m2!1sen!2sin"
                            width="750" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div> <!-- end row -->
            <div class="row">
                <div class="col col-xs-12">
                    <form class="contact-form form row contact-validation-active" action="{{ route('contact.store') }}"
                        method="POST">
                        @csrf
                        <div class="col col-sm-6">
                            <label for="f-name">First Name</label>
                            <input type="text" class="form-control" id="f-name" name="first_name"
                                value="{{ old('first_name') }}">
                            @error('first_name')
                                <div class="invalid-feedback text-danger d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col col-sm-6">
                            <label for="l-name">Last Name</label>
                            <input type="text" class="form-control" id="l-name" name="last_name"
                                value="{{ old('last_name') }}">
                            @error('last_name')
                                <div class="invalid-feedback text-danger d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col col-sm-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback text-danger d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col col-sm-6">
                            <label for="phone">Phone No</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback text-danger d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col col-sm-12">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback text-danger d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col col-sm-12 submit-btn">
                            <button class="theme-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end contact-pg-section -->

</x-web-layout>
