<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="id" class="form-label">
                {{ __("fields.supplier_id") }}
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
            <label for="business_name" class="form-label">
                {{ __("fields.business_name") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="business_name"
                v-model="formData.business_name"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.business_name"),
                    })
                }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="cuit" class="form-label">
                {{ __("fields.cuit") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="cuit"
                v-model="formData.cuit"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.cuit") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">
                {{ __("fields.email") }}
            </label>
            <input
                type="email"
                class="form-control"
                id="email"
                v-model="formData.email"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.email") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">
                {{ __("fields.phone") }}
            </label>
            <input
                type="tel"
                class="form-control"
                id="phone"
                v-model="formData.phone"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.phone") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="address" class="form-label">
                {{ __("fields.address") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="address"
                v-model="formData.address"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", { field: __("fields.address") })
                }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="postal_code" class="form-label">
                {{ __("fields.postal_code") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="postal_code"
                v-model="formData.postal_code"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.postal_code"),
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
