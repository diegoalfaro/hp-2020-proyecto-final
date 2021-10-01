<template>
    <modal ref="modal" :title="__('actions.viewBalanceReport')">
        <balance-report v-bind="$attrs" v-on="$listeners" />
        <template #footer>
            <btn outline color="dark" @click="hide">
                {{ __("actions.close") }}
            </btn>
        </template>
    </modal>
</template>

<script>
export default {
    methods: {
        show() {
            this.$refs.modal.show();
        },
        hide() {
            this.$refs.modal.hide();
        },
    },
};
</script>
