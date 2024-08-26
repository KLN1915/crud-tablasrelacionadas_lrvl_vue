<script setup>
    import { reactive, ref, onMounted } from 'vue';
    import { useRouter, useRoute } from 'vue-router';

    const form = reactive({
        titulo: '',
        descripcion: '',
        estado_completada: '',
        categoria_id: '',
    })

    const router = useRouter()

    const route = useRoute()

    const editMode = ref(false)

    //para el read del select
    let categorias = ref([])

    onMounted(async () => {
        getCategories()
    })

    //update
    // onMounted(() => {
    //     if(route.name === 'tasks.edit'){
    //         editMode.value = true
    //         getTask()
    //     }
    // })

    // const getTask = async () => {
    //     let response = await axios.get(`/api/tareas/${route.params.id}/editar`)
    //     .then((response) => {
    //         form.titulo = response.data.task.titulo,
    //         form.descripcion = response.data.task.descripcion,
    //         form.estado_completada = response.data.task.estado_completada,
    //         form.categoria_id = response.data.task.categoria_id
    //     })
    // }

    // const handleSave = (values, actions) => {
    //     if(editMode.value){
    //         updateTask(values, actions)
    //     }else{
    //         createTask(values,actions)
    //     }
    // }

    //create
    const createTask = (values, actions) => {
        axios.post('/api/tareas',form)
        .then((response)=>{
            router.push('/tareas')
        })
    }

    //read del select
    const getCategories = async () => {
        let response = await axios.get('/api/categorias')
        .then((response) => {
            categorias.value = response.data.categorias
        })
    }

    //update
    // const updateTask = (values, actions) => {
    //     axios.put(`/api/tareas/${route.params.id}`,form)
    //     .then((response)=>{
    //         router.push('/tareas')
    //     })
    // }

</script>
<template>  
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <!-- Título del formulario -->
        <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">
        <span v-if="editMode">Editar </span>
        <span v-else>Crear Nueva </span>Tarea</h2>

        <!-- Formulario de creación -->
        <div>
            <!-- Campo de nombre de la categoría -->
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre de la Tarea:</label>
                <input 
                    v-model="form.titulo"
                    type="text"
                    id="nombre"
                    name="nombre"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ingrese el nombre de la tarea"
                    required>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción:</label>
                <textarea
                    v-model="form.descripcion"
                    id="descripcion"
                    name="descripcion"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ingrese la descripción de la tarea"
                    required>
                </textarea>
            </div>

            <div class="mb-4">
                <label for="estado_completada" class="block text-gray-700 font-bold mb-2">Estado Completado:</label>
                <select
                    v-model="form.estado_completada"
                    id="estado_completada"
                    name="estado_completada"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="0">Pendiente</option>
                    <option value="1">Completada</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="categoria_id" class="block text-gray-700 font-bold mb-2">Categoría:</label>
                <select
                    v-model="form.categoria_id"
                    id="categoria_id"
                    name="categoria_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <!-- Los valores de las opciones deberían ser cargados dinámicamente -->
                    <option value="" disabled>Seleccione una categoría</option>
                    <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.nombre }}</option>
                </select>
            </div>


                <!-- Botón de enviar -->
            <div class="text-center">
                <button @click="createTask"
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Guardar Tarea
                </button>
            </div>
        </div>
    </div>

</template>