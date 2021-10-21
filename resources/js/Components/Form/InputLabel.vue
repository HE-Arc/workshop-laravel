<template>
    <label :for="inputId">{{ labelText }}</label>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        type="text"
        class="form-control"
        :class="formError ? 'is-invalid' : ''"
        :id="inputId"
    >
    <BreezeInputError :message="formError" />
</template>

<script>
import BreezeInputError from '@/Components/InputError.vue'

export default {
    components: {
        BreezeInputError,
    },

    props: ['modelValue', 'inputId', 'labelText', 'formError'],

    emits: ['update:modelValue'],
}
</script>

