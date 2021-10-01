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
            {{ __("answers.download_return") }}
        </confirm-modal>
    </div>
</template>

<script>
import CustomerReturnForm from "../forms/CustomerReturnForm.vue";

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
                    title: this.__("fields.customer_return_id"),
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
            form: CustomerReturnForm,
            async getData() {
                const { data } = await axios.get("/api/customer_returns");
                return data;
            },
            async createItem(formData) {
                const {
                    data: { id },
                } = await axios.post("/api/customer_returns", formData);
                this.answerDownloadDocument({ id });
            },
            async updateItem({ id, ...formData }) {
                await axios.put(`/api/customer_returns/${id}`, formData);
            },
            async deleteItem({ id }) {
                await axios.delete(`/api/customer_returns/${id}`);
            },
            async downloadDocument({ id }) {
                const { data, headers } = await axios.get(
                    `/api/customer_returns/${id}/document`,
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
