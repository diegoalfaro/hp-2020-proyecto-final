<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="createCustomer"
        :update="updateCustomer"
        :delete="deleteCustomer"
    />
</template>

<script>
import CustomerForm from "./CustomerForm.vue";

export default {
    data() {
        return {
            fields: [
                {
                    title: this.__("fields.customer_id"),
                    field: "id",
                    sorter: "number",
                },
                {
                    title: this.__("fields.first_name"),
                    field: "first_name",
                    sorter: "string",
                },
                {
                    title: this.__("fields.last_name"),
                    field: "last_name",
                    sorter: "string",
                },
                {
                    title: this.__("fields.identity"),
                    field: "identity",
                    sorter: "number",
                },
                {
                    title: this.__("fields.address"),
                    field: "address",
                    sorter: "string",
                },
                {
                    title: this.__("fields.phone"),
                    field: "phone",
                    sorter: "string",
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
            form: CustomerForm,
            async getData() {
                const { data } = await axios.get("/api/customers");
                return data;
            },
            async createCustomer(formData) {
                await axios.post("/api/customers", formData);
            },
            async updateCustomer({ id, ...formData }) {
                await axios.put(`/api/customers/${id}`, formData);
            },
            async deleteCustomer({ id }) {
                await axios.delete(`/api/customers/${id}`);
            },
        };
    },
};
</script>
