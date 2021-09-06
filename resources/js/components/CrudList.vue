<template>
    <VueTabulator ref="tabulator" v-model="data" :options="options" />
</template>

<style lang="scss">
@import "~vue-tabulator/dist/scss/bootstrap/tabulator_bootstrap4";
.tabulator .tabulator-header {
    border-top: 0;
}
.tabulator-menu {
    position: absolute;
    z-index: 1000;
    min-width: 10rem;
    padding: 0.5rem 0;
    margin: 0;
    font-size: 0.9rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0.25rem;

    .tabulator-menu-item {
        display: block;
        width: 100%;
        padding: 0.25rem 1rem;
        clear: both;
        font-weight: 400;
        color: #212529;
        text-align: inherit;
        text-decoration: none;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
        cursor: pointer;

        &:hover,
        &:focus {
            color: #1e2125;
            background-color: #e9ecef;
        }
    }

    .tabulator-menu-separator {
        height: 0;
        margin: 0.5rem 0;
        overflow: hidden;
        border-top: 1px solid rgba(0, 0, 0, 0.15);
    }
}
</style>

<script>
export default {
    props: {
        height: {
            type: String,
            default: "420px",
        },
        paginationSize: {
            type: Number,
            default: 10,
        },
        fields: {
            type: Array,
        },
        dataUrl: {
            type: String,
        },
        onViewDetail: {
            type: Function,
        },
        onEdit: {
            type: Function,
        },
        onDelete: {
            type: Function,
        },
    },

    data() {
        return {
            data: [],
            options: {
                height: this.height,
                selectable: 1,
                pagination: "local",
                paginationSize: this.paginationSize,
                locale: true,
                paginationSizeSelector: true,
                autoColumns: !this.fields,
                autoColumnsDefinitions: (definitions) => {
                    definitions.forEach((column) => {
                        column.headerFilter = true;
                    });

                    return definitions;
                },
                rowContext: (e, row) => {
                    this.getInstance().deselectRow();
                    row.select();
                },
                rowContextMenu: [
                    {
                        label: this.__("actions.viewDetail"),
                        action: this.onViewDetail,
                    },
                    {
                        label: this.__("actions.edit"),
                        action: this.onEdit,
                    },
                    {
                        label: this.__("actions.delete"),
                        action: this.onDelete,
                    },
                    {
                        separator: true,
                    },
                    {
                        label: "Quitar selección",
                        action: (e, row) => {
                            row.deselect();
                        },
                    },
                ],
                langs: {
                    es: {
                        pagination: {
                            page_size: this.__("pagination.pageSize"),
                            page_title: this.__("pagination.pageTitle"),
                            first: this.__("pagination.first"),
                            first_title: this.__("pagination.firstTitle"),
                            last: this.__("pagination.last"),
                            last_title: this.__("pagination.lastTitle"),
                            prev: this.__("pagination.prev"),
                            prev_title: this.__("pagination.prevTitle"),
                            next: this.__("pagination.next"),
                            next_title: this.__("pagination.nextTitle"),
                            all: this.__("pagination.all"),
                        },
                    },
                },
            },
        };
    },

    mounted() {
        this.loadData();
        this.getInstance().setLocale("es");
    },

    methods: {
        loadData() {
            axios.get(this.dataUrl).then((response) => {
                this.data = response.data;
            });
        },
        setFilter(field, operator, value) {
            this.getInstance().setFilter(field, operator, value);
        },
        getInstance() {
            return this.$refs.tabulator.getInstance();
        },
    },
};
</script>
