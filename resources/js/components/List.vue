<template>
    <VueTabulator
        ref="tabulator"
        v-model="items"
        :options="options"
        :integration="{ updateStrategy: 'REPLACE' }"
    />
</template>

<style lang="scss">
@import "~vue-tabulator/dist/scss/bootstrap/tabulator_bootstrap4";
.tabulator .tabulator-header {
    border-top: 0;
}
.tabulator-menu {
    position: absolute;
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
    z-index: 999999 !important;

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
export const fieldDefault = {
    headerFilter: true,
};

export const numberFieldDefault = {
    ...fieldDefault,
    sorter: "number",
    headerHozAlign: "right",
    hozAlign: "right",
    formatterParams: {
        decimal: ",",
        thousand: ".",
    },
};

export const stringFieldDefault = {
    ...fieldDefault,
    sorter: "string",
};

export const dateFieldDefault = {
    ...fieldDefault,
    formatter: "datetime",
    formatterParams: {
        inputFormat: "YYYY-MM-DD",
        outputFormat: "DD/MM/YY",
    },
    sorter: "date",
    headerHozAlign: "right",
    hozAlign: "right",
};

export const datetimeFieldDefault = {
    ...fieldDefault,
    formatter: "datetime",
    sorter: "date",
    headerHozAlign: "right",
    hozAlign: "right",
};

export const moneyFieldDefault = {
    ...numberFieldDefault,
    formatter: "money",
    formatterParams: {
        decimal: ",",
        thousand: ".",
        symbol: "$",
        precision: false,
    },
};

export default {
    props: {
        items: {
            type: Array,
        },
        height: {
            type: String,
        },
        paginationSize: {
            type: Number,
            default: 10,
        },
        fields: {
            type: Array,
            default() {
                return [];
            },
        },
        contextMenu: {
            type: Array,
        },
        selectable: {
            type: Number,
            default: 1,
        },
    },

    data() {
        return {
            pagination: "local",
            locale: "es",
            langs: {
                es: {
                    pagination: {
                        page_size: __("pagination.pageSize"),
                        page_title: __("pagination.pageTitle"),
                        first: __("pagination.first"),
                        first_title: __("pagination.firstTitle"),
                        last: __("pagination.last"),
                        last_title: __("pagination.lastTitle"),
                        prev: __("pagination.prev"),
                        prev_title: __("pagination.prevTitle"),
                        next: __("pagination.next"),
                        next_title: __("pagination.nextTitle"),
                        all: __("pagination.all"),
                    },
                    headerFilters: {
                        default: __("placeholders.filter"),
                    },
                },
            },
            layoutColumnsOnNewData: true,
            selection: [],
        };
    },

    computed: {
        columns() {
            return this.fields;
        },
        autoColumns() {
            return !this.fields || !this.fields.length;
        },
        autoColumnsDefinitions() {
            return (definitions) => {
                definitions.forEach((column) => {
                    column.headerFilter = true;
                });
                return definitions;
            };
        },
        rowSelectionChanged() {
            return (selection) => {
                this.$emit("selection", selection);
            };
        },
        rowContext() {
            return (_, row) => {
                if (this.selectable == 1) {
                    this.$refs.tabulator.getInstance().deselectRow();
                    row.select();
                }
            };
        },
        rowContextMenu() {
            return this.contextMenu;
        },
        options() {
            const {
                height,
                pagination,
                paginationSize,
                locale,
                langs,
                columns,
                autoColumns,
                autoColumnsDefinitions,
                rowSelectionChanged,
                rowContext,
                rowContextMenu,
                layoutColumnsOnNewData,
                selectable,
            } = this;

            return {
                height,
                pagination,
                paginationSize,
                locale,
                langs,
                columns,
                autoColumns,
                autoColumnsDefinitions,
                rowSelectionChanged,
                rowContext,
                rowContextMenu,
                layoutColumnsOnNewData,
                selectable,
            };
        },
    },

    methods: {
        getInstance() {
            return this.$refs.tabulator.getInstance();
        },
    },
};
</script>
