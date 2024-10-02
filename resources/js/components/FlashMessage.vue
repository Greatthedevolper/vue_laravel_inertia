<script setup>
import { defineProps } from 'vue';

// Define props
const props = defineProps({
    title: {
        type: String,
        default: null,
    },
    flashClass: {
        type: String,
        default: null,
    },
});

// Emit function for closing the flash message
const emit = defineEmits(['closeMessage']);

// Function to close flash message
const closeFlashMessage = () => { 
    emit('closeMessage');
};
</script>

<template>
    <div
        class="fixed w-max px-4 py-2 end-0 top-0 flex items-center gap-2"
        :class="{
            'bg-green-300 text-green-950': flashClass === 'success',
            'bg-red-300 text-red-950': flashClass === 'danger',
        }"
    >
        <p>{{ title }}</p>
        <span class="inline-flex w-5 h-4 items-center justify-center cursor-pointer" @click="closeFlashMessage">
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </span>
    </div>
</template>
