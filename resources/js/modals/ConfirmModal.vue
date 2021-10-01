<template>
    <modal ref="modal" v-bind="$attrs" v-on="$listeners">
        <template #footer>
            <btn outline color="dark" @click="$refs.modal.hide()">
                {{ __("actions.cancel") }}
            </btn>
            <btn outline color="success" @click="action">
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

    methods() {
        return {
            ...this.$refs.modal,
        };
    },
};
</script>
