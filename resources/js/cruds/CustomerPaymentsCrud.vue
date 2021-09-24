<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="createBudget"
        :update="updateBudget"
        :delete="deleteBudget"
    />
</template>

<script>
import CustomerPaymentForm from "../forms/CustomerPaymentForm.vue";

import {
    dateFieldDefault,
    datetimeFieldDefault,
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
                    title: this.__("fields.budget_id"),
                    field: "id",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.full_name"),
                    field: "customer.full_name",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.identity"),
                    field: "customer.identity",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.amount"),
                    field: "amount",
                },
                {
                    ...dateFieldDefault,
                    title: this.__("fields.date"),
                    field: "date",
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
            form: CustomerPaymentForm,
            async getData() {
                const { data } = await axios.get("/api/customer_payments");
                return data;
            },
            async createBudget(formData) {
                await axios.post("/api/customer_payments", formData);
            },
            async updateBudget({ id, ...formData }) {
                await axios.put(`/api/customer_payments/${id}`, formData);
            },
            async deleteBudget({ id }) {
                await axios.delete(`/api/customer_payments/${id}`);
            },
        };
    },
};
</script>
