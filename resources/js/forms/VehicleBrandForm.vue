<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="id" class="form-label">
                {{ __("fields.vehicle_brand_id") }}
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
            <label for="name" class="form-label">
                {{ __("fields.name") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="name"
                v-model="formData.name"
                :disabled="!interactiveAction"
                required
            />
            <div class="invalid-feedback">
                {{ __("validations.required", { field: __("fields.name") }) }}
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
