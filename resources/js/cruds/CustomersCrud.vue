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
import CustomerForm from "../forms/CustomerForm.vue";

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
                    title: this.__("fields.customer_id"),
                    field: "id",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.first_name"),
                    field: "first_name",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.last_name"),
                    field: "last_name",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.identity"),
                    field: "identity",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.address"),
                    field: "address",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.phone"),
                    field: "phone",
                },
                {
                    ...datetimeFieldDefault,
                    title: this.__("fields.created_at"),
                    field: "created_at",
                    formatter: "datetime",
                },
                {
                    ...datetimeFieldDefault,
                    title: this.__("fields.updated_at"),
                    field: "updated_at",
                    formatter: "datetime",
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
