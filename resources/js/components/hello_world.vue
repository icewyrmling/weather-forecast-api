<template>
    <div id="app">
       {{ info.data.name + ": " + info.data.main.temp }}
    </div>
</template>

<script>
     export default {
        mounted() {
            console.log('Component mounted.');
            axios
                .get('https://cors-anywhere.herokuapp.com/http://api.openweathermap.org/data/2.5/weather?q=Belgrade&units=metric&appid=283ffcd4756f546f71f2e37f52c59bd9')
                .then(response => (this.info = response));
            console.log(this.info);
        },

        data() {
            return {
                info: {},
                msg: "Hello world",
            }
        }
    }
</script>
