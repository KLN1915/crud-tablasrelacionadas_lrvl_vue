<script setup>
    import { onMounted, ref } from 'vue';
    import { useRouter } from 'vue-router';

    const router = useRouter()

    let categorias = ref([])

    onMounted(async () => {
        getCategories()
    })

    //create
    const newCategory = () => {
        router.push('/categorias/crear')
    }

    //read
    const getCategories = async () => {
        let response = await axios.get('/api/categorias')
        .then((response) => {
            categorias.value = response.data.categorias
        })
    }

    //update
    const onEdit = (id)=>{
        router.push(`/categorias/${id}/editar`)
    }

    //delete
    const deleteCategory = (id) => {
        axios.delete(`/api/categorias/${id}`)
        .then(()=>{
            getCategories()
        })
    }

</script>
<template>
    <div class="container mx-auto px-4 py-6">
    <!-- Título -->
    <h1 class="text-3xl font-bold mb-6 text-center">Gestión de Categorías</h1>

    <!-- Botón de agregar nueva tarea -->
    <div class="mb-4 text-right">
        <button @click="newCategory" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nueva Categoría
        </button>
    </div>

    <!-- Tabla de tareas -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left">ID</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left">Nombre</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fila de ejemplo de una tarea -->
                <tr class="hover:bg-gray-100" v-for="categoria in categorias" :key="categoria.id">
                    <td class="py-2 px-4 border-b border-gray-200">{{ categoria.id }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ categoria.nombre }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 flex space-x-2">
                        <!-- Botón de editar -->
                        <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-700" @click="onEdit(categoria.id)">
                            Editar
                        </button>
                        <!-- Botón de eliminar -->
                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700" @click="deleteCategory(categoria.id)">
                            Eliminar
                        </button>
                    </td>
                </tr>
                <!-- Repetir las filas para cada tarea -->
            </tbody>
        </table>
    </div>
</div>

</template>