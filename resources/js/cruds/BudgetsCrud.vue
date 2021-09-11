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
import BudgetForm from "../forms/BudgetForm.vue";

export default {
    data() {
        return {
            fields: [
                {
                    title: this.__("fields.budget_id"),
                    field: "id",
                    sorter: "number",
                },
                {
                    title: this.__("fields.first_name"),
                    field: "customer.first_name",
                    sorter: "string",
                },
                {
                    title: this.__("fields.last_name"),
                    field: "customer.last_name",
                    sorter: "string",
                },
                {
                    title: this.__("fields.identity"),
                    field: "customer.identity",
                    sorter: "number",
                },
                {
                    title: this.__("fields.address"),
                    field: "customer.address",
                    sorter: "string",
                },
                {
                    title: this.__("fields.phone"),
                    field: "customer.phone",
                    sorter: "string",
                },
                {
                    title: this.__("fields.workforce_cost"),
                    field: "workforce_cost",
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
                    title: this.__("fields.total"),
                    field: "total",
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
                    title: this.__("fields.date"),
                    field: "date",
                    formatter: "datetime",
                    formatterParams: {
                        inputFormat: "YYYY-MM-DD",
                        outputFormat: "DD/MM/YY",
                    },
                    sorter: "date",
                },
                {
                    title: this.__("fields.due_date"),
                    field: "due_date",
                    formatter: "datetime",
                    formatterParams: {
                        inputFormat: "YYYY-MM-DD",
                        outputFormat: "DD/MM/YY",
                    },
                    sorter: "date",
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
            form: BudgetForm,
            async getData() {
                const { data } = await axios.get("/api/budgets");
                return data;
            },
            async createBudget(formData) {
                await axios.post("/api/budgets", formData);
            },
            async updateBudget({ id, ...formData }) {
                await axios.put(`/api/budgets/${id}`, formData);
            },
            async deleteBudget({ id }) {
                await axios.delete(`/api/budgets/${id}`);
            },
        };
    },
};
</script>
