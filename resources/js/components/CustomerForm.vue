<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="id" class="form-label">
                {{ __("fields.customer_id") }}
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
            <label for="identity" class="form-label">
                {{ __("fields.identity") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="identity"
                v-model="formData.identity"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", { field: __("fields.identity") })
                }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="firstName" class="form-label">Nombre</label>
            <input
                type="text"
                class="form-control"
                id="firstName"
                v-model="formData.firstName"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">Nombre requerido</div>
        </div>

        <div class="col-md-6">
            <label for="lastName" class="form-label">Apellido</label>
            <input
                type="text"
                class="form-control"
                id="lastName"
                v-model="formData.lastName"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">Apellido requerido</div>
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">Teléfono</label>
            <input
                type="text"
                class="form-control"
                id="phone"
                v-model="formData.phone"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">Teléfono requerido</div>
        </div>

        <div class="col-md-6">
            <label for="address" class="form-label">Dirección</label>
            <input
                type="text"
                class="form-control"
                id="address"
                v-model="formData.address"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">Dirección requerida</div>
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
