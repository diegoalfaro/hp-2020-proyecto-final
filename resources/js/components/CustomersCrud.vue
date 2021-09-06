<template>
    <crud v-bind:data-url="dataUrl" v-bind:fields="fields" />
</template>

<script>
export default {
    data() {
        return {
            dataUrl: "/api/customers",
            fields: [
                {
                    title: this.__("fields.number"),
                    field: "number",
                    sorter: "number",
                },
                {
                    title: this.__("fields.firstName"),
                    field: "firstName",
                    sorter: "string",
                },
                {
                    title: this.__("fields.lastName"),
                    field: "lastName",
                    sorter: "string",
                },
                {
                    title: this.__("fields.identity"),
                    field: "identity",
                    sorter: "number",
                },
                {
                    title: this.__("fields.address"),
                    field: "address",
                    sorter: "string",
                },
                {
                    title: this.__("fields.phone"),
                    field: "phone",
                    sorter: "string",
                },
                {
                    title: this.__("fields.created_at"),
                    field: "created_at",
                    formatter: "datetime",
                    sorter: "date",
                },
                {
                    title: this.__("fields.updated_at"),
                    field: "updated_at",
                    formatter: "datetime",
                    sorter: "date",
                },
            ],
        };
    },
};
</script>
