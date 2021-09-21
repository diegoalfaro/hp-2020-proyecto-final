<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="createProductBrand"
        :update="updateProductBrand"
        :delete="deleteProductBrand"
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
            async createProductBrand(formData) {
                await axios.post("/api/product_brands", formData);
            },
            async updateProductBrand({ id, ...formData }) {
                await axios.put(`/api/product_brands/${id}`, formData);
            },
            async deleteProductBrand({ id }) {
                await axios.delete(`/api/product_brands/${id}`);
            },
        };
    },
};
</script>
