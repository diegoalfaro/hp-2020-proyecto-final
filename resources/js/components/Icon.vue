<template>
    <i :class="['fas', `fa-${name}`]"></i>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
        },
    },
};
</script>
