<template>
    <div>
        <card title="Filtros" class="mb-4">
            <row>
                <row-col>
                    <label for="supplier_id_selector" class="form-label">
                        {{ __("fields.supplier") }}
                    </label>
                    <supplier-selector
                        id="supplier_id_selector"
                        v-model="supplierId"
                    />
                </row-col>
                <row-col>
                    <label for="product_brand_id_selector" class="form-label">
                        {{ __("fields.brand") }}
                    </label>
                    <product-brand-selector
                        id="product_brand_id_selector"
                        v-model="productBrandId"
                    />
                </row-col>
            </row>
        </card>
        <card title="Productos afectados" class="mb-4">
            <list :items="items" :fields="fields" />
        </card>
        <card>
            <row class="row-cols-auto align-items-end justify-content-end">
                <row-col>
                    <label for="percentage" class="form-label">
                        {{ __("fields.percentage") }}
                        <em class="text-danger">*</em>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">%</span>
                        <input
                            type="number"
                            min="-99"
                            max="9999"
                            step="1"
                            class="form-control"
                            id="percentage"
                            v-model="percentage"
                        />
                    </div>
                </row-col>
                <row-col>
                    <btn :disabled="percentage == 0" @click="priceUpdate">
                        Actualizar precios
                    </btn>
                </row-col>
            </row>
        </card>
    </div>
</template>

<script>
import {
    numberFieldDefault,
    stringFieldDefault,
    moneyFieldDefault,
} from "../components/List.vue";

export default {
    data() {
        return {
            supplierId: null,
            productBrandId: null,
            products: [],
            percentage: 0,
            fields: [
                {
                    ...numberFieldDefault,
                    title: this.__("fields.product_id"),
                    field: "id",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.name"),
                    field: "name",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.brand"),
                    field: "product_brand.name",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.business_name"),
                    field: "supplier.business_name",
                },
                {
                    ...stringFieldDefault,
                    title: this.__("fields.cuit"),
                    field: "supplier.cuit",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.cost_price"),
                    field: "cost_price",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.list_price"),
                    field: "list_price",
                },
                {
                    ...moneyFieldDefault,
                    title: this.__("fields.profit"),
                    field: "profit",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.initial_stock"),
                    field: "initial_stock",
                },
                {
                    ...numberFieldDefault,
                    title: this.__("fields.stock"),
                    field: "stock",
                },
            ],
        };
    },

    computed: {
        items() {
            return this.products.filter(
                ({ product_brand_id, supplier_id }) =>
                    (!this.productBrandId ||
                        this.productBrandId == product_brand_id) &&
                    (!this.supplierId || this.supplierId == supplier_id)
            );
        },
    },

    async mounted() {
        await this.loadData();
    },

    methods: {
        async loadData() {
            const { data } = await axios.get("/api/products");
            this.products = data;
        },
        async priceUpdate() {
            const { items, percentage } = this;
            const body = { products: items, percentage };
            await axios.post("/api/products/price_update", body);
            await this.loadData();
        },
    },
};
</script>
