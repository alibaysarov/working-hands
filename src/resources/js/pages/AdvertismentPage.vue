<template>
    <suspense>
        <template #default>
            <div class="p-4">
                <Container>
                    <router-link to="/" class="text-gray-500 mb-[10px]">Назад</router-link>
                    <h2 class="text-[35px] font-bold">{{ pageData.name }}</h2>
                    <h4 class="text-[25px]">Цена: {{pageData.price}}</h4>
                    <img :src="pageData.main_cover" class="mt-[10px]" width="550" alt="">
                    <button @click="toggleFields" class="mt-[15px] bg-blue-600 rounded-md py-[5px] px-[22px] text-white">
                        {{ showFields ? 'Скрыть поля':'Показать поля' }}</button>
                    <div v-if="showFields" class="misc-fields max-w-[600px] mt-[20px]">
                        <h4 class="text-[15px] font-bold mb-[15px]">Описание</h4>
                        <p>
                            {{pageData.description}}
                        </p>
                        <div class="links">
                            <h4 class="text-[15px] font-bold">Ссылки</h4>
                            <a :href="item" class="block text-blue-700 mb-[5px]" v-for="item in pageData.links">{{item?item.slice(0,100)+'...':''}}</a>
                        </div>
                    </div>
                </Container>
            </div>
        </template>
        <template #fallback>
            loading
        </template>
    </suspense>

</template>
<script setup>
import Container from "../components/layout/Container.vue";
import {onMounted, ref, watch} from "vue";
import {useRouter} from "vue-router";
import api from "../api/index.js";

const pageData = ref({
    name:"",
    main_cover:"",
    price:"",
    description:"",
    links:[]
})
const router = useRouter()
const showFields = ref(false)
const getPageData = (data)=>{
    api.getOne(data).then(r=>{
        pageData.value = r.data
    })
}
const toggleFields = ()=>{
    showFields.value =!showFields.value
}
onMounted(()=>{
    const id = router.currentRoute.value.params.id
    getPageData({id})
})
watch(()=>showFields.value,newVal=>{
    if(newVal==true) {
        getPageData({
            id:router.currentRoute.value.params.id,
            fields:true
        })
    }
})
</script>
