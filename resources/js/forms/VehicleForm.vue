<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="domain" class="form-label">
                {{ __("fields.domain") }} <em class="text-danger">*</em>
            </label>
            <input
                type="text"
                class="form-control"
                id="domain"
                pattern="[A-Za-z0-9]+"
                v-model="formData.domain"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="vehicle_brand_id" class="form-label">
                {{ __("fields.brand") }} <em class="text-danger">*</em>
            </label>
            <vehicle-brand-selector
                id="vehicle_brand_id"
                v-model="formData.vehicle_brand_id"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="model" class="form-label">
                {{ __("fields.model") }} <em class="text-danger">*</em>
            </label>
            <input
                type="text"
                class="form-control"
                id="model"
                v-model="formData.model"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="year" class="form-label">
                {{ __("fields.year") }} <em class="text-danger">*</em>
            </label>
            <input
                type="number"
                min="1900"
                :max="currentYear"
                step="1"
                class="form-control"
                id="year"
                v-model="formData.year"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-12">
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
import moment from "moment";

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
            currentYear: moment().format("YYYY"),
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
