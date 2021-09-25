<template>
    <crud
        :title="title"
        :items="localItems"
        @items="localItems = $event"
        :fields="fields"
        :form="form"
        :create="createBudgetProduct"
        :update="updateBudgetProduct"
        :delete="deleteBudgetProduct"
        :readonly="readonly"
    />
</template>

<script>
import SupplierReturnProductForm from "../forms/SupplierReturnProductForm.vue";

import {
    datetimeFieldDefault,
    moneyFieldDefault,
    numberFieldDefault,
    stringFieldDefault,
} from "../components/List.vue";

export default {
    props: {
        model: {
            type: Array,
            default() {
                return [];
            },
        },
        items: {
            type: Array,
        },
        readonly: {
            type: Boolean,
            default: false,
        },
    },

    data() {
        return {
            fields: [
                {
                    ...numberFieldDefault,
                    title: this.__("fields.product_id"),
                    field: "id",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.name"),
                    field: "name",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.quantity"),
                    field: "detail.quantity",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.list_price"),
                    field: "list_price",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.subtotal"),
                    field: "detail.subtotal",
                },
                {
                    ...datetimeFieldDefault,
                    title: this.__("fields.created_at"),
                    field: "created_at",
                },
                {
                    ...datetimeFieldDefault,
                    title: this.__("fields.updated_at"),
                    field: "updated_at",
                },
            ],
            localItems: [],
            form: SupplierReturnProductForm,
            async createBudgetProduct(formData) {
                this.localItems.push(formData);
            },
            async updateBudgetProduct(formData) {
                const index = this.localItems.findIndex(
                    (item) => item.id == formData.id
                );
                this.$set(this.localItems, index, formData);
            },
            async deleteBudgetProduct({ id }) {
                const index = this.localItems.findIndex(
                    (item) => item.id == id
                );
                this.$delete(this.localItems, index);
            },
        };
    },

    watch: {
        items(value) {
            this.localItems = value;
        },
        localItems: {
            handler(value) {
                this.$emit("items", value);
            },
            deep: true,
        },
    },
};
</script>
