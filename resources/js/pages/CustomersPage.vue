<template>
    <main-layout :title="__('sections.customers.title')">
        <card>
            <template #header>
                <nav-tabs class="card-header-tabs">
                    <nav-item
                        @click="currentTab = tabs.customers"
                        :active="currentTab == tabs.customers"
                    >
                        {{ __("sections.customers.title") }}
                    </nav-item>
                    <nav-item
                        @click="currentTab = tabs.customerPayments"
                        :active="currentTab == tabs.customerPayments"
                    >
                        {{ __("sections.customerPayments.title") }}
                    </nav-item>
                    <nav-item
                        @click="currentTab = tabs.customerReturns"
                        :active="currentTab == tabs.customerReturns"
                    >
                        {{ __("sections.customerReturns.title") }}
                    </nav-item>
                </nav-tabs>
            </template>
            <components :is="currentTab" />
        </card>
    </main-layout>
</template>

<script>
import CustomersCrud from "../cruds/CustomersCrud.vue";
import CustomerPaymentsCrud from "../cruds/CustomerPaymentsCrud.vue";
import CustomerReturnsCrud from "../cruds/CustomerReturnsCrud.vue";

const tabs = {
    customers: CustomersCrud,
    customerPayments: CustomerPaymentsCrud,
    customerReturns: CustomerReturnsCrud,
};

export default {
    data() {
        return {
            currentTab: tabs.customers,
            tabs,
        };
    },
};
</script>
