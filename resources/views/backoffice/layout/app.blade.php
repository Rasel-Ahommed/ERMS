@include('backoffice.layout.header')

@php
    if (Session::has('error')) {
        $error = session()->get('error');
        echo '<script>
            window.onload = function() {
                showError("'.$error.'");
            };
        </script>';
    }
@endphp


{{-- @extends('backoffice.layouts.topBar') --}}
<div class="content">
    @yield('content')
</div>


<!-- Add your JavaScript links here -->
@include('backoffice.layout.footer')

