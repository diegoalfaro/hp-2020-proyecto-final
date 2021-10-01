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
import VehicleBrandForm from "../forms/VehicleBrandForm.vue";

import { numberFieldDefault, stringFieldDefault } from "../components/List.vue";

export default {
    data() {
        return {
            fields: [
                {
                    ...numberFieldDefault,
                    title: this.__("fields.vehicle_brand_id"),
                    field: "id",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.name"),
                    field: "name",
                },
            ],
            form: VehicleBrandForm,
            async getData() {
                const { data } = await axios.get("/api/vehicle_brands");
                return data;
            },
            async createItem(formData) {
                await axios.post("/api/vehicle_brands", formData);
            },
            async updateItem({ id, ...formData }) {
                await axios.put(`/api/vehicle_brands/${id}`, formData);
            },
            async deleteItem({ id }) {
                await axios.delete(`/api/vehicle_brands/${id}`);
            },
        };
    },
};
</script>
