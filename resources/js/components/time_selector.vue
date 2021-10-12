<template>
    <div id="app" style="text-align:center; vertical-align: middle;">
       <select name="timeSelect" v-model="selected" style="background: rgba(230, 235, 250, 0.7); border-radius:5px; border-width:0.5px;">
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
