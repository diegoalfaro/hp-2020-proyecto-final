<template>
    <main-layout :title="__('sections.suppliers.title')">
        <card>
            <template #header>
                <nav-tabs class="card-header-tabs">
                    <nav-item
                        @click="currentTab = tabs.suppliers"
                        :active="currentTab == tabs.suppliers"
                    >
                        {{ __("sections.suppliers.title") }}
                    </nav-item>
                    <nav-item
                        @click="currentTab = tabs.supplierPurchases"
                        :active="currentTab == tabs.supplierPurchases"
                    >
                        {{ __("sections.supplierPurchases.title") }}
                    </nav-item>
                    <nav-item
                        @click="currentTab = tabs.supplierPayments"
                        :active="currentTab == tabs.supplierPayments"
                    >
                        {{ __("sections.supplierPayments.title") }}
                    </nav-item>
                    <nav-item
                        @click="currentTab = tabs.supplierReturns"
                        :active="currentTab == tabs.supplierReturns"
                    >
                        {{ __("sections.supplierReturns.title") }}
                    </nav-item>
                </nav-tabs>
            </template>
            <components :is="currentTab" />
        </card>
    </main-layout>
</template>

<script>
import SuppliersCrud from "../cruds/SuppliersCrud.vue";
import SupplierPurchasesCrud from "../cruds/SupplierPurchasesCrud.vue";
import SupplierPaymentsCrud from "../cruds/SupplierPaymentsCrud.vue";
import SupplierReturnsCrud from "../cruds/SupplierReturnsCrud.vue";

const tabs = {
    suppliers: SuppliersCrud,
    supplierPurchases: SupplierPurchasesCrud,
    supplierPayments: SupplierPaymentsCrud,
    supplierReturns: SupplierReturnsCrud,
};

export default {
    data() {
        return {
            currentTab: tabs.suppliers,
            tabs,
        };
    },
};
</script>
