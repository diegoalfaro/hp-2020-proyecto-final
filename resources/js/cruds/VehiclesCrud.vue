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

export default {
    data() {
        return {
            fields: [
                {
                    title: this.__("fields.vehicle_id"),
                    field: "id",
                    sorter: "number",
                },
                {
                    title: this.__("fields.domain"),
                    field: "domain",
                    sorter: "string",
                },
                {
                    title: this.__("fields.vehicle_brand_id"),
                    field: "vehicle_brand_id",
                    sorter: "number",
                },
                {
                    title: this.__("fields.model"),
                    field: "model",
                    sorter: "string",
                },
                {
                    title: this.__("fields.year"),
                    field: "year",
                    sorter: "number",
                },
                {
                    title: this.__("fields.observations"),
                    field: "observations",
                    sorter: "string",
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
