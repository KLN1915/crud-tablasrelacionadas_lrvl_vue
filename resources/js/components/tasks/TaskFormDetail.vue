<script setup>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const tarea = ref(null);
const router = useRouter();
const route = useRoute();

onMounted(async () => {
    getTaskDetail();
});

const getTaskDetail = async () => {
    let response = await axios.get(`/api/tareas/${route.params.id}`);
    tarea.value = response.data.task;
};


//delete
const deleteTask = (id) => {
        axios.delete(`/api/tareas/${id}`)
        .then(()=>{
            indexTasks()
        })
    }

//redirigir a tareas inicio
const indexTasks = () => {
        router.push('/tareas')
    }

</script>

<template>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">Detalle de la Tarea</h2>
        
        <div v-if="tarea" class="space-y-4">
            <div>
                <h3 class="text-lg font-semibold">Título:</h3>
                <p>{{ tarea.titulo }}</p>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold">Descripción:</h3>
                <p>{{ tarea.descripcion }}</p>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold">Estado:</h3>
                <p>{{ tarea.estado_completada ? 'Completada' : 'Pendiente' }}</p>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold">Categoría:</h3>
                <p>{{ tarea.categoria.nombre }}</p>
            </div>
            
            <div class="text-center">
                <button @click="deleteTask(tarea.id)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                    Eliminar Tarea
                </button>
            </div>
        </div>
        
        <div v-else>
            <p class="text-center">Cargando los detalles de la tarea...</p>
        </div>
    </div>
</template>
