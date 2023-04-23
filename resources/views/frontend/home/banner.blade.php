@php
    // fetch data from ad_banners table
    $banners = App\Models\AdBanner::orderBy('banner_title','DESC')->limit(3)->get();
@endphp


<section class="banners mb-25">
    <div class="container">
        <div class="row">

            @foreach ($banners as $item)

            <div class="col-lg-4 col-md-6">
                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <img src="{{ asset($item->banner_image) }}" alt="bannerImage" />
                    <div class="banner-text">
                        <h4>
                            {{ $item->banner_title }}
                        </h4>
                        <a href="{{ $item->banner_url }}" target="blank" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>

            @endforeach



        </div>
    </div>
</section>
