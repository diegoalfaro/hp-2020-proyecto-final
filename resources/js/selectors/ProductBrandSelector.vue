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
    data() {
        return {
            options: [],
        };
    },

    async mounted() {
        const { data } = await axios.get("/api/product_brands");
        this.options = data.map((item) => ({
            label: __("selectors.product_brand", item),
            ...item,
        }));
    },
};
</script>
