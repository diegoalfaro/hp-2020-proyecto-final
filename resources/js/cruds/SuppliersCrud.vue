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
            additionalContextMenuItems: [
                {
                    label: this.__("actions.viewBalanceReport"),
                    action: (_, row) => this.viewBalanceReport(row.getData()),
                },
            ],
            balanceReportItems: [],
            balanceReportTotal: 0,
            form: SupplierForm,
            async getData() {
                const { data } = await axios.get("/api/suppliers");
                return data;
            },
            async createItem(formData) {
                await axios.post("/api/suppliers", formData);
            },
            async updateItem({ id, ...formData }) {
                await axios.put(`/api/suppliers/${id}`, formData);
            },
            async deleteItem({ id }) {
                await axios.delete(`/api/suppliers/${id}`);
            },
            async viewBalanceReport({ id }) {
                const {
                    data: { items, total },
                } = await axios.get(`/api/suppliers/${id}/balance_report`);
                this.balanceReportItems = items;
                this.balanceReportTotal = total;
                this.$refs.balanceReportModal.show();
            },
        };
    },
};
</script>
