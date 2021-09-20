<template>
    <selector
        v-bind="$attrs"
        v-on="$listeners"
        :options="options"
        :reduce="(supplier) => supplier.id"
        label="business_name"
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
        const { data } = await axios.get("/api/suppliers");
        this.options = data;
    },
};
</script>
