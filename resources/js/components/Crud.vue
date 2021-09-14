<template>
    <card>
        <template #header>
            <div class="row">
                <div class="col-6 align-self-center">{{ title }}</div>
                <div class="col-6 text-end">
                    <btn
                        v-if="!!$props.getData && !$props.readonly"
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
                        v-if="!!$props.delete && !$props.readonly"
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
                        v-if="!!$props.update && !$props.readonly"
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
                        v-if="!!$props.create && !$props.readonly"
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
export default {
    props: {
        title: {
            type: String,
        },
        items: {
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
            action: "add",
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
                case "add":
                case "edit":
                case "delete":
                    return true;
            }
            return false;
        },
        actionHandler() {
            switch (this.action) {
                case "add":
                    return this.create;
                case "edit":
                    return this.update;
                case "delete":
                    return this.delete;
            }
        },
        contextMenu() {
            return [
                ...(this.readonly
                    ? []
                    : [
                          {
                              label: this.__("actions.viewDetails"),
                              action: this.handleViewDetails,
                          },
                          {
                              label: this.__("actions.edit"),
                              action: this.handleEdit,
                          },
                          {
                              label: this.__("actions.delete"),
                              action: this.handleDelete,
                          },
                          {
                              separator: true,
                          },
                      ]),
                {
                    label: this.__("actions.deselect"),
                    action: (_, row) => row.deselect(),
                },
            ];
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
            this.handleAction("add", {});
        },
        handleEdit() {
            this.handleAction(
                "edit",
                JSON.parse(JSON.stringify(this.selected))
            );
        },
        handleDelete() {
            this.handleAction(
                "delete",
                JSON.parse(JSON.stringify(this.selected))
            );
        },
        handleViewDetails() {
            this.handleAction(
                "viewDetails",
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
                    .catch(() => {
                        alert("No se pudo procesar la acción solicitada");
                    });
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
