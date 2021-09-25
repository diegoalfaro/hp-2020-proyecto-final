<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="id" class="form-label">
                {{ __("fields.product") }}
            </label>
            <product-selector
                id="id"
                v-model="productId"
                :disabled="action != 'add'"
            />
        </div>

        <div class="col-md-3">
            <label for="quantity" class="form-label">
                {{ __("fields.quantity") }}
            </label>
            <input
                type="number"
                min="1"
                max="99999999"
                step="1"
                class="form-control"
                id="quantity"
                v-model="quantity"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-3">
            <label for="subtotal" class="form-label">
                {{ __("fields.subtotal") }}
            </label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input
                    type="number"
                    min="0.00"
                    max="99999999.00"
                    step="0.01"
                    class="form-control"
                    id="subtotal"
                    v-model="subtotal"
                    :disabled="true"
                    required
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
            default: {
                detail: {},
            },
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
        quantity: {
            get() {
                return this.formData.detail
                    ? this.formData.detail.quantity
                    : undefined;
            },
            set(value) {
                this.$set(this.formData, "detail", { quantity: value });
            },
        },
        productId: {
            get() {
                return this.formData.id;
            },
            async set(value) {
                const { data } = await axios.get(`/api/products/${value}`);
                for (const key in data) {
                    this.$set(this.formData, key, data[key]);
                }
            },
        },
        subtotal() {
            return this.formData.detail &&
                this.formData.detail.quantity &&
                this.formData.list_price
                ? this.formData.detail.quantity * this.formData.list_price
                : undefined;
        },
    },

    watch: {
        formData: {
            handler() {
                console.log(this.formData);
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
