<template>
    <div class="p-4">
        <Alert :shown="alertShown" :status="alertStatus" :text="alertText"/>
        <Container>
            <div class="flex justify-center items-center w-full">
                <div class="shadow-md p-3 rounded-md flex flex-col gap-[7px]">
                    <h2 class="text-[35px] font-bold">Создать объявление</h2>
                    <div class="des">
                        <h3 class="text-[25px]">Название</h3>
                        <input v-model="createAdvertisment.name" class="border w-full" type="text">
                    </div>
                    <div class="des">
                        <h3 class="text-[25px]">Обложка(ссылка)</h3>
                        <input v-model="createAdvertisment.main_cover" class="border w-full" type="text">
                    </div>
                    <div class="des">
                        <h3 class="text-[25px]">Описание</h3>
                        <textarea v-model="createAdvertisment.description" class="border w-full h-[100px]"></textarea>
                    </div>
                    <div class="des">
                        <h3 class="text-[25px]">Цена</h3>
                        <input class="border w-full" v-model="createAdvertisment.price" type="number">
                    </div>
                    <div class="des">
                        <h3 class="text-[25px]">Доп. ссылки</h3>
                        <div class="flex flex-col gap-[5px]">
                            <input v-model="createAdvertisment.linkOne" class="border w-full" type="text">
                            <input v-model="createAdvertisment.linkTwo" class="border w-full" type="text">
                            <input v-model="createAdvertisment.linkThree" class="border w-full" type="text">
                        </div>
                    </div>
                    <button @click="sendForm" class="px-[23px] py-[5px] text-white bg-blue-700 rounded-md">Разместить</button>
                </div>
            </div>
        </Container>
    </div>
</template>
<script setup>

import Container from "../components/layout/Container.vue";
import {ref} from "vue";
import api from "../api/index.js";
import Alert from "../components/Alert.vue";
import {useRouter} from "vue-router";

const createAdvertisment = ref({
    name: "",
    main_cover: "",
    description: "",
    price: "",
    linkOne: "",
    linkTwo: "",
    linkThree: "",
})
const router  =useRouter()
const alertShown = ref(false)
const alertText = ref('')
const alertStatus = ref('')
const showAlert = (data)=>{
    alertText.value =data.text
    alertStatus.value =data.status
    alertShown.value = true
    setTimeout(()=>{
        alertShown.value = false
    },1500)
}
const sendForm = () => {
    createAdvertisment.value.links =[
        createAdvertisment.value.linkOne,
        createAdvertisment.value.linkTwo,
        createAdvertisment.value.linkThree,
    ]
    const dataToSend = {
        name: createAdvertisment.value.name,
        main_cover: createAdvertisment.value.main_cover,
        description: createAdvertisment.value.description,
        price: createAdvertisment.value.price,
        links:[
            createAdvertisment.value.linkOne,
            createAdvertisment.value.linkTwo,
            createAdvertisment.value.linkThree
        ]
    }
    api.create(dataToSend)
        .then(r=>{
            showAlert({
                status:"success",
                text:"Обьявление размещено"
            })
            router.push({
                path:'/'
            })
        })
        .catch(err=>{

            showAlert({
                status:"error",
                text:"Вы не заполнили необходимые поля"
            })
        })
}
</script>
