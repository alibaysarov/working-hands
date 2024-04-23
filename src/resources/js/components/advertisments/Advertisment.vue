<template>
    <div class="flex flex-col gap-1 justify-between">
        <div class="data">
            <img :src="image" :alt="name">
            <h4 class="text-[18px] font-bold">{{name}}</h4>
        </div>
        <a class="text-blue-700" :href="'advertisment/'+id">Подробнее</a>
    </div>
</template>

<script setup>
const props = defineProps({
    id:{
        default:0
    },
    name:{
        default:""
    },
    image:{
        default:""
    }
})
</script>
