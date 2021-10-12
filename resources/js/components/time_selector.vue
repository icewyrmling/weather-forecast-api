<template>
    <div id="app">
       <select name="timeSelect" v-model="selected">
           <option :key='n' v-for="n in 24" > {{ n - 1 + ":00" }}</option>
       </select>
       <button class="btn btn-primary" @click="selectTime">Select time</button> 
    </div>
</template>

<script>
     export default {
        mounted() {
            console.log('mounted time selector')
        },

        methods: {
            selectTime: function(){
                axios.post('/setTime', {
                    time: this.selected
                })
                    .then(response => ( console.log(response)))
                    .catch(function(error){
                        console.log(error);
                    })
            }
        },

        data() {
            return{
                info: '',
                selected: '',
            }
        },

    }
</script>
