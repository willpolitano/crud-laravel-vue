<template>
    <div>
        <h1 class="text-center">Listagem de Articulos</h1>
        <hr>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Stock</th>
                    <th scope="col" colspan="2" class="texte-center">Accion</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="art in articulos" :key="art.id">
                    <th scope="row"> {{ art.id }} </th>
                    <td> {{ art.nombre }} </td>
                    <td> {{ art.descripcion }} </td>
                    <td> {{ art.stock }} </td>
                    <td>
                        <button class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(art.id)" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
export default {
    data() {
        return {
            articulos: [],
        }
    },
    methods: {
        async listar (){
            const res=await axios.get('/articulos');
            this.articulos = res.data;
        },
        async eliminar (id){
            const res=await axios.delete('/articulos/' + id);
            this.listar();
        }
    },
    created() {
        this.listar();
    }
}
</script>

<style>

</style>
