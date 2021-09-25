<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="createBudget"
        :update="updateBudget"
        :delete="deleteBudget"
        :additionalContextMenuItems="additionalContextMenuItems"
    />
</template>

<script>
import SupplierPaymentForm from "../forms/SupplierPaymentForm.vue";

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
                    title: this.__("fields.business_name"),
                    field: "supplier.business_name",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.cuit"),
                    field: "supplier.cuit",
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
            additionalContextMenuItems: [
                {
                    label: this.__("actions.downloadDocument"),
                    action: (_, row) => this.downloadDocument(row.getData()),
                },
            ],
            form: SupplierPaymentForm,
            async getData() {
                const { data } = await axios.get("/api/supplier_payments");
                return data;
            },
            async createBudget(formData) {
                await axios.post("/api/supplier_payments", formData);
            },
            async updateBudget({ id, ...formData }) {
                await axios.put(`/api/supplier_payments/${id}`, formData);
            },
            async deleteBudget({ id }) {
                await axios.delete(`/api/supplier_payments/${id}`);
            },
            async downloadDocument({ id }) {
                const { data, headers } = await axios.get(
                    `/api/supplier_payments/${id}/document`,
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
};
</script>
