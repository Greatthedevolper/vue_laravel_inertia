<script setup>
import {ref} from "vue";
import FlashMessage from "../components/FlashMessage.vue";
const flashShow = ref(true);
const handleCloseMessage = () => { 
    flashShow.value = false;
};
</script>
<template>
    <div>
        <main>
            <FlashMessage @closeMessage="handleCloseMessage" v-if="$page?.props?.flash?.message && flashShow"
                :title="$page?.props?.flash?.message"
                :flashClass="$page?.props?.flash?.type"
            />
            <slot />
        </main>
    </div>
</template>
