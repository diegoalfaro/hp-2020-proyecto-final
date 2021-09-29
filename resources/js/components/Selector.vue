<template>
    <v-select
        v-bind="$attrs"
        v-on="$listeners"
        v-model="localValue"
        :placeholder="__('placeholders.select')"
        :class="[{ valid }]"
    >
        <template #search="{ attributes, events }">
            <input
                class="vs__search"
                :required="!valid"
                v-bind="attributes"
                v-on="events"
            />
        </template>
        <template #no-options="{ search }">
            {{
                search
                    ? __("placeholders.selector_empty_search", { search })
                    : __("placeholders.selector_empty")
            }}
        </template>
    </v-select>
</template>

<style lang="scss">
//  Global Component Variables
$vs-component-line-height: 1.8;
$vs-component-placeholder-color: inherit;

//  Active State
$vs-state-active-bg: #1a63c1;
$vs-state-active-color: #fff;

//  Disabled State
$vs-state-disabled-bg: #e9ecef;
$vs-state-disabled-color: #212529;
$vs-state-disabled-controls-color: #ced4da;
$vs-state-disabled-cursor: initial;

//  Borders
$vs-border-width: 1px;
$vs-border-style: solid;
$vs-border-radius: 0.25rem;
$vs-border-color: #ced4da;

//  Component Controls: Clear, Open Indicator
$vs-controls-color: #5d5d5d;
$vs-controls-size: 0.75;
$vs-controls-deselect-text-shadow: 0 1px 0 #fff;

//  Selected
$vs-selected-bg: #f8fafc;

//  Dropdown
$vs-dropdown-bg: #fff;

.vs__search::placeholder {
    color: #838b93 !important;
}

.was-validated .v-select.valid .vs__dropdown-toggle {
    border-color: #0e7c3c;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%230e7c3c' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 44px center;
    background-size: calc(0.8em + 0.375rem) calc(0.8em + 0.375rem);
}

.was-validated .v-select:not(.valid) .vs__dropdown-toggle {
    border-color: #c0211c;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23c0211c'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23c0211c' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 24px center;
    background-size: calc(0.8em + 0.375rem) calc(0.8em + 0.375rem);
}

.vs__dropdown-toggle {
    .vs__selected-options {
        width: 0;

        .vs__selected {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: calc(100% - 20px);
            display: block;
        }
    }
}

@import "~vue-select/src/scss/vue-select";
</style>

<script>
export default {
    props: {
        value: {},
        required: { type: Boolean, default: false },
    },

    data() {
        return {
            localValue: null,
        };
    },

    watch: {
        value(value) {
            this.localValue = value;
        },
        localValue(value) {
            this.$emit("input", value);
        },
    },

    computed: {
        valid() {
            return !this.required || !!this.localValue;
        },
    },
};
</script>
