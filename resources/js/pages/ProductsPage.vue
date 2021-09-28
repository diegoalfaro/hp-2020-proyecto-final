<template>
    <main-layout :title="__('sections.products.title')">
        <card>
            <template #header>
                <nav-tabs class="card-header-tabs">
                    <nav-item
                        @click="currentTab = tabs.products"
                        :active="currentTab == tabs.products"
                    >
                        {{ __("sections.products.title") }}
                    </nav-item>
                    <nav-item
                        @click="currentTab = tabs.productBrands"
                        :active="currentTab == tabs.productBrands"
                    >
                        {{ __("sections.product_brands.title") }}
                    </nav-item>
                    <nav-item
                        @click="currentTab = tabs.productPriceUpdate"
                        :active="currentTab == tabs.productPriceUpdate"
                    >
                        {{ __("sections.product_price_update.title") }}
                    </nav-item>
                </nav-tabs>
            </template>
            <components :is="currentTab" />
        </card>
    </main-layout>
</template>

<script>
import ProductsCrud from "../cruds/ProductsCrud.vue";
import ProductBrandsCrud from "../cruds/ProductBrandsCrud.vue";
import ProductPriceUpdatePage from "./ProductPriceUpdatePage.vue";

const tabs = {
    products: ProductsCrud,
    productBrands: ProductBrandsCrud,
    productPriceUpdate: ProductPriceUpdatePage,
};

export default {
    data() {
        return {
            currentTab: tabs.products,
            tabs,
        };
    },
};
</script>
