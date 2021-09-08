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
import ProductForm from "./ProductForm.vue";

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
                    title: this.__("fields.supplier_id"),
                    field: "supplier_id",
                    sorter: "string",
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
                    title: this.__("fields.cost"),
                    field: "cost",
                    sorter: "number",
                },
                {
                    title: this.__("fields.gains"),
                    field: "gains",
                    sorter: "number",
                },
                {
                    title: this.__("fields.list_price"),
                    field: "list_price",
                    sorter: "number",
                },
                {
                    title: this.__("fields.existence"),
                    field: "existence",
                    sorter: "number",
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
