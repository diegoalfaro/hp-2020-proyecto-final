<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="id" class="form-label">
                {{ __("fields.budget_id") }}
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
            <label for="customer_id" class="form-label">
                {{ __("fields.customer_id") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="customer_id"
                v-model="formData.customer_id"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.customer_id"),
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
            <label for="due_date" class="form-label">
                {{ __("fields.due_date") }}
            </label>
            <input
                type="date"
                class="form-control"
                id="due_date"
                v-model="formData.due_date"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", { field: __("fields.due_date") })
                }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="workforce_cost" class="form-label">
                {{ __("fields.workforce_cost") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="workforce_cost"
                v-model="formData.workforce_cost"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.workforce_cost"),
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
