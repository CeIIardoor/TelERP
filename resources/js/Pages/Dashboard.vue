<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { useFlash } from '@/Composables/useFlash';

let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };

let currentDate = $ref(new Date().toLocaleDateString("fr-FR", options));

setInterval(() => {
    currentDate = new Date().toLocaleDateString("fr-FR", options);
}, 1000);

let { flash } = useFlash();

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ currentDate }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Statisqtiques du mois courant
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <button @click="flash('Sucess!','body text', 'success')">success | &nbsp;</button>
                        <button @click="flash('Warning','body text', 'warning')">warning | &nbsp;</button>
                        <button @click="flash('Info','body text', 'info')">info | &nbsp;</button>
                        <button @click="flash('Error','body text', 'error')">error | &nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
