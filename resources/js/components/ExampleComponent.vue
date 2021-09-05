<template>
    <div class="card">
        <div class="card-header">Componente Vue.js de ejemplo</div>

        <div class="card-body">
            <p>
                Hola, soy un componente Vue.js de ejemplo, esto es lo que
                ingresaste en el input: {{ text }}
            </p>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">
                    Ingresá un valor:
                </label>
                <input type="text" class="form-control" v-model="text" />
                <div id="emailHelp" class="form-text">
                    Lo que escribas acá se va a ver arriba
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        text: {
            type: String,
            default: "Valor por defecto",
        },
    },
    mounted() {
        console.log("Component mounted.");
    },
};
</script>
