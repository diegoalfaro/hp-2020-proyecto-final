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
        <confirm-modal
            ref="confirmDownloadModal"
            :action="confirmDownloadAction"
        >
            {{ __("answers.download_purchase") }}
        </confirm-modal>
    </div>
</template>

<script>
import SupplierPurchaseForm from "../forms/SupplierPurchaseForm.vue";

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
                    title: this.__("fields.supplier_return_id"),
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
                    title: this.__("fields.total"),
                    field: "total",
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
            form: SupplierPurchaseForm,
            async getData() {
                const { data } = await axios.get("/api/supplier_purchases");
                return data;
            },
            async createItem(formData) {
                const {
                    data: { id },
                } = await axios.post("/api/supplier_purchases", formData);
                this.answerDownloadDocument({ id });
            },
            async updateItem({ id, ...formData }) {
                await axios.put(`/api/supplier_purchases/${id}`, formData);
            },
            async deleteItem({ id }) {
                await axios.delete(`/api/supplier_purchases/${id}`);
            },
            async downloadDocument({ id }) {
                const { data, headers } = await axios.get(
                    `/api/supplier_purchases/${id}/document`,
                    { responseType: "arraybuffer" }
                );
                const fileName = headers["content-disposition"].replace(
                    /.*filename="(.*)"/,
                    "$1"
                );
                download(data, fileName);
            },
            confirmDownloadAction: () => {},
            async answerDownloadDocument({ id }) {
                this.confirmDownloadAction = () => {
                    this.downloadDocument({ id });
                };
                this.$refs.confirmDownloadModal.show();
            },
        };
    },
};
</script>
