<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="id" class="form-label">
                {{ __("fields.supplier_payment_id") }}
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
                {{ __("fields.supplier") }}
            </label>
            <supplier-selector
                id="supplier_id"
                v-model="formData.supplier_id"
                :disabled="!interactiveAction"
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
            <label for="date" class="form-label">
                {{ __("fields.date") }}
            </label>
            <input
                type="date"
                class="form-control"
                id="date"
                v-model="formData.date"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.date") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="amount" class="form-label">
                {{ __("fields.amount") }}
            </label>
            <input
                type="number"
                class="form-control"
                id="amount"
                v-model="formData.amount"
                :disabled="!interactiveAction"
                :min="0"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.amount"),
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
