<template>
    <div @click="goToPage" class="flex cursor-pointer flex-col gap-1 justify-between :hover:translate-y-1">
        <div class="data">
            <img :src="image" :alt="name">
            <h4 class="text-[18px] font-bold">{{name}}</h4>
            <p class="mt-[10px]">Цена: {{price}}</p>
        </div>
        <a class="text-blue-700" :href="'advertisment/'+id">Подробнее</a>
    </div>
</template>

<script setup>
import {useRouter} from "vue-router";

const props = defineProps({
    id:{
        default:0
    },
    name:{
        default:""
    },
    price:{
        default:""
    },
    image:{
        default:""
    }
})
const router = useRouter()
const goToPage = ()=>{
    router.push({
        name:"advertisment",
        params:{id:props.id}
    })
}
</script>
