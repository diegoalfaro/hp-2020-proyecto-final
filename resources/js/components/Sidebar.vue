<template>
    <nav
        class="
            sidebar
            d-flex
            flex-column flex-shrink-0
            bg-white
            shadow-lg
            h-100
        "
    >
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li v-for="(item, key) in items" :key="key" class="nav-item">
                <router-link
                    :to="{ name: item.routeName }"
                    :class="[
                        'nav-link',
                        { active: isActive(item.routeName) },
                        'py-3',
                        'border-bottom',
                    ]"
                    aria-current="page"
                    :title="item.title"
                    data-bs-toggle="tooltip"
                    data-bs-placement="right"
                >
                    <icon :name="item.icon" />
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<style scoped lang="scss">
.sidebar {
    min-width: 50px;

    i {
        font-size: 18px;
    }

    .nav-flush .nav-link {
        border-radius: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
    }
}
</style>

<script>
export default {
    computed: {
        items() {
            return [
                {
                    title: this.__("sections.home.title"),
                    icon: this.__("sections.home.icon"),
                    routeName: "home",
                    active: true,
                },
                {
                    title: this.__("sections.customers.title"),
                    icon: this.__("sections.customers.icon"),
                    routeName: "customers",
                    active: true,
                },
                {
                    title: this.__("sections.suppliers.title"),
                    icon: this.__("sections.suppliers.icon"),
                    routeName: "suppliers",
                    active: true,
                },
                {
                    title: this.__("sections.products.title"),
                    icon: this.__("sections.products.icon"),
                    routeName: "products",
                    active: true,
                },
                {
                    title: this.__("sections.sales.title"),
                    icon: this.__("sections.sales.icon"),
                    routeName: "sales",
                    active: true,
                },
                {
                    title: this.__("sections.budgets.title"),
                    icon: this.__("sections.budgets.icon"),
                    routeName: "budgets",
                    active: true,
                },
                {
                    title: this.__("sections.repairs.title"),
                    icon: this.__("sections.repairs.icon"),
                    routeName: "repairs",
                    active: true,
                },
                {
                    title: this.__("sections.vehicle_brands.title"),
                    icon: this.__("sections.vehicle_brands.icon"),
                    routeName: "vehicle_brands",
                    active: true,
                },
                {
                    title: this.__("sections.vehicles.title"),
                    icon: this.__("sections.vehicles.icon"),
                    routeName: "vehicles",
                    active: true,
                },
                {
                    title: this.__("sections.supplierPayments.title"),
                    icon: this.__("sections.supplierPayments.icon"),
                    routeName: "supplier_payments",
                    active: true,
                },
                {
                    title: this.__("sections.customerPayments.title"),
                    icon: this.__("sections.customerPayments.icon"),
                    routeName: "customer_payments",
                    active: true,
                },
            ];
        },
        currentRouteName() {
            return this.$route.name;
        },
    },

    methods: {
        isActive(routeName) {
            return routeName == this.currentRouteName;
        },
    },
};
</script>
