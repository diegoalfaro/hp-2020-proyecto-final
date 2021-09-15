<template>
    <crud
        :get-data="getData"
        :fields="fields"
        :form="form"
        :create="createVehicle"
        :update="updateVehicle"
        :delete="deleteVehicle"
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
                    ...numberFieldDefault,
                    title: this.__("fields.vehicle_brand_id"),
                    field: "vehicle_brand_id",
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
            async createVehicle(formData) {
                await axios.post("/api/vehicles", formData);
            },
            async updateVehicle({ id, ...formData }) {
                await axios.put(`/api/vehicles/${id}`, formData);
            },
            async deleteVehicle({ id }) {
                await axios.delete(`/api/vehicles/${id}`);
            },
        };
    },
};
</script>
