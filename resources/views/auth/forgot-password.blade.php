@include('frontend.partials.css')

@include('frontend.partials.header')

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
                <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                    <div class="row">
                        <div class="heading_s1">
                            <img class="border-radius-15" src="{{ asset('frontend/assets/imgs/page/reset_password.svg') }}" alt="" />
                            <h2 class="mb-15 mt-15">Email Password Reset Link</h2>
                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                        </div>
                        <div class="col-lg-12 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" id="email" required="" name="email" placeholder="Email *" />
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Reset Link</button>
                                        </div>
                                    </form>
                                </div>
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
