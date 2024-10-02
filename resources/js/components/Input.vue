<script setup>
const model = defineModel({
    type: null,
    required: true,
});
defineProps({
    name: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    inputId: {
        type: String,
    },
    message: String,
});
</script>
<template>
    <div class="input-wrapper">
        <label :for="inputId" class="vue-input-label">{{ name }}</label>
        <input :type="type" v-model="model" :id="inputId" class="vue-input" autocomplete="false"/>
        <small class="text-red-700" v-if="message">{{ message }}</small>
    </div>
</template>
