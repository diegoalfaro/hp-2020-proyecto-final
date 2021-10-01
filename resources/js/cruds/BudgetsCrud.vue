<template>
    <div>
        <crud
            :get-data="getData"
            :fields="fields"
            :form="form"
            :create="createBudget"
            :update="updateBudget"
            :delete="deleteBudget"
            :additionalContextMenuItems="additionalContextMenuItems"
        />
        <confirm-modal ref="confirmModal" title="hola" />
    </div>
</template>

<script>
import BudgetForm from "../forms/BudgetForm.vue";

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
                    title: this.__("fields.first_name"),
                    field: "customer.first_name",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.last_name"),
                    field: "customer.last_name",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.identity"),
                    field: "customer.identity",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.address"),
                    field: "customer.address",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.phone"),
                    field: "customer.phone",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.workforce_cost"),
                    field: "workforce_cost",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.total"),
                    field: "total",
                },
                {
                    ...dateFieldDefault,
                    title: this.__("fields.date"),
                    field: "date",
                },
                {
                    ...dateFieldDefault,
                    title: this.__("fields.due_date"),
                    field: "due_date",
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
            additionalContextMenuItems: [
                {
                    label: this.__("actions.downloadDocument"),
                    action: (_, row) => this.downloadDocument(row.getData()),
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
            async downloadDocument({ id }) {
                const { data, headers } = await axios.get(
                    `/api/budgets/${id}/document`,
                    { responseType: "arraybuffer" }
                );
                const fileName = headers["content-disposition"].replace(
                    /.*filename="(.*)"/,
                    "$1"
                );
                download(data, fileName);
            },
        };
    },
    mounted() {
        this.$refs.confirmModal.show();
    },
};
</script>
