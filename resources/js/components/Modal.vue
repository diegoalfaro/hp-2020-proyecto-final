<template>
    <div ref="modal" class="modal" tabindex="-1">
        <div :class="className">
            <div class="modal-content">
                <template v-if="this.title || !!this.$slots.header">
                    <div class="modal-header">
                        <slot name="header">
                            <h5 v-if="title" class="modal-title">
                                {{ title }}
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </slot>
                    </div>
                </template>
                <template v-if="this.$slots.default">
                    <slot name="body">
                        <div class="modal-body">
                            <slot></slot>
                        </div>
                    </slot>
                </template>
                <template v-if="!!this.$slots.footer">
                    <div class="modal-footer">
                        <slot name="footer"></slot>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
        },
        size: {
            type: String,
        },
        fade: {
            type: Boolean,
        },
    },

    computed: {
        className() {
            return [
                "modal-dialog",
                { [`modal-${this.size}`]: this.size },
                { fade: this.fade },
            ];
        },
    },

    methods: {
        getOrCreateInstance() {
            return bootstrap.Modal.getOrCreateInstance(this.$refs.modal);
        },
        show() {
            this.getOrCreateInstance().show();
        },
        hide() {
            this.getOrCreateInstance().hide();
        },
        toggle() {
            this.getOrCreateInstance().toggle();
        },
    },
};
</script>
