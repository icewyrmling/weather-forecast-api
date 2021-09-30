@extends('layouts.app')
<?php
$filename = 'gradovi.txt';
$eachlines = file($filename, FILE_IGNORE_NEW_LINES);
?>
<!-- <script>
    var count;
    var cities;

    window.onload = function(){
        document.getElementById("textarea1").value = "";
        count = 0;
        cities = [];
    }

    function add_to_list(){
        var select = document.getElementById('select1');
        var value = select.options[select.selectedIndex].value;
        console.log(value);
        if(!cities.length){
            cities[count++] = value
            textarea1.value += value;
        }
        else if (cities.length < 9){
            if(!cities.includes(value)){
                cities[count++] = value;
                textarea1.value += '\n' + value;
            }
        }
        else if(cities.length == 9){
            if(!cities.includes(value)){
                cities[count] = value;
                textarea1.value += '\n' + value;
                let button = document.getElementById("addToListButton");
                button.disabled = true;
            }
        }
    }
</script> -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">{{ __('Dashboard') }}</div>


                
                
                <!-- 
                <div class="container">
                    <div class="row gx-lg-4">
                        <div class="col-lg-10 col-xxl-6 mb">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                    <h2 class="fs-4 fw-bold">City picker:</h2> -->
                                        <div>
                                            <example-component></example-component>
                                        </div>
                                    <!-- <div class="select">
                                    <select class="form-select" id="select1" aria-label="city_picker">
                                        <?php foreach($eachlines as $lines){echo "<option value='".$lines."'>$lines</option>";}?>
                                    </select>-->
                                        <!-- <div>
                                            <button class="btn btn-primary" type="button" id="addToListButton" onclick="add_to_list()">
                                                Add
                                            </button>
                                        
                                    </div>  -->
                               <!--  </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-xxl-6 mb">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                    
                                    <h2 class="fs-4 fw-bold">Chosen cities:</h2>
                                    <div class="form-group">
                                       <textarea  id="textarea1" rows="10"></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
               <!--  <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection
