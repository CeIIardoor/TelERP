<template>
  <Head title="Organisation" />
  <AuthenticatedLayout>
    <template #header>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajouter un organisation
            </h2>
        </div>
    </template>
    <div class="container pt-4 m-auto">
        <div class="overflow-x-auto relative min-w-full shadow-lg sm:rounded-lg">
            <div class="flex justify-between items-center p-4 bg-white dark:bg-gray-800">
                 <form id="organisation_form" class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <div class="p-6 space-y-6">
              <div class="grid grid-cols-12 gap-12">
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="prenom"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Prenom</label
                  >
                  <input
                    id="prenom"
                    type="text"
                    name="prenom"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Prénom"
                    required=""

                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="nom"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Nom</label
                  >
                  <input
                    type="text"
                    name="nom"
                    id="nom"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Nom"
                    required=""

                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="n_client"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >N° client</label
                  >
                  <input
                    type="text"
                    name="n_client"
                    id="n_client"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Numéro client"
                    required=""
                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="CIN"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >CIN</label
                  >
                  <input
                    type="text"
                    name="CIN"
                    id="CIN"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="CIN"
                    required=""

                  />
                </div>
                 <div class="col-span-6 sm:col-span-3">
                  <label
                    for="ville"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Ville</label
                  >
                  <input
                    type="text"
                    name="ville"
                    id="ville"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Ville"

                  />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="derniere_affectation"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Derniere affectation</label
                  >
                  <input
                    type="text"
                    name="derniere_affectation"
                    id="derniere_affectation"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Derniere Affectaion"

                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="dernier_grade"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Dernier Grade</label
                  >
                  <input
                    type="text"
                    name="dernier_grade"
                    id="dernier_grade"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Dernier Grade"

                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="gestionnaire"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Gestionnaire</label
                  >
                  <input
                    type="text"
                    name="gestionnaire"
                    id="gestionnaire"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Gestionnaire"

                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="derniere_province"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Derniere_province</label
                  >
                  <input
                    type="text"
                    name="derniere_province"
                    id="derniere_province"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Dernière province"
                  />
                </div>
            <div class="col-span-3 sm:col-span-9">
                  <label
                    for="organisation_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Organisation</label
                  >
                  <select
                    name="organisation_id"
                    id="organisation_id"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Organisation"
                    required=""
                  >
                    <option disabled selected>Choisir une organisation</option>
                    <option
                    v-for="org in orgs"
                    :key="org.id"
                    :value=org.id
                    >
                    {{ org.intitule }}
                    </option>
                    </select>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div
              class="flex items-center flex-row-reverse p-6 space-x-1 rounded-b border-t border-gray-200 dark:border-gray-600"
            >
              <button
                type="submit"
                @click.prevent="create_organisation()"
                class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800"
              >
                Créer
              </button>
            </div>
          </form>
            </div>
        </div>
  </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Inertia } from "@inertiajs/inertia";
import { useFlash } from "@/Composables/useFlash";
let { flash } = useFlash();

const props = defineProps({
  orgs: Object,
});

function create_organisation() {
    let form = document.getElementById("organisation_form");
    let formData = new FormData(form);
    let data = {};
    for (let entry of formData.entries()) {
        data[entry[0]] = entry[1];
    }
    Inertia.post("/organisation/store", data, { preserveState: true, replace: true, onSuccess: () => {
        flash('Parfait !', 'Organisation créé avec succès', 'success');
    }});
}

</script>
