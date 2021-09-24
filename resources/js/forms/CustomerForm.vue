<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
        <div class="col-md-6">
            <label for="identity" class="form-label">
                {{ __("fields.identity") }}
            </label>
            <input
                type="number"
                min="1000000"
                max="999999999"
                step="1"
                class="form-control"
                id="identity"
                v-model="formData.identity"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="first_name" class="form-label">
                {{ __("fields.first_name") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="first_name"
                v-model="formData.first_name"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="last_name" class="form-label">
                {{ __("fields.last_name") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="last_name"
                v-model="formData.last_name"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">
                {{ __("fields.phone") }}
            </label>
            <input
                type="text"
                class="form-control"
                id="phone"
                v-model="formData.phone"
                :disabled="!interactiveAction"
                required
            />
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
