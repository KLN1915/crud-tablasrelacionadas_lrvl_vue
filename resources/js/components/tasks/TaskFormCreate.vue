<script setup>
import { reactive, ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const form = reactive({
    titulo: '',
    descripcion: '',
    estado_completada: '',
    categoria_id: '',
});

const router = useRouter();
const route = useRoute();

const editMode = ref(false);

// para el read del select
const categorias = ref([]);

onMounted(async () => {
    // Cargar las categorías
    await getCategories();

    // Si estamos en modo edición, cargar la tarea
    if(route.name === 'tasks.edit'){
        editMode.value = true;
        await getTask();
    }
});

const getTask = async () => {
    try {
        let response = await axios.get(`/api/tareas/${route.params.id}/editar`);
        form.titulo = response.data.task.titulo;
        form.descripcion = response.data.task.descripcion;
        form.estado_completada = response.data.task.estado_completada;
        form.categoria_id = response.data.task.categoria_id;
    } catch (error) {
        console.error("Error al obtener la tarea:", error);
    }
};

const handleSave = () => {
    if(editMode.value){
        updateTask();
    } else {
        createTask();
    }
};

// create
const createTask = async () => {
    try {
        await axios.post('/api/tareas', form);
        router.push('/tareas');
    } catch (error) {
        console.error("Error al crear la tarea:", error);
    }
};

// read del select
const getCategories = async () => {
    try {
        let response = await axios.get('/api/categorias');
        categorias.value = response.data.categorias;
    } catch (error) {
        console.error("Error al obtener las categorías:", error);
    }
};

// update
const updateTask = async () => {
    try {
        await axios.put(`/api/tareas/${route.params.id}`, form);
        router.push('/tareas');
    } catch (error) {
        console.error("Error al actualizar la tarea:", error);
    }
};

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
                    <option value="" disabled>Seleccione una categoría</option>
                    <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.nombre }}</option>
                </select>
            </div>

            <!-- Botón de enviar -->
            <div class="text-center">
                <button @click="handleSave"
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Guardar Tarea
                </button>
            </div>
        </div>
    </div>

</template>
