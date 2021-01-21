<template>
    <div>
        <h1 class="text-center">Listagem de Articulos</h1>
        <hr>

        <section v-if="errored">
            <p>Pedimos desculpas, não estamos conseguindo recuperar as informações no momento. Por favor, tente novamente mais tarde.</p>
        </section>

        <div v-if="loading">Carregando...</div>


        <!-- Button to Open the Modal -->
        <button @click="modificar=false; abrirModal()" type="button" class="btn btn-primary">
            Nuevo
        </button>

        <!-- The Modal -->
        <div class="modal" :class="{mostrar:modal}">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{tituloModal}}</h4>
                    <button @click="cerrarModal()" type="button" class="close">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div>
                        <label for="nombre">Nombre</label>
                        <input v-model="articulo.nombre" type="text" class="form-control" id="nombre">
                    </div>

                    <div>
                        <label for="descripcion">Descripcion</label>
                        <input v-model="articulo.descripcion" type="text" class="form-control" id="descripcion">
                    </div>

                    <div>
                        <label for="stock">Stock</label>
                        <input v-model="articulo.stock" type="number" class="form-control" id="stock">
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button @click="cerrarModal()" type="button" class="btn btn-secondary">Cancelar</button>
                    <button @click="guardar(); cerrarModal()" type="button" class="btn btn-success">Guardar</button>
                </div>

                </div>
            </div>
        </div>

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
                        <button @click="modificar=true; abrirModal(art)" class="btn btn-warning">Editar</button>
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

            articulo: {
                nombre: 'y',
                descripcion: 'x',
                stock: 1
            },
            id:0,
            modificar: true,
            modal: 0,
            tituloModal: '',
            articulos: [],
            loading: true,
            errored: false
        }
    },
    methods: {
        async listar () {
            const res=await axios.get('/articulos')
            .then(response => (this.articulos = response.data))
            .catch(error => (this.errored = true))
            .finally(() => this.loading = false);
        },
        async eliminar (id) {
            const res=await axios.delete('/articulos/' + id)
            .then(response => (this.listar()))
            .catch(error => (this.errored = true))
            .finally(() => this.loading = false);
        },
        async guardar() {
            if(this.modificar) {
                const res=await axios.put('articulos/' + this.id , this.articulo);
            } else {
               const res=await axios.post('articulos', this.articulo);
            }
            this.cerrarModal();
            this.listar();
        },
        abrirModal (data={}){
            this.modal = 1

            if(this.modificar){
                this.id=data.id;
                this.tituloModal = 'Modificar Articulo';
                this.articulo.nombre=data.nombre;
                this.articulo.descripcion=data.descripcion;
                this.articulo.stock=data.stock;
            } else {
                this.id=0;
                this.tituloModal = 'Criar Articulo';
                this.articulo.nombre='';
                this.articulo.descripcion='';
                this.articulo.stock=1;
            }
        },
        cerrarModal (){
            this.modal = 0
        }
    },
    created() {
        this.listar();
    }
}
</script>

<style>
.mostrar{
    display: list-item;
    opacity: 1;
    background: rgb(120, 38, 141);
}
</style>
