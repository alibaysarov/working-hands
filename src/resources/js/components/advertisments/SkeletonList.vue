<template>
    <div class="mt-4 grid grid-cols-5 gap-4">
        <Skeleton height="250px" color="#e6f3fd" highlight="#eef6fd" :loading="true" v-for="item in 10">
        </Skeleton>
    </div>

</template>
<script setup>
import {Skeleton, SkeletonTheme} from "vue-loading-skeleton";
import "vue-loading-skeleton/dist/style.css"
</script>
