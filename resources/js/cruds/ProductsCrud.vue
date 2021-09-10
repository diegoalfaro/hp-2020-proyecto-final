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

export default {
    data() {
        return {
            fields: [
                {
                    title: this.__("fields.product_id"),
                    field: "id",
                    sorter: "number",
                },
                {
                    title: this.__("fields.name"),
                    field: "name",
                    sorter: "string",
                },
                {
                    title: this.__("fields.mark"),
                    field: "mark",
                    sorter: "string",
                },
                {
                    title: this.__("fields.supplier_id"),
                    field: "supplier_id",
                    sorter: "string",
                },
                {
                    title: this.__("fields.business_name"),
                    field: "supplier.business_name",
                    sorter: "string",
                },
                {
                    title: this.__("fields.cuit"),
                    field: "supplier.cuit",
                    sorter: "string",
                },
                {
                    title: this.__("fields.cost"),
                    field: "cost",
                    sorter: "number",
                    headerHozAlign: "right",
                    hozAlign: "right",
                    formatter: "money",
                    formatterParams: {
                        decimal: ",",
                        thousand: ".",
                        symbol: "$",
                        precision: false,
                    },
                },
                {
                    title: this.__("fields.profit"),
                    field: "profit",
                    sorter: "number",
                    headerHozAlign: "right",
                    hozAlign: "right",
                    formatter: "money",
                    formatterParams: {
                        decimal: ",",
                        thousand: ".",
                        symbol: "$",
                        precision: false,
                    },
                },
                {
                    title: this.__("fields.list_price"),
                    field: "list_price",
                    sorter: "number",
                    headerHozAlign: "right",
                    hozAlign: "right",
                    formatter: "money",
                    formatterParams: {
                        decimal: ",",
                        thousand: ".",
                        symbol: "$",
                        precision: false,
                    },
                },
                {
                    title: this.__("fields.initial_stock"),
                    field: "initial_stock",
                    sorter: "number",
                    headerHozAlign: "right",
                    hozAlign: "right",
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
