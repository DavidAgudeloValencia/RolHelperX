<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

</script>

<template>
    <textarea :value="modelValue" cols="30" rows="5"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
        @input="$emit('update:modelValue', $event.target.value)" autocomplete="Character Sheet"  ref="textArea"></textarea>
</template>
