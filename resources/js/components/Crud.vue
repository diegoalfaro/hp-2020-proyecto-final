<template>
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <button
                v-on:click="reloadData"
                type="button"
                class="btn btn-primary mr-2"
            >
                {{ __("actions.reload") }}
            </button>
            <button v-on:click="onCreate" type="button" class="btn btn-primary">
                {{ __("actions.addNew") }}
            </button>
        </div>
        <div class="card-body p-0">
            <crud-list
                ref="list"
                v-bind:fields="fields"
                v-bind:onEdit="onEdit"
                v-bind:onDelete="onDelete"
                v-bind:onViewDetail="onViewDetail"
                v-bind:dataUrl="dataUrl"
            />
        </div>
    </div>
</template>

<style scoped lang="scss">
.card-header {
    gap: 8px;
}
</style>

<script>
export default {
    props: {
        fields: {
            type: Array,
        },
        dataUrl: {
            type: String,
        },
    },

    methods: {
        onCreate() {
            console.log("create");
        },
        onEdit(e, row) {
            console.log("edit: ", row);
        },
        onDelete(e, row) {
            console.log("delete: ", row);
        },
        onViewDetail(e, row) {
            console.log("viewDetail: ", row);
        },
        reloadData() {
            this.$refs.list.loadData();
        },
    },
};
</script>
