<template>
    <div id="app">
       <h1 class="fs-4 fw-bold comp">Chosen cities:</h1>
        <div class="form-group">
            <select multiple='true' class='select comp-select' v-model='selected_delete' @focus='forceRerender()' @blur='forceRerender()'>
                <option :key='city.city_id' v-for="city in selected_array" > {{ city.city_name }} </option>
            </select>
            <br><br>
            <button class="btn btn-danger" v-on:click="delete_selected" >
                Delete
            </button>
        </div>
    </div>
</template>

<script>
     export default {
        mounted() {
            this.forceRerender()
        },

        methods: {
            forceRerender() {
                axios.get('/testGet', {})
                    .then(response => ( this.selected_array = response.data.cities ))
                    .catch(function(error){
                        console.log(error);
                    })
            },

            delete_selected: function(){
                axios.post('/testDelete', {
                        cities: this.selected_delete
                    })
                    .then(response => (console.log(response.data)))
                    .catch(error => (console.log(error)));
            },

        },

        data() {
            return{
                selected_array: [],
                selected_delete: [],
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
}
h1.comp{
    font-family: 'Quicksand', sans-serif;
    background: rgba(230, 203, 203, 0.8);
    border-radius: 7.5px;
    display: inline-block;
    padding: 2%;
}
.comp-select{
    background: rgba(240, 248, 255, 0.7);
    border-radius: 10px 10px;
    border-width: 1px;
    border-style: solid;
    height: 300px;
    width: 300px;
    scrollbar-width: none;
}
button{
    border-radius: 7.5px;
    padding: 5%;
    font: 20px;
}
</style>