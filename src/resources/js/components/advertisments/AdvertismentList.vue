<template>
    <div class="mt-4 grid grid-cols-5 gap-4 advertisment-list">
        <div v-for="item in list" class="shadow-md p-4 rounded-sm min-h-[250px]">
            <Advertisment :id="item.id" :price="item.price" :name="item.name" :image="item.main_cover"/>
        </div>
    </div>

</template>
<script setup>
import {onMounted, ref} from "vue";
import api from "../../api/index.js";
import Pagination from "../Pagination.vue";
import Advertisment from "./Advertisment.vue";
const props = defineProps({
    list:{
        type:Array,
        default:[]
    }
})
</script>
