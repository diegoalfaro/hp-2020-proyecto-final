<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="(formData) => createItem(formData)"
        :update="(formData) => updateItem(formData)"
        :delete="(formData) => deleteItem(formData)"
    />
</template>

<script>
import VehicleForm from "../forms/VehicleForm.vue";

import { numberFieldDefault, stringFieldDefault } from "../components/List.vue";

export default {
    data() {
        return {
            fields: [
                {
                    ...numberFieldDefault,
                    title: this.__("fields.vehicle_id"),
                    field: "id",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.domain"),
                    field: "domain",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.brand"),
                    field: "vehicle_brand.name",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.model"),
                    field: "model",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.year"),
                    field: "year",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.observations"),
                    field: "observations",
                },
            ],
            form: VehicleForm,
            async getData() {
                const { data } = await axios.get("/api/vehicles");
                return data;
            },
            async createItem(formData) {
                await axios.post("/api/vehicles", formData);
            },
            async updateItem({ id, ...formData }) {
                await axios.put(`/api/vehicles/${id}`, formData);
            },
            async deleteItem({ id }) {
                await axios.delete(`/api/vehicles/${id}`);
            },
        };
    },
};
</script>
