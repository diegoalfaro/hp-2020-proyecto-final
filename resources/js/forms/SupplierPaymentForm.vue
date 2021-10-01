<template>
    <form
        ref="form"
        :class="['row', 'g-3', { 'was-validated': validated }]"
        novalidate
    >
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

        <div class="col-md-3">
            <label for="date" class="form-label">
                {{ __("fields.date") }} <em class="text-danger">*</em>
            </label>
            <input
                type="date"
                class="form-control"
                id="date"
                v-model="formData.date"
                :disabled="!interactiveAction"
                required
            />
        </div>

        <div class="col-md-3">
            <label for="amount" class="form-label">
                {{ __("fields.amount") }} <em class="text-danger">*</em>
            </label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input
                    type="number"
                    class="form-control"
                    id="amount"
                    v-model="formData.amount"
                    :disabled="!interactiveAction"
                    :min="0"
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
