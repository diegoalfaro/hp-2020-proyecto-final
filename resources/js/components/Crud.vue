<template>
    <card>
        <template #header>
            <div class="row">
                <div class="col-6 align-self-center">{{ title }}</div>
                <div class="col-6 text-end">
                    <btn
                        v-if="!!$props.getData"
                        @click="handleReload"
                        :outline="true"
                        color="dark"
                        :title="__('actions.reload')"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                    >
                        <icon name="sync" />
                    </btn>
                    <btn
                        v-if="deleteEnabled"
                        @click="handleDelete"
                        :disabled="!selected"
                        color="danger"
                        :title="__('actions.delete')"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                    >
                        <icon name="trash" />
                    </btn>
                    <btn
                        v-if="updateEnabled"
                        @click="handleEdit"
                        :disabled="!selected"
                        color="secondary"
                        :title="__('actions.edit')"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                    >
                        <icon name="pen" />
                    </btn>
                    <btn
                        v-if="createEnabled"
                        @click="handleCreate"
                        color="success"
                        :title="__('actions.add')"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                    >
                        <icon name="plus-circle" />
                    </btn>
                </div>
            </div>
        </template>

        <list
            ref="list"
            height="50vh"
            :fields="fields"
            :contextMenu="contextMenu"
            :items="localItems"
            @selection="selection = $event"
        />

        <modal size="lg" ref="modal" :title="modalTitle">
            <component
                ref="form"
                :is="form"
                :action="action"
                :formData="formData"
            />
            <template #footer>
                <btn outline color="dark" @click="closeModal">
                    {{ __("actions.cancel") }}
                </btn>
                <template v-if="showActionButton">
                    <btn v-if="action == 'delete'" color="danger" @click="save">
                        {{ __("actions.delete") }}
                    </btn>
                    <btn v-else color="success" @click="save">
                        {{ __("actions.save") }}
                    </btn>
                </template>
            </template>
        </modal>
    </card>
</template>

<script>
export const CrudActions = {
    Add: "add",
    Edit: "edit",
    Delete: "delete",
    ViewDetails: "viewDetails",
};

export default {
    props: {
        title: {
            type: String,
        },
        actions: {
            type: Array,
            default() {
                return [
                    CrudActions.Add,
                    CrudActions.Edit,
                    CrudActions.Delete,
                    CrudActions.ViewDetails,
                ];
            },
        },
        items: {
            type: Array,
            default() {
                return [];
            },
        },
        additionalContextMenuItems: {
            type: Array,
            default() {
                return [];
            },
        },
        fields: {
            type: Array,
        },
        form: {
            required: true,
        },
        readonly: {
            type: Boolean,
            default: false,
        },
        getData: {
            type: Function,
        },
        create: {
            type: Function,
        },
        update: {
            type: Function,
        },
        delete: {
            type: Function,
        },
    },

    data() {
        return {
            action: CrudActions.Add,
            formData: {},
            localItems: [],
            selection: [],
        };
    },

    async mounted() {
        if (this.getData) {
            this.loadData();
        }
    },

    computed: {
        selected() {
            return this.selection.length > 0 ? this.selection[0] : null;
        },
        modalTitle() {
            return this.__(`actions.${this.action}`);
        },
        showActionButton() {
            switch (this.action) {
                case CrudActions.Add:
                case CrudActions.Edit:
                case CrudActions.Delete:
                    return true;
            }
            return false;
        },
        actionHandler() {
            switch (this.action) {
                case CrudActions.Add:
                    return this.create;
                case CrudActions.Edit:
                    return this.update;
                case CrudActions.Delete:
                    return this.delete;
            }
        },
        contextMenu() {
            const separationItems = [{ separator: true }];

            const additionalsItems =
                this.additionalContextMenuItems.length > 0
                    ? this.additionalContextMenuItems
                    : [];

            const createItems = [
                {
                    label: this.__("actions.viewDetails"),
                    action: this.handleViewDetails,
                },
            ];

            const updateItems = [
                {
                    label: this.__("actions.edit"),
                    action: this.handleEdit,
                },
            ];

            const deleteItems = [
                {
                    label: this.__("actions.delete"),
                    action: this.handleDelete,
                },
            ];

            const actionsItems = [
                ...(additionalsItems.length > 0 ? separationItems : []),
                ...(this.createEnabled ? createItems : []),
                ...(this.updateEnabled ? updateItems : []),
                ...(this.deleteEnabled ? deleteItems : []),
            ];

            const deselectItems = [
                ...(actionsItems.length > 0 ? separationItems : []),
                {
                    label: this.__("actions.deselect"),
                    action: (_, row) => row.deselect(),
                },
            ];

            return [...additionalsItems, ...actionsItems, ...deselectItems];
        },
        createEnabled() {
            return (
                this.actions.includes(CrudActions.Add) && !this.$props.readonly
            );
        },
        updateEnabled() {
            return (
                this.actions.includes(CrudActions.Edit) && !this.$props.readonly
            );
        },
        deleteEnabled() {
            return (
                this.actions.includes(CrudActions.Delete) &&
                !this.$props.readonly
            );
        },
        viewDetailsEnabled() {
            return (
                this.actions.includes(CrudActions.ViewDetails) &&
                !this.$props.readonly
            );
        },
    },

    watch: {
        items(value) {
            this.localItems = value;
            this.$emit("items", value);
        },
        selection(value) {
            this.$emit("selection", value);
        },
        selected(value) {
            this.$emit("selected", value);
        },
    },

    methods: {
        async loadData() {
            this.localItems = await this.getData();
        },
        handleReload() {
            this.loadData();
        },
        handleCreate() {
            this.handleAction(CrudActions.Add, {});
        },
        handleEdit() {
            this.handleAction(
                CrudActions.Edit,
                JSON.parse(JSON.stringify(this.selected))
            );
        },
        handleDelete() {
            this.handleAction(
                CrudActions.Delete,
                JSON.parse(JSON.stringify(this.selected))
            );
        },
        handleViewDetails() {
            this.handleAction(
                CrudActions.ViewDetails,
                JSON.parse(JSON.stringify(this.selected))
            );
        },
        handleAction(action, values) {
            this.$refs.form.resetForm();
            this.action = action;
            this.formData = values;
            this.openModal();
        },
        save() {
            if (this.$refs.form.submit(this.action, this.formData)) {
                this.actionHandler(this.formData)
                    .then(() => {
                        if (this.getData) {
                            this.loadData();
                        }
                        setTimeout(() => {
                            this.closeModal();
                        }, 250);
                    })
                    .catch(
                        ({
                            response: {
                                data: { message },
                            },
                        }) => {
                            alert(message);
                        }
                    );
            }
        },
        openModal() {
            this.$refs.modal.show();
        },
        closeModal() {
            this.$refs.modal.hide();
        },
    },
};
</script>
