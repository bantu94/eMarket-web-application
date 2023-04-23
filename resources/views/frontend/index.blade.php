@extends('frontend.frontend_master')


@section('frontend__content')

@section('title','| Home')




@include('frontend.home.home_slider')
<!--End category slider-->


<!--End hero slider-->
@include('frontend.home.featured')



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
