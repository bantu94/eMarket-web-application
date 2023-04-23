@include('frontend.partials.css')

@include('frontend.partials.header')

@section('title', '| Become a vendor')


<main class="main pages">

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Vendor account</h1>
                                        <p class="mb-30">Already have an account? <a href="{{ route('vendor_login') }}">Login</a></p>
                                    </div>
                                    <form method="POST" action="{{ route('vendor_register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" required="" id="name" name="name" placeholder="Shop name" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required="" id="username" name="username" placeholder="Username" />
                                        </div>
                                        <div class="form-group">
                                            <input type="number" required="" id="phone" name="phone" placeholder="Phone number" />
                                        </div>
                                        <div class="form-group">
                                            <select name="vendor_join" class="form-select mb-3" aria-label="Default select example">
                                                <option selected="">Since</option>
                                                <option value="2023" >2023</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" required="" id="email" name="email" placeholder="Email" />
                                        </div>
                                        <div class="form-group">
                                            <input required="" id="password" type="password" name="password" placeholder="Password" />
                                        </div>
                                        <div class="form-group">
                                            <input required="" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm password" />
                                        </div>

                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                </div>
                                            </div>
                                            <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                        </div>
                                        <div class="form-group mb-30">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Submit &amp; Register</button>
                                        </div>
                                        <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <div class="card-login mt-115">
                                <a href="#" class="social-login facebook-login">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/logo-facebook.svg') }}" alt="" />
                                    <span>Continue with Facebook</span>
                                </a>
                                <a href="#" class="social-login google-login">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/logo-google.svg') }}" alt="" />
                                    <span>Continue with Google</span>
                                </a>
                                <a href="#" class="social-login apple-login">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/logo-apple.svg') }}" alt="" />
                                    <span>Continue with Apple</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('frontend.partials.footer')



@include('frontend.partials.javascript')