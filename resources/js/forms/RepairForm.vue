<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="customer_id" class="form-label">
                {{ __("fields.customer") }}
            </label>
            <customer-selector
                id="customer_id"
                v-model="formData.customer_id"
                :disabled="!interactiveAction"
            />
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
        </div>

        <div class="col-md-6">
            <label for="workforce_cost" class="form-label">
                {{ __("fields.workforce_cost") }}
            </label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input
                    type="text"
                    class="form-control"
                    id="workforce_cost"
                    v-model="formData.workforce_cost"
                    :disabled="!interactiveAction"
                    required
                />
            </div>
        </div>

        <div class="col-md-12">
            <card title="Detalles de productos">
                <product-details-crud
                    :readonly="!interactiveAction"
                    :items="formData.products"
                    @items="$set(formData, 'products', $event)"
                />
            </card>
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
