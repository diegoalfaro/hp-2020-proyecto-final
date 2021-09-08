<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="id" class="form-label">
                {{ __("fields.product_id") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="id"
                v-model="formData.id"
                :disabled="true"
            />
        </div>

        <div class="col-md-6">
            <label for="supplier_id" class="form-label">
                {{ __("fields.supplier_id") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="supplier_id"
                v-model="formData.supplier_id"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.supplier_id"),
                    })
                }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="name" class="form-label">
                {{ __("fields.name") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="name"
                v-model="formData.name"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.name") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="mark" class="form-label">
                {{ __("fields.mark") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="mark"
                v-model="formData.mark"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.mark") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="cost" class="form-label">
                {{ __("fields.cost") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="cost"
                v-model="formData.cost"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.cost") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="gains" class="form-label">
                {{ __("fields.gains") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="gains"
                v-model="formData.gains"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.gains") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="list_price" class="form-label">
                {{ __("fields.list_price") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="list_price"
                v-model="formData.list_price"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.list_price"),
                    })
                }}
            </div>
        </div>
        <div class="col-md-6">
            <label for="existence" class="form-label">
                {{ __("fields.existence") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="existence"
                v-model="formData.existence"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.existence"),
                    })
                }}
            </div>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        action: {
            type: String,
            default: "add",
        },
        formData: {
            type: Object,
            default: {},
        },
    },

    data() {
        return {
            valid: false,
            validated: false,
        };
    },

    computed: {
        interactiveAction() {
            switch (this.action) {
                case "add":
                case "edit":
                    return true;
            }
            return false;
        },
    },

    watch: {
        formData: {
            handler() {
                this.$nextTick(function () {
                    this.valid = this.$refs.form.checkValidity();
                });
            },
            deep: true,
        },
    },

    methods: {
        submit() {
            this.validated = true;
            return this.valid;
        },
        resetForm() {
            this.validated = false;
        },
    },
};
</script>
