<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="id" class="form-label">
                {{ __("fields.vehicle_id") }}
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
            <label for="domain" class="form-label">
                {{ __("fields.domain") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="domain"
                v-model="formData.domain"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.domain"),
                    })
                }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="vehicle_brand_id" class="form-label">
                {{ __("fields.brand") }}
            </label>
            <vehicle-brand-selector
                id="vehicle_brand_id"
                v-model="formData.vehicle_brand_id"
                :disabled="!interactiveAction"
            />
            <div class="invalid-feedback">
                {{
                    __("validations.required", {
                        field: __("fields.vehicle_brand_id"),
                    })
                }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="model" class="form-label">
                {{ __("fields.model") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="model"
                v-model="formData.model"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.model") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="year" class="form-label">
                {{ __("fields.year") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="year"
                v-model="formData.year"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.year") }) }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="observations" class="form-label">
                {{ __("fields.observations") }}
            </label>
            <textarea
                type="text"
                class="form-control"
                id="observations"
                v-model="formData.observations"
                :disabled="!interactiveAction"
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
