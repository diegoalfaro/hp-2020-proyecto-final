<template>
    <modal ref="modal" v-bind="$attrs" v-on="$listeners">
        <slot></slot>
        <template #footer>
            <btn outline color="dark" @click="hide">
                {{ __("actions.cancel") }}
            </btn>
            <btn outline color="success" @click="accept">
                {{ __("actions.accept") }}
            </btn>
        </template>
    </modal>
</template>

<script>
export default {
    props: {
        action: {
            type: Function,
            default() {
                return () => {};
            },
        },
    },

    methods: {
        accept() {
            this.action();
            this.hide();
        },
        show() {
            this.$refs.modal.show();
        },
        hide() {
            this.$refs.modal.hide();
        },
    },
};
</script>
