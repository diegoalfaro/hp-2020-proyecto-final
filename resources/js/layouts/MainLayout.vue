<template>
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 v-if="title">{{ title }}</h1>
                <slot></slot>
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
    },
};
</script>
