<template>
    <button
        @click="$emit('click')"
        type="button"
        class="rounded dim font-bold text-sm text-primary inline-flex items-center focus:outline-none active:outline-none focus:shadow-outline active:shadow-outline pl-1 pr-2"
    >
        <icon type="edit" width="20" height="20" view-box="0 0 24 24" />
        <span>{{ __('Change') }}</span>
    </button>
</template>

<script>
export default {
    //
}
</script>
