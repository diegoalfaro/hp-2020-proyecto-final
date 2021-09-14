<template>
    <div class="card">
        <template v-if="title || !!$slots.header">
            <div class="card-header">
                <slot name="header">
                    {{ title }}
                </slot>
            </div>
        </template>
        <template v-if="$slots.default">
            <slot name="body">
                <div class="card-body">
                    <slot></slot>
                </div>
            </slot>
        </template>
        <template v-if="!!$slots.footer">
            <div class="card-footer">
                <slot name="footer"></slot>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
        },
    },
};
</script>
