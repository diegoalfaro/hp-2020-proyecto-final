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
                v-model="formData.id"
                :disabled="action != 'add'"
            />
        </div>

        <div class="col-md-6">
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
            quantityProxy: 1,
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
                return this.formData.detail ? this.formData.detail.quantity : 0;
            },
            set(value) {
                if (!this.formData.detail) {
                    this.formData.detail = {};
                }
                this.formData.detail.quantity = value;
            },
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
