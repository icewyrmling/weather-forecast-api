<template>
    <div id="app">
        <div class="container bg-light">
            <div class="row gx-lg-4">
                
                <div class="col-lg-10 col-xxl-6 mb">
                    <div class="card border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <h1 class="fs-4 fw-bold">City picker:</h1>
                            
                            <select class="select" v-model="selected" >
                                <option :key='city' v-for="city in options" > {{ city }} </option>
                            </select>
                            
                            <!-- <div>Selected: {{ selected }}</div> -->
                            <div>
                                <button class="btn-primary" v-on:click="add_to_list" :disabled="isDisabled" >
                                    Add to list
                                </button>
                                <button class="btn-warning" v-on:click="show_info">Show weather info</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-xxl-6 mb">
                    <div class="card border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <h1 class="fs-4 fw-bold">Chosen cities:</h1>
                            <div class="form-group">
                                <!-- <div>{{ message }} </div> -->
                                <textarea  class="textarea" v-model="message" rows="10" readonly style="resize: none;"></textarea>
                            </div>
                            <br>
                            <button class="btn-primary" v-on:click="submit_data" :disabled="isDisabledSubmit">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div>
            <h1 class="fs-4 fw-bold" v-if="info.data">{{ info.data.name + ": " + info.data.main.temp }}</h1>
            <p v-else> loading.....</p>
        </div>
    </div>
</template>

<script>
    export default {
       
        mounted() {
            console.log('Component mounted.');
            if(this.$userId){
                console.log(this.$userId);
                this.user = this.$userId
            }
        },
        methods: {
            add_to_list: function(){
                var value = this.selected;
                if(this.selected_array.length < 10 && this.selected != null && !this.selected_array.includes(this.selected)){
                    if(this.selected_array.length == 0)
                        this.message = value;
                    else
                        this.message += " \n " + value;
                    this.selected_array.push(value);
                    console.log(value);
                }
                if(this.selected_array.length == 10){
                    this.isDisabled = true;
                    this.isDisabledSubmit = false
                };
                
            },
            show_info: function(){
                var url_b = "https://cors-anywhere.herokuapp.com/http://api.openweathermap.org/data/2.5/weather?q=";
                var url_e = "&units=metric&appid=283ffcd4756f546f71f2e37f52c59bd9";
                axios
                    .get(url_b + this.selected + url_e)
                    .then(response => (this.info = response));
                console.log(this.info)
            },


            submit_data: function(){
                /* axios.get('api/user').then(response => {
                    this.user_id = response;
                    console.log(response.body);
                }) */
                if(this.$userId){
                    axios.post('write_to_db.php', {
                        id: this.user,
                        cities: this.selected_array
                    }).then(function(response){
                        //alert(response.data);
                    }).catch(function(error){
                        console.log(error);
                    });
                    isDisabledSubmit = true;
                    }
                }
            },

        data() {
            return{
                info: {},
                selected: null,
                options: ['Tirana', 'Andorra la Vella', "Vienna", "Minsk", "Brussels", "Sarajevo", "Sofia", "Zagreb", "Prague", "Copenhagen", "Tallinn",
                "Helsinki", "Paris", "Berlin", "Athens", "Budapest", "Reykjavik", "Dublin", "Rome", "Riga", "Vaduz", "Vilnius", "Luxembourg", "Valletta",
                "Chisinau", "Monaco", "Podgorica", "Amsterdam Haag", "Skopje", "Oslo", "Warsaw", "Lisbon", "Bucharest", "Moscow", "San Marino", "Belgrade",
                "Bratislava", "Ljubljana", "Madrid", "Stockholm", "Bern", "Kiev", "London"] ,
                message: '',
                selected_array: [],
                isDisabled: false,
                isDisabledSubmit: true,
                user: null
            }
        },

        
    }
</script>


<style>
button,
select
{
    margin: 10px;
}
button{
    border-radius: 7.5px;
    padding: 10px;
}
textarea{
    border-radius: 7.5px;
    box-shadow: 0;
}
</style>