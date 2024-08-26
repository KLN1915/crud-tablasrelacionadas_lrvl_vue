<script setup>
    import { onMounted, ref } from 'vue';
    import { useRouter } from 'vue-router';

    const router = useRouter()

    let tareas = ref([])

    onMounted(async () => {
        getTasks()
    })

    //redirigir a tareas/crear
    const newTarea = () => {
        router.push('/tareas/crear')
    }

    //read
    const getTasks = async () => {
        let response = await axios.get('/api/tareas')
        .then((response) => {
            tareas.value = response.data.tareas
        })
    }

</script>
<template>
    <div class="container mx-auto px-4 py-6">
    <!-- Título -->
    <h1 class="text-3xl font-bold mb-6 text-center">Gestión de Tareas</h1>

    <!-- Botón de agregar nueva tarea -->
    <div class="mb-4 text-right">
        <button @click="newTarea" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nueva Tarea
        </button>
    </div>

    <!-- Tabla de tareas -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left">ID</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left">Tarea</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left">Estado</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fila de ejemplo de una tarea -->
                <tr class="hover:bg-gray-100" v-for="tarea in tareas" :key="tarea.id">
                    <td class="py-2 px-4 border-b border-gray-200">{{ tarea.id }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ tarea.titulo }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ tarea.estado_completada === 1 ? 'COMPLETADO' : 'PENDIENTE' }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 flex space-x-2">
                        <!-- Botón de eliminar -->
                        <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-700">
                            Detalle
                        </button>
                        <!-- Botón de editar -->
                        <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-700">
                            Editar
                        </button>
                        
                    </td>
                </tr>
                <!-- Repetir las filas para cada tarea -->
            </tbody>
        </table>
    </div>
</div>

</template>