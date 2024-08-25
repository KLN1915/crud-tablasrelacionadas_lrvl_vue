<script setup>
    import { reactive, ref, onMounted } from 'vue';
    import { useRouter, useRoute } from 'vue-router';

    const form = reactive({
        nombre: '',
    })

    const router = useRouter()

    const route = useRoute()

    const editMode = ref(false)

    //update
    onMounted(() => {
        if(route.name === 'categories.edit'){
            editMode.value = true
            getCategory()
        }
    })

    const getCategory = async () => {
        let response = await axios.get(`/api/categorias/${route.params.id}/editar`)
        .then((response) => {
            form.nombre = response.data.category.nombre
        })
    }

    const handleSave = (values, actions) => {
        if(editMode.value){
            updateCategory(values, actions)
        }else{
            createCategory(values,actions)
        }
    }

    //create
    const createCategory = (values, actions) => {
        axios.post('/api/categorias',form)
        .then((response)=>{
            router.push('/categorias')
        })
    }

    //update
    const updateCategory = (values, actions) => {
        axios.put(`/api/categorias/${route.params.id}`,form)
        .then((response)=>{
            router.push('/categorias')
        })
    }

</script>
<template>  
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <!-- Título del formulario -->
    <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">
        <span v-if="editMode">Editar </span>
        <span v-else>Crear Nueva </span>Categoría</h2>

    <!-- Formulario de creación -->
    <div>
        <!-- Campo de nombre de la categoría -->
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre de la Categoría:</label>
            <input 
                type="text" 
                v-model="form.nombre"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ingrese el nombre de la categoría"
                required>
        </div>

        <!-- Botón de enviar -->
        <div class="text-center">
            <button @click="handleSave"
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar Categoría
            </button>
        </div>
    </div>
</div>

</template>