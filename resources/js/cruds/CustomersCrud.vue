<template>
    <div>
        <crud
            :get-data="getData"
            :fields="fields"
            :form="form"
            :create="(formData) => createItem(formData)"
            :update="(formData) => updateItem(formData)"
            :delete="(formData) => deleteItem(formData)"
            :additionalContextMenuItems="additionalContextMenuItems"
        />
        <modal
            ref="balanceReportModal"
            :title="__('actions.viewBalanceReport')"
        >
            <balance-report
                :items="balanceReportItems"
                :total="balanceReportTotal"
            />
            <template #footer>
                <btn
                    outline
                    color="dark"
                    @click="$refs.balanceReportModal.hide()"
                >
                    {{ __("actions.close") }}
                </btn>
            </template>
        </modal>
    </div>
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
            additionalContextMenuItems: [
                {
                    label: this.__("actions.viewBalanceReport"),
                    action: (_, row) => this.viewBalanceReport(row.getData()),
                },
            ],
            balanceReportItems: [],
            balanceReportTotal: 0,
            form: CustomerForm,
            async getData() {
                const { data } = await axios.get("/api/customers");
                return data;
            },
            async createItem(formData) {
                await axios.post("/api/customers", formData);
            },
            async updateItem({ id, ...formData }) {
                await axios.put(`/api/customers/${id}`, formData);
            },
            async deleteItem({ id }) {
                await axios.delete(`/api/customers/${id}`);
            },
            async viewBalanceReport({ id }) {
                const {
                    data: { items, total },
                } = await axios.get(`/api/customers/${id}/balance_report`);
                this.balanceReportItems = items;
                this.balanceReportTotal = total;
                this.$refs.balanceReportModal.show();
            },
        };
    },
};
</script>
