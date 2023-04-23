@include('frontend.partials.css')

{{-- @section('pagetitle', isset($pagetitle) ?  $pagetitle : 'Profile') --}}

@include('frontend.partials.header')

<main class="main pages">
    @yield('user')
</main>

@include('frontend.partials.footer')



@include('frontend.partials.javascript')

