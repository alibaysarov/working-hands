<template>
    <div class="alert-component py-1 px-2 rounded-md text-white transition ease delay-300"
         :class="{'opacity-0':shown==false,'bg-green-400':status==='success','bg-red-400':status==='error'}" >
        {{text}}
    </div>
</template>

<script setup>
const props = defineProps({
    shown: {
        default:false
    },
    text:"",
    status:""
})
</script>
<style lang="scss">
.alert-component {
    position: fixed;
    z-index: 9999;
    top: 20px;
    right: 0px;
    transform: translateX(-25%);
}
</style>
