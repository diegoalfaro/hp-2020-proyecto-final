<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="name" class="form-label">
                {{ __("fields.name") }} <em class="text-danger">*</em>
            </label>
            <input
                type="text"
                class="form-control"
                id="name"
                v-model="formData.name"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="initial_stock" class="form-label">
                {{ __("fields.initial_stock") }} <em class="text-danger">*</em>
            </label>
            <input
                type="number"
                min="0"
                max="99999999"
                step="1"
                class="form-control"
                id="initial_stock"
                v-model="formData.initial_stock"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="supplier_id" class="form-label">
                {{ __("fields.supplier") }} <em class="text-danger">*</em>
            </label>
            <supplier-selector
                id="supplier_id"
                v-model="formData.supplier_id"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="brand" class="form-label">
                {{ __("fields.brand") }} <em class="text-danger">*</em>
            </label>
            <product-brand-selector
                id="product_brand_id"
                v-model="formData.product_brand_id"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-4">
            <label for="cost" class="form-label">
                {{ __("fields.cost") }} <em class="text-danger">*</em>
            </label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input
                    type="number"
                    min="0.00"
                    max="99999999.00"
                    step="0.01"
                    class="form-control"
                    id="cost"
                    v-model="formData.cost"
                    :disabled="!interactiveAction"
                    required
                />
            </div>
        </div>

        <div class="col-md-4">
            <label for="list_price" class="form-label">
                {{ __("fields.list_price") }} <em class="text-danger">*</em>
            </label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input
                    type="number"
                    min="0.00"
                    max="99999999.00"
                    step="0.01"
                    class="form-control"
                    id="list_price"
                    v-model="formData.list_price"
                    :disabled="!interactiveAction"
                    required
                />
            </div>
        </div>

        <div class="col-md-4">
            <label for="profit" class="form-label">
                {{ __("fields.profit") }}
            </label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input
                    type="number"
                    min="0.00"
                    max="99999999.00"
                    step="0.01"
                    class="form-control"
                    id="profit"
                    v-model="profit"
                    readonly
                />
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
        profit() {
            return this.formData.list_price - this.formData.cost;
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
