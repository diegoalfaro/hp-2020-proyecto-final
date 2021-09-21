<template>
    <crud
        :title="title"
        :items="localItems"
        @items="localItems = $event"
        :fields="fields"
        :form="form"
        :create="createSaleProduct"
        :update="updateSaleProduct"
        :delete="deleteSaleProduct"
        :readonly="readonly"
    />
</template>

<script>
import SaleProductForm from "../forms/SaleProductForm.vue";

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
            title: "Detalles de ventas",
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
            form: SaleProductForm,
            async createSaleProduct(formData) {
                this.localItems.push(formData);
            },
            async updateSaleProduct(formData) {
                const index = this.localItems.findIndex(
                    (item) => item.id == formData.id
                );
                this.$set(this.localItems, index, formData);
            },
            async deleteSaleProduct({ id }) {
                const index = this.localItems.findIndex(
                    (item) => item.id == id
                );
                console.log(this.$delete);
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
