<template>
    <crud
        :items="localItems"
        @items="localItems = $event"
        :fields="fields"
        :form="form"
        :formProps="formProps"
        :create="(formData) => createItem(formData)"
        :update="(formData) => updateItem(formData)"
        :delete="(formData) => deleteItem(formData)"
        :readonly="readonly"
    />
</template>

<script>
import SupplierPurchaseProductForm from "../forms/SupplierPurchaseProductForm.vue";

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
        supplierId: {
            type: Number,
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
                    ...stringFieldDefault,
                    title: this.__("fields.brand"),
                    field: "product_brand.name",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.quantity"),
                    field: "detail.quantity",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.cost_price"),
                    field: "detail.cost_price",
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
            form: SupplierPurchaseProductForm,
            async createItem(formData) {
                await this.upsertProductDetail(formData);
            },
            async updateItem(formData) {
                await this.upsertProductDetail(formData);
            },
            async upsertProductDetail(formData) {
                formData.detail.cost_price = formData.cost_price;
                formData.detail.subtotal =
                    formData.cost_price * formData.detail.quantity;

                const index = this.localItems.findIndex(
                    (item) => item.id == formData.id
                );

                if (index >= 0) {
                    this.$set(this.localItems, index, formData);
                } else {
                    this.localItems.push(formData);
                }
            },
            async deleteItem({ id }) {
                const index = this.localItems.findIndex(
                    (item) => item.id == id
                );
                this.$delete(this.localItems, index);
            },
        };
    },

    computed: {
        formProps() {
            return { supplierId: this.supplierId };
        },
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
