<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="createProduct"
        :update="updateProduct"
        :delete="deleteProduct"
    />
</template>

<script>
import ProductForm from "../forms/ProductForm.vue";

import {
    moneyFieldDefault,
    numberFieldDefault,
    stringFieldDefault,
} from "../components/List.vue";

export default {
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
                    title: this.__("fields.supplier_id"),
                    field: "supplier_id",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.business_name"),
                    field: "supplier.business_name",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.cuit"),
                    field: "supplier.cuit",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.cost"),
                    field: "cost",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.profit"),
                    field: "profit",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.list_price"),
                    field: "list_price",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.initial_stock"),
                    field: "initial_stock",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.stock"),
                    field: "stock",
                },
            ],
            form: ProductForm,
            async getData() {
                const { data } = await axios.get("/api/products");
                return data;
            },
            async createProduct(formData) {
                await axios.post("/api/products", formData);
            },
            async updateProduct({ id, ...formData }) {
                await axios.put(`/api/products/${id}`, formData);
            },
            async deleteProduct({ id }) {
                await axios.delete(`/api/products/${id}`);
            },
        };
    },
};
</script>
