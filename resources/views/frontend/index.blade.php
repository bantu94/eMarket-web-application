@extends('frontend.frontend_master')


@section('frontend__content')


<!--End hero slider-->
@include('frontend.home.featured')

<!--End category slider-->


@include('frontend.home.banner')
<!--End banners-->


@include('frontend.home.new_products')
<!--Products Tabs-->



@include('frontend.home.feat_products')


<!--End Best Sales-->


<!-- TV Category -->

<!--End TV Category -->





<!-- Tshirt Category -->

@include('frontend.home.tshirtCategory')

<!--End Tshirt Category -->


<!-- Computer Category -->
@include('frontend.home.computerCategory')
<!--End Computer Category -->


@include('frontend.home.hotdeals')


<!--End 4 columns-->


<!--Vendor List -->

@include('frontend.home.vendors')



@endsection
