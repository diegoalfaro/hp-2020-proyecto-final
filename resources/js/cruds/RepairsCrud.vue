<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="createRepair"
        :update="updateRepair"
        :delete="deleteRepair"
        :additionalContextMenuItems="additionalContextMenuItems"
    />
</template>

<script>
import RepairForm from "../forms/RepairForm.vue";

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
                    title: this.__("fields.repair_id"),
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
                    ...stringFieldDefault,
                    title: this.__("fields.domain"),
                    field: "vehicle.domain",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.brand"),
                    field: "vehicle.vehicle_brand.name",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.model"),
                    field: "vehicle.model",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.year"),
                    field: "vehicle.year",
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
                    ...stringFieldDefault,
                    title: this.__("fields.observations"),
                    field: "observations",
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
            form: RepairForm,
            async getData() {
                const { data } = await axios.get("/api/repairs");
                return data;
            },
            async createRepair(formData) {
                await axios.post("/api/repairs", formData);
            },
            async updateRepair({ id, ...formData }) {
                await axios.put(`/api/repairs/${id}`, formData);
            },
            async deleteRepair({ id }) {
                await axios.delete(`/api/repairs/${id}`);
            },
            async downloadDocument({ id }) {
                const { data, headers } = await axios.get(
                    `/api/repairs/${id}/document`,
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
