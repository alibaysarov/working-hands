<template>
    <Suspense>
        <template #default>
            <div>
                <div class="flex justify-between mb-[25px]">
                    <h2 class="font-bold text-[25px] ">Доска объявлений</h2>
                    <div class="sort">
                        <p>Цена</p>
                        <select @change="changeFunc" name="" id="" v-model="sortByPrice">
                            <option value="asc">По возрастанию</option>
                            <option value="desc">По убыванию</option>
                        </select>
                    </div>
                </div>
                <AdvertismentList :list="list"/>
                <Pagination :prevFunc="prevClick" :nextFunc="nextClick" :clickFunc="clickHandler" v-if="list.length" :current="pageNum" :total="total_pages"/>
            </div>
        </template>
        <template #fallback>
            <div>
                <div>Loading list...</div>
                <div>Loading pages...</div>
            </div>


        </template>
    </Suspense>

</template>
<script setup>
import {defineAsyncComponent, onMounted, ref, watch} from "vue";
import api from "../../api/index.js";
import {useRouter} from "vue-router";
const AdvertismentList = defineAsyncComponent(()=>import ("./AdvertismentList.vue"))
const Pagination = defineAsyncComponent(()=>import ("../Pagination.vue"))
const list = ref([])
const pageNum = ref(1);
const total_pages = ref(0);
const isLoading = ref(true);
const isError = ref(false);
const router = useRouter();
const clickHandler = (num)=>{
    pageNum.value = num;
}
const nextClick = ()=>{
    if(pageNum.value< total_pages.value) {
        pageNum.value+=1
    }
}
const prevClick = ()=>{
    if(pageNum.value>1) {
        pageNum.value-=1
    }
}
const sortByDate = ref("")
const sortByPrice = ref("")

const getAdvertisments = ()=>{
    const data ={
        page:pageNum.value,
        sort_date:sortByDate.value??false,
        sort_price:sortByPrice.value??false,
    }
    api.getAll(data).then(r=>{
        list.value = r.data;
        total_pages.value = r.last_page
        isLoading.value = false
    })
}
const changeFunc = ()=>{
    console.log(sortByPrice.value)
}
onMounted(()=>{
    getAdvertisments()
})
watch(()=>pageNum.value,newVal=>{
        getAdvertisments()
})
watch(()=>sortByPrice.value,newVal=>{
    getAdvertisments()
})
watch(()=>sortByDate.value,newVal=>{
    getAdvertisments()
})
</script>
