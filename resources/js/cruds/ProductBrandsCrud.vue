<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="(formData) => createItem(formData)"
        :update="(formData) => updateItem(formData)"
        :delete="(formData) => deleteItem(formData)"
    />
</template>

<script>
import ProductBrandForm from "../forms/ProductBrandForm.vue";

import { numberFieldDefault, stringFieldDefault } from "../components/List.vue";

export default {
    data() {
        return {
            fields: [
                {
                    ...numberFieldDefault,
                    title: this.__("fields.product_brand_id"),
                    field: "id",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.name"),
                    field: "name",
                },
            ],
            form: ProductBrandForm,
            async getData() {
                const { data } = await axios.get("/api/product_brands");
                return data;
            },
            async createItem(formData) {
                await axios.post("/api/product_brands", formData);
            },
            async updateItem({ id, ...formData }) {
                await axios.put(`/api/product_brands/${id}`, formData);
            },
            async deleteItem({ id }) {
                await axios.delete(`/api/product_brands/${id}`);
            },
        };
    },
};
</script>
