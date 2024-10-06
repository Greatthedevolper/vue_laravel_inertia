<script setup>
import { computed } from 'vue';

const props = defineProps({
    inputName: {
        type: String,
        required: true
    },
    inputType: {
        type: String,
        default: 'text'
    },
    inpuyId: {
        type: String,
        default: null
    },
    message: String
});

const model = defineModel({
    type: null,
    required: true
});

// Compute the `inpuyId` based on `inputName` if it's not provided
const inpuyIdComputed = computed(() => props.inpuyId || `form-${props.inputName}`);
</script>

<template>
    <div class="input-wrapper">
        <label :for="inpuyIdComputed" class="input-label">{{inputName}}</label>
        <input :type="inputType" :id="inpuyIdComputed" v-model="model" class="custom-input" autocomplete="off"/>
        <small class="text-red-500" v-if="message">{{message}}</small>
    </div>
</template>
