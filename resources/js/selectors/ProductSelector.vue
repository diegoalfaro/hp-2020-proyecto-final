<template>
    <selector
        v-bind="$attrs"
        v-on="$listeners"
        :options="options"
        :reduce="(item) => item.id"
    />
</template>

<script>
export default {
    props: {
        supplierId: {
            type: Number,
        },
    },

    data() {
        return {
            products: [],
        };
    },

    async mounted() {
        const { data } = await axios.get("/api/products");
        this.products = data.map((item) => ({
            label: __("selectors.product", {
                brand: item.product_brand.name,
                ...item,
            }),
            ...item,
        }));
    },

    computed: {
        options() {
            if (this.supplierId) {
                return this.products.filter(
                    (option) => option.supplier.id == this.supplierId
                );
            } else {
                return this.products;
            }
        },
    },
};
</script>
