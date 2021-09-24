<template>
    <v-select
        v-bind="$attrs"
        v-on="$listeners"
        :placeholder="__('placeholders.select')"
    />
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

@import "~vue-select/src/scss/vue-select";
</style>

<script>
export default {};
</script>
