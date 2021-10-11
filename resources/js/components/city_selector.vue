<template>
    <div id="app">
        <div class="container">
            <div class="row gx-lg-4">

                <div class="col-lg-10 col-xxl-6 mb">
                    <div class="card border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <h1 class="fs-4 fw-bold">City picker:</h1>
                            <div class="form-group">
                                <select multiple="true" class="select" v-model="selected_insert">
                                    <option :key="city.city_id" v-for="city in options" v-bind:value="city.city_id"> {{ city.city_name }} </option>
                                </select>
                                <br><br>
                                <button class="btn btn-primary" v-on:click="submit_data" :disabled="isDisabled" >
                                    Add to list
                                </button>
                            </div>
                            <div>
                                
                                <!-- <button class="btn-warning" v-on:click="show_info">Show weather info</button> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-xxl-6 mb">
                    <div class="card border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <h1 class="fs-4 fw-bold">Chosen cities:</h1>
                            <div class="form-group">
                                <select multiple='true' class='select-noscroll' v-model='selected_delete' @focus='forceRerender()' @blur='forceRerender()'>
                                    <option :key='city.city_id' v-for="city in selected_array" > {{ city.city_name }} </option>
                                </select>
                                <br><br>
                                <button class="btn btn-danger" v-on:click="delete_selected" >
                                    Delete
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- <div>
            <h1 class="fs-4 fw-bold" v-if="info.data">
                {{ info.data.location.name + ": " + info.data.forecast.forecastday[0].day.mintemp_c + " - " + info.data.forecast.forecastday[0].day.maxtemp_c}}
            </h1>
            <p v-else> </p>
        </div> -->
    </div>
</template>

<script>
    export default {

        mounted() {
            this.forceRerender(),
            axios.get('/getCities', {})
                    .then(response => (
                        this.options = response.data.cities
                        ))
                    .catch(function(error){
                        console.log(error);
                    });
        },
        props: ["appkey"],
        methods: {
            forceRerender() {
                axios.get('/testGet', {})
                    .then(response => ( this.selected_array = response.data.cities ))
                    .catch(function(error){
                        console.log(error);
                    });
                if(this.selected_array.length == 10){
                    this.isDisabled = true;
                }
                else{
                    this.isDisabled = false;
                }
            },

            /* show_info: function(){
                this.forceRerender()
                var url_b = "https://cors-anywhere.herokuapp.com/http://api.weatherapi.com/v1/forecast.json?key=" + this.api_key +"&q=";
                var url_e = "&days=1&aqi=no&alerts=no";
                axios
                    .get(url_b + this.options[this.selected_insert[0] - 1].city_name + url_e)
                    //.get('https://cors-anywhere.herokuapp.com/http://api.weatherapi.com/v1/forecast.json?key=db4c37ba00f646eea71110349210610&q=Belgrade&days=1&aqi=no&alerts=no')
                    .then(response => (this.info = response));
                
            }, */

            delete_selected: function(){
                axios.post('/testDelete', {
                        cities: this.selected_delete
                    })
                    .then(response => (console.log(response.data)))
                    .catch(error => (console.log(error)));
                
            },

            submit_data: function(){
                var value = this.selected_insert;
                if(this.selected_insert.length > 10 || this.selected_insert.length + this.selected_array.length > 10){
                    alert("You selected more than 10 cities. Please deselect some and try again. :D");
                }
                else{
                    if(this.$userId){

                        axios.post('/testInsert', {
                            cities: this.selected_insert
                        }).then(function(response){
                            console.log(response.data);
                        }).catch(function(error){
                            console.log(error);
                        });
                    }
                    
                }
                this.selected_insert = []
            }
        },

        data() {
            return{
                selected_array: [],
                info: [],
                selected_insert: [],
                selected_delete: [],
                options: [],
                isDisabled: false,
                render: 0,
                api_key: this.appkey,
            }
        },


    }
</script>


<style>
button,
select,
h1
{
    margin: 10px;
    text-align-last: center;
}

select{
    border-radius: 10px 10px;
    height: 300px;
    width: 300px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font: 18px;
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    -webkit-box-shadow: none;
	-moz-box-shadow: none; 
	box-shadow: none;
}
.select-noscroll{
    scrollbar-width: none;
}
button{
    border-radius: 7.5px;
    padding: 10px;
}
btn-primary:disabled,
button[disabled]{
  border: 1px solid #999999;
  background-color: #cccccc;
  color: #666666;
}
textarea{
    border-radius: 7.5px;
    box-shadow: 0;
}
</style>
