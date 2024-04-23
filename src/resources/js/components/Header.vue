<template>
    <header class="header p-[20px] shadow-md">
        <div class="flex gap-[20px] justify-between items-center header__content">
            <div class="flex items-center gap-2 header__logo ">
                <div class="logo">
                    <h1>W <span class="text-blue-600">H</span></h1>
                </div>
                <h2 class="font-bold text-[20px]">Working hands</h2>
            </div>


            <div class="header__button">
                <button @click="gotoNewAd" class="px-[23px] py-[5px] text-white bg-blue-700 rounded-md">Разместить объявление</button>
            </div>
        </div>
    </header>
</template>
<script setup>
import {RouterLink, useRouter} from "vue-router";
const router = useRouter()
const gotoNewAd = ()=>{
    router.push({
        name:"advertisment-create"
    })
}
</script>
<style lang="scss">
.logo {
    width: fit-content;
    padding: 5px;
    aspect-ratio: 1/1;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 100%;
    border: 2px solid black;
    h1 {
        font-size: 17px;
        font-weight: 800;
        margin: 0px;
        padding: 0px;
    }
}
</style>
