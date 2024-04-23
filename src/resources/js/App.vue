<template>
<Header/>
    <RouterView />
</template>

<script setup>
import {onMounted} from "vue";
import api from "./api/index.js";
import Header from "./components/Header.vue";
import {RouterView} from "vue-router";
onMounted(()=>{
api.getAll().then(r=>{
    console.log(r.data)
})
})
</script>
<style lang="scss">

</style>
