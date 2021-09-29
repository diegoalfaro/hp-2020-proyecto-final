<template>
    <div>
        <list :items="items" :fields="fields" />
        <div class="col-md-12">
            <label for="total" class="form-label">
                {{ __("fields.total") }}
            </label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input
                    type="number"
                    min="0.00"
                    max="99999999.00"
                    step="0.01"
                    class="form-control"
                    id="total"
                    v-model="total"
                    readonly
                />
            </div>
        </div>
    </div>
</template>

<script>
import {
    dateFieldDefault,
    moneyFieldDefault,
    stringFieldDefault,
} from "../components/List.vue";

export default {
    props: {
        items: {
            type: Array,
            default() {
                return [];
            },
        },
        total: {
            type: Number,
            default: 0,
        },
    },

    data() {
        return {
            fields: [
                {
                    ...dateFieldDefault,
                    title: this.__("fields.date"),
                    field: "date",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.document_type"),
                    field: "type",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.amount"),
                    field: "amount",
                },
            ],
        };
    },
};
</script>
