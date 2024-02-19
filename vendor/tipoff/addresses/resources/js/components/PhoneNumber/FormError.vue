<template>
    <p class="mt-2 text-sm text-red-600">
        <slot></slot>
    </p>
</template>

<script>
    export default {
        name: "FormError",
        props: ['errors'],
    }
</script>

<style scoped>

</style>
