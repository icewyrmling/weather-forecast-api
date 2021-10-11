@extends('layouts.app')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<head>
    <meta name="user-id" content="{{ Auth::user()->id }}">
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <?php
                    /*
                    * * @todo prebaci u kontroler
                    */
                        $key = env("VUE_APP_WEATHER_API_KEY");
                    ?>

                    <div>
                        <city_selector appkey="{{ $key }}"></city_selector>
                    </div>


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
@endsection
