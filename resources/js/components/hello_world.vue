<template>
    <div id="app">
        {{ msg }}
    </div>
</template>

<script>
    new Vue({
        el: "#app",
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                msg: "Hello world",
            }
        }
    })
</script>
