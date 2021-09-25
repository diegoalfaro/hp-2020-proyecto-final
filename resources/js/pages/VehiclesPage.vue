<template>
    <main-layout :title="__('sections.vehicles.title')">
        <card>
            <template #header>
                <nav-tabs class="card-header-tabs">
                    <nav-item
                        @click="currentTab = tabs.vehicles"
                        :active="currentTab == tabs.vehicles"
                    >
                        {{ __("sections.vehicles.title") }}
                    </nav-item>
                    <nav-item
                        @click="currentTab = tabs.vehicleBrands"
                        :active="currentTab == tabs.vehicleBrands"
                    >
                        {{ __("sections.vehicle_brands.title") }}
                    </nav-item>
                </nav-tabs>
            </template>
            <components :is="currentTab" />
        </card>
    </main-layout>
</template>

<script>
import VehiclesCrud from "../cruds/VehiclesCrud.vue";
import VehicleBrandsCrud from "../cruds/VehicleBrandsCrud.vue";

const tabs = {
    vehicles: VehiclesCrud,
    vehicleBrands: VehicleBrandsCrud,
};

export default {
    data() {
        return {
            currentTab: tabs.vehicles,
            tabs,
        };
    },
};
</script>
