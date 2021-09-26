<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="business_name" class="form-label">
                {{ __("fields.business_name") }} <em class="text-danger">*</em>
            </label>
            <input
                type="text"
                class="form-control"
                id="business_name"
                v-model="formData.business_name"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="cuit" class="form-label">
                {{ __("fields.cuit") }} <em class="text-danger">*</em>
            </label>
            <input
                type="number"
                min="1000000"
                max="99999999999"
                step="1"
                class="form-control"
                id="cuit"
                v-model="formData.cuit"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">
                {{ __("fields.email") }} <em class="text-danger">*</em>
            </label>
            <input
                type="email"
                class="form-control"
                id="email"
                v-model="formData.email"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">
                {{ __("fields.phone") }} <em class="text-danger">*</em>
            </label>
            <input
                type="tel"
                class="form-control"
                id="phone"
                v-model="formData.phone"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="address" class="form-label">
                {{ __("fields.address") }} <em class="text-danger">*</em>
            </label>
            <input
                type="text"
                class="form-control"
                id="address"
                v-model="formData.address"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="postal_code" class="form-label">
                {{ __("fields.postal_code") }} <em class="text-danger">*</em>
            </label>
            <input
                type="number"
                min="1"
                max="9999999"
                step="1"
                class="form-control"
                id="postal_code"
                v-model="formData.postal_code"
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
