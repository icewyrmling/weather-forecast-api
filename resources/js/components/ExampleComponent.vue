<template>
    <div id="app">
        <div class="container">
            <div class="row gx-lg-4">
                
                <div class="col-lg-10 col-xxl-6 mb">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <h2 class="fs-4 fw-bold">City picker:</h2>
                            
                            <select v-model="selected" >
                                <option :key='city' v-for="city in options" > {{ city }} </option>
                            </select>
                            
                            <div>Selected: {{ selected }}</div>
                            
                            <button v-on:click="add_to_list">
                                Add to list
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-xxl-6 mb">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <h2 class="fs-4 fw-bold">Chosen cities:</h2>
                            <div class="form-group">
                                <textarea  v-model="message" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
       
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            add_to_list: function(){
                var value = this.selected;
                if(this.selected_array.length < 10 && this.selected != null && !this.selected_array.includes(this.selected)){
                    this.message += "\n" + value;
                    this.selected_array.push(value);
                    console.log(this.selected_array);
                    console.log(value);
                }
            },

            /* on_change: function(event){
                return console.log(event.target.value);
            } */
        },

        data() {
            return{
                selected: null,
                options: ['Tirana', 'Andorra la Vella', "Vienna", "Minsk", "Brussels", "Sarajevo", "Sofia", "Zagreb", "Prague", "Copenhagen", "Tallinn",
                "Helsinki", "Paris", "Berlin", "Athens", "Budapest", "Reykjavik", "Dublin", "Rome", "Riga", "Vaduz", "Vilnius", "Luxembourg", "Valletta",
                "Chisinau", "Monaco", "Podgorica", "Amsterdam Haag", "Skopje", "Oslo", "Warsaw", "Lisbon", "Bucharest", "Moscow", "San Marino", "Belgrade",
                "Bratislava", "Ljubljana", "Madrid", "Stockholm", "Bern", "Kiev", "London"] ,
                message: '',
                selected_array: []
            }
        },

        
    }
</script>
