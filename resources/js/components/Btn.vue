<template>
    <button type="button" :class="className" v-bind="$attrs" v-on="$listeners">
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        click: {
            type: String,
            default: "primary",
        },
        color: {
            type: String,
            default: "primary",
        },
        outline: {
            type: Boolean,
        },
        size: {
            type: String,
        },
    },

    computed: {
        className() {
            return [
                "btn",
                `btn${this.outline ? "-outline" : ""}-${this.color}`,
                { [`modal-${this.size}`]: this.size },
            ];
        },
    },
};
</script>
