<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="createSupplierReturn"
        :update="updateSupplierReturn"
        :delete="deleteSupplierReturn"
    />
</template>

<script>
import SupplierReturnForm from "../forms/SupplierReturnForm.vue";

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
                    ...numberFieldDefault,
                    title: this.__("fields.supplier_id"),
                    field: "supplier.id",
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
            form: SupplierReturnForm,
            async getData() {
                const { data } = await axios.get("/api/supplier_returns");
                return data;
            },
            async createSupplierReturn(formData) {
                await axios.post("/api/supplier_returns", formData);
            },
            async updateSupplierReturn({ id, ...formData }) {
                await axios.put(`/api/supplier_returns/${id}`, formData);
            },
            async deleteSupplierReturn({ id }) {
                await axios.delete(`/api/supplier_returns/${id}`);
            },
        };
    },
};
</script>
