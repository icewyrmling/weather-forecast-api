<template>
    <div id="app">
        <h1 class="fs-4 fw-bold comp">Select cities:</h1>
        <div class="form-group">
            <select multiple="true" class="select comp-select" v-model="selected_insert">
                <option :key="city.city_id" v-for="city in options" v-bind:value="city.city_id"> {{ city.city_name }} </option>
            </select>
            <br><br>
            <button class="btn btn-success" v-on:click="submit_data" style="display: inline-block; padding: 2%;">
                Add to list
            </button>
        </div>
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

        methods: {
            forceRerender() {
                /* axios.get('/testGet', {})
                    .then(response => ( this.selected_array = response.data.cities ))
                    .catch(function(error){
                        console.log(error);
                    }); */
            },

            submit_data: function(){
                var value = this.selected_insert;
                if(this.selected_insert.length > 10 || this.selected_insert.length + this.selected_array.length >= 10){
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
                options: [],
                render: 0,
            }
        },
    }
</script>


<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Quicksand:wght@500&display=swap');
button,
h1
{
    margin: 10px;
    text-align-last: center;
    font-family: 'Quicksand', sans-serif;
}

button{
    border-radius: 7.5px;
    padding: 10px;
}

</style>
