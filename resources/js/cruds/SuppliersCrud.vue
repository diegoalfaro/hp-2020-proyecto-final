<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="createSupplier"
        :update="updateSupplier"
        :delete="deleteSupplier"
    />
</template>

<script>
import SupplierForm from "../forms/SupplierForm.vue";

import {
    datetimeFieldDefault,
    numberFieldDefault,
    stringFieldDefault,
} from "../components/List.vue";

export default {
    data() {
        return {
            fields: [
                {
                    ...numberFieldDefault,
                    title: this.__("fields.supplier_id"),
                    field: "id",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.business_name"),
                    field: "business_name",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.cuit"),
                    field: "cuit",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.email"),
                    field: "email",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.phone"),
                    field: "phone",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.address"),
                    field: "address",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.postal_code"),
                    field: "postal_code",
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
            form: SupplierForm,
            async getData() {
                const { data } = await axios.get("/api/suppliers");
                return data;
            },
            async createSupplier(formData) {
                await axios.post("/api/suppliers", formData);
            },
            async updateSupplier({ id, ...formData }) {
                await axios.put(`/api/suppliers/${id}`, formData);
            },
            async deleteSupplier({ id }) {
                await axios.delete(`/api/suppliers/${id}`);
            },
        };
    },
};
</script>
