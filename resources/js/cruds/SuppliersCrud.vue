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

export default {
    data() {
        return {
            fields: [
                {
                    title: this.__("fields.supplier_id"),
                    field: "id",
                    sorter: "number",
                },
                {
                    title: this.__("fields.business_name"),
                    field: "business_name",
                    sorter: "string",
                },
                {
                    title: this.__("fields.cuit"),
                    field: "cuit",
                    sorter: "number",
                },
                {
                    title: this.__("fields.email"),
                    field: "email",
                    sorter: "number",
                },
                {
                    title: this.__("fields.phone"),
                    field: "phone",
                    sorter: "string",
                },
                {
                    title: this.__("fields.address"),
                    field: "address",
                    sorter: "string",
                },
                {
                    title: this.__("fields.postal_code"),
                    field: "postal_code",
                    sorter: "number",
                },
                {
                    title: this.__("fields.created_at"),
                    field: "created_at",
                    formatter: "datetime",
                    sorter: "date",
                },
                {
                    title: this.__("fields.updated_at"),
                    field: "updated_at",
                    formatter: "datetime",
                    sorter: "date",
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
