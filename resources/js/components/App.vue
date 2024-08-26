<template>
    <header class="bg-blue-500 text-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Gestión de Tareas</h1>
            </div>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <router-link 
                            to="/categorias" 
                            class="hover:underline">
                            Categorías
                        </router-link>
                    </li>
                    <li>
                        <router-link 
                            to="/tareas" 
                            class="hover:underline">
                            Tareas
                        </router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <router-view></router-view>
</template>