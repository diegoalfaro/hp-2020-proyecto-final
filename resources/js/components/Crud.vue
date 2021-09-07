<template>
    <card>
        <template #header>
            <div class="text-end">
                <btn @click="onReload" class="mr-2">
                    <icon name="sync" />
                    {{ __("actions.reload") }}
                </btn>
                <btn @click="onAdd" color="dark">
                    <icon name="plus-circle" />
                    {{ __("actions.add") }}
                </btn>
            </div>
        </template>

        <crud-list
            ref="list"
            :fields="fields"
            :onEdit="onEdit"
            :onDelete="onDelete"
            :onViewDetails="onViewDetails"
            :getData="getData"
        />

        <modal ref="modal" :title="modalTitle">
            <component
                ref="form"
                :is="form"
                :action="action"
                :formData="formData"
            ></component>
            <template #footer>
                <btn outline color="dark" @click="closeModal">
                    {{ __("actions.close") }}
                </btn>
                <template v-if="showActionButton">
                    <btn v-if="action == 'delete'" color="danger" @click="save">
                        <icon name="trash" />
                        {{ __("actions.delete") }}
                    </btn>
                    <btn
                        v-else
                        color="success"
                        :disabled="!formValid"
                        @click="save"
                    >
                        <icon name="check-circle" />
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
        fields: {
            type: Array,
        },
        getData: {
            type: Function,
            required: true,
        },
        form: {
            required: true,
        },
        create: {
            type: Function,
            required: true,
        },
        update: {
            type: Function,
            required: true,
        },
        delete: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            action: "add",
            formData: {},
            formValid: false,
        };
    },

    computed: {
        modalTitle() {
            switch (this.action) {
                case "add":
                    return this.__("actions.add");
                case "edit":
                    return this.__("actions.edit");
                case "delete":
                    return this.__("actions.delete");
                case "viewDetails":
                    return this.__("actions.viewDetails");
            }
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
    },

    mounted() {
        this.$watch("$refs.form.valid", (value) => (this.formValid = value));
    },

    methods: {
        onReload() {
            this.$refs.list.loadData();
        },
        onAdd() {
            this.action = "add";
            this.formData = {};
            this.$refs.form.resetValidation();
            this.openModal();
        },
        onEdit(formData) {
            this.action = "edit";
            this.formData = formData;
            this.$refs.form.resetValidation();
            this.openModal();
        },
        onDelete(formData) {
            this.action = "delete";
            this.formData = formData;
            this.$refs.form.resetValidation();
            this.openModal();
        },
        onViewDetails(formData) {
            this.action = "viewDetails";
            this.formData = formData;
            this.$refs.form.resetValidation();
            this.openModal();
        },
        save() {
            if (this.$refs.form.submit(this.action, this.formData)) {
                this.actionHandler(this.formData);
                this.$refs.list.loadData();
                this.closeModal();
            } else {
                alert("El formulario no fue cargado correctamente");
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
