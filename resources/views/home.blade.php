@extends('layouts.app')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<head>
    <meta name="user-id" content="{{ Auth::user()->id }}">
</head>

@section('content')
<div class="container" style="position: relative; top: 50%;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <div class="row gx-lg-4">
                    <div class="text-center col-lg-10 col-xxl-6 mb">
                        <city_selector></city_selector>
                    </div>

                    <div class="text-center col-lg-10 col-xxl-6 mb">
                        <city_deleter></city_deleter>
                    </div>
                </div>

                <time_selector></time_selector>
               <!--  <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} -->
            </div>
        </div>
    </div>
</div>
<footer class="py-5 bg-dark" style="position:absolute; bottom: 0; height:10%; width: 100%">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; icewyrmling 2021</p></div>
</footer>
@endsection
