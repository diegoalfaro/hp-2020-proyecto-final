<template>
    <crud
        :items="localItems"
        @items="localItems = $event"
        :fields="fields"
        :form="form"
        :create="(formData) => createProductDetail(formData)"
        :update="(formData) => updateProductDetail(formData)"
        :delete="(formData) => deleteProductDetail(formData)"
        :readonly="readonly"
    />
</template>

<script>
import ProductDetailForm from "../forms/ProductDetailForm.vue";

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
                    field: "detail.list_price",
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
            form: ProductDetailForm,
            async createProductDetail(formData) {
                await this.upsertProductDetail(formData);
            },
            async updateProductDetail(formData) {
                await this.upsertProductDetail(formData);
            },
            async upsertProductDetail(formData) {
                formData.detail.list_price = formData.list_price;
                formData.detail.subtotal =
                    formData.list_price * formData.detail.quantity;

                const index = this.localItems.findIndex(
                    (item) => item.id == formData.id
                );

                if (index >= 0) {
                    this.$set(this.localItems, index, formData);
                } else {
                    this.localItems.push(formData);
                }
            },
            async deleteProductDetail({ id }) {
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
