<template>
    <li class="nav-item">
        <button
            :class="['nav-link', { active: active }]"
            v-bind="$attrs"
            v-on="$listeners"
        >
            <slot></slot>
        </button>
    </li>
</template>

<script>
export default {
    props: {
        active: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
