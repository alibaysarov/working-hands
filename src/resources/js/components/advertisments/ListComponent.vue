<template>
    <Suspense>
        <template #default>
            <div>
                <div class="flex justify-between mb-[25px]">
                    <h2 class="font-bold text-[25px] ">Доска объявлений</h2>
                    <div class="sort flex gap-[10px]">
                        <div class="flex gap-[5px] items-center">
                            <p>Цена</p>
                            <select  name="" id="" v-model="sortByPrice">
                                <option value="asc">По возрастанию</option>
                                <option value="desc">По убыванию</option>
                            </select>
                        </div>
                        <div class="flex gap-[5px] items-center mr-[10px]">
                            <p>Дата публикации</p>
                            <select  name="" id="" v-model="sortByDate">
                                <option value="asc">По возрастанию</option>
                                <option value="desc">По убыванию</option>
                            </select>
                        </div>
                    </div>

                </div>
                <AdvertismentList :list="list"/>
                <Pagination :prevFunc="prevClick" :nextFunc="nextClick" :clickFunc="clickHandler" v-if="list.length" :current="pageNum" :total="total_pages"/>
            </div>
        </template>
        <template #fallback>
            <div>
                <SkeletonList/>
            </div>


        </template>
    </Suspense>

</template>
<script setup>
import {defineAsyncComponent, onMounted, ref, watch} from "vue";
import api from "../../api/index.js";
import {useRouter} from "vue-router";
import SkeletonList from "./SkeletonList.vue";
const AdvertismentList = defineAsyncComponent(()=>import ("./AdvertismentList.vue"))
const Pagination = defineAsyncComponent(()=>import ("../Pagination.vue"))
const router = useRouter();

const list = ref([])
const pageNum = ref(router.currentRoute.value.params.page??1);
const total_pages = ref(0);
const isLoading = ref(true);
const isError = ref(false);
const clickHandler = (num)=>{
    pageNum.value = num;
}
const nextClick = ()=>{
    if(pageNum.value< total_pages.value) {
        pageNum.value+=1
        router.push({name:"index",query: { page: pageNum.value }})
    }
}
const prevClick = ()=>{
    if(pageNum.value>1) {
        pageNum.value-=1
        router.push({name:"index",query:{page:pageNum.value}})

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
