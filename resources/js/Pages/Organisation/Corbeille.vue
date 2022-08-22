<template>
  <Head title="Organisation" />
  <AuthenticatedLayout>
    <template #header>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Corbeille organisations
            </h2>
        </div>
    </template>
    <div class="container pt-4 m-auto">
    <div class="overflow-x-auto relative max-w-full shadow-lg sm:rounded-lg">
      <div class="flex justify-between items-center p-4 bg-white dark:bg-gray-800">

        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
          <div
            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
          >
            <svg
              class="w-5 h-5 text-gray-500 dark:text-gray-400"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </div>
          <input
            v-model="search"
            type="text"
            id="table-search-users"
            class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
            placeholder="Rechercher"
          />
        </div>
      </div>
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="py-3 px-6">Nom Complet</th>
            <th scope="col" class="py-3 px-6">Ville</th>
            <th scope="col" class="py-3 px-6">Organisation</th>
            <th scope="col" class="py-3 px-6">N<sup>o</sup> Client</th>
            <th scope="col" class="py-3 px-6">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="organisation in $page.props.organisations.data" :key="organisation.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          >
            <th
              scope="row"
              class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white"
            >
              <div class="pl-3">
                <div class="text-base font-semibold">{{organisation.nom}} {{organisation.prenom}}</div>
                <div class="font-normal text-gray-500">{{organisation.CIN}}</div>
              </div>
            </th>
            <td class="py-4 px-6">
              <div class="flex items-center">
                {{organisation.ville}}
              </div>
            </td>
            <td class="py-4 px-6">
              <div class="text-base font-semibold">{{organisation.organisation.intitule}}</div>
                <div class="font-normal text-gray-500">{{organisation.organisation.sigle}}</div>
            </td>
            <td class="py-4 px-6">
              <div class="flex items-center">
                {{organisation.n_client}}
              </div>
            </td>
            <td class="md:flex h-4 w-4">
              <!-- Modal toggle -->
              <button
                type="button"
                @click="openModal(organisation)"
                data-modal-toggle="viewUserModal"
                class="font-medium text-emerald-600 dark:text-emerald-500 hover:underline"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                </button>
                <Link
                    :href="'/corbeille/organisation/' + organisation.id + '/restore'"
                    class="text-blue-600 hover:text-blue-900"
                >
               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                </Link>

                <!-- destroy record -->
               <Link
                    :href="'/corbeille/organisation/'+ organisation.id +'/destroy'"
                    class="text-red-600 hover:text-red-900"
                >
               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                </Link>
            </td>
          </tr>
        </tbody>
      </table>
          <Pagination :links="organisations.links" class="p-4 mx-auto text-gray-700 bg-white text-center" />
      <!-- View user modal -->
      <div
        v-if="!closed"
        id="viewUserModal"
        tabindex="-1"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center p-4 w-full md:inset-0 h-modal md:h-full flex"
        aria-modal="true"
        role="dialog"
      >
        <div class="relative w-full max-w-2xl h-full md:h-auto">
          <!-- Modal content -->
          <form id="organisation_form" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
              class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600"
            >
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Détails
              </h3>
              <button
                type="button"
                @click="closeModal()"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="viewUserModal"
              >
                <svg
                  class="w-5 h-5"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
              <div class="grid grid-cols-9 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="prenom"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Prenom</label
                  >
                  <input readonly
                    id="prenom"
                    type="text"
                    name="prenom"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Prénom"
                    required=""
                    :value="modal_data.prenom"
                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="nom"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Nom</label
                  >
                  <input readonly
                    type="text"
                    name="nom"
                    id="nom"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Nom"
                    required=""
                    :value="modal_data.nom"
                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="n_client"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >N° client</label
                  >
                  <input readonly
                    type="text"
                    name="n_client"
                    id="n_client"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="N_client"
                    required=""
                    :value="modal_data.n_client"
                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="CIN"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >CIN</label
                  >
                  <input readonly
                    type="text"
                    name="CIN"
                    id="CIN"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="CIN"
                    required=""
                    :value="modal_data.CIN"
                  />
                </div>
                 <div class="col-span-6 sm:col-span-3">
                  <label
                    for="ville"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Ville</label
                  >
                  <input readonly
                    type="text"
                    name="ville"
                    id="Ville"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="ville"
                    :value="modal_data.ville"
                  />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="derniere_affectation"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Derniere affectation</label
                  >
                  <input readonly
                    type="text"
                    name="derniere_affectation"
                    id="derniere_affectation"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Derniere Affectaion"
                    :value="modal_data.derniere_affectation"
                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="dernier_grade"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Dernier Grade</label
                  >
                  <input readonly
                    type="text"
                    name="dernier_grade"
                    id="dernier_grade"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Dernier Grade"
                    :value="modal_data.dernier_grade"
                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="gestionnaire"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Gestionnaire</label
                  >
                  <input readonly
                    type="text"
                    name="gestionnaire"
                    id="gestionnaire"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Gestionnaire"
                    :value="modal_data.gestionnaire"
                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label
                    for="derniere_province"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Derniere_province</label
                  >
                  <input readonly
                    type="text"
                    name="derniere_province"
                    id="derniere_province"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Dernière province"
                    :value="modal_data.derniere_province"
                  />
                </div>
                <div class="col-span-6 sm:col-span-9">
                  <label
                    for="organisation_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Organisation</label
                  >
                  <input readonly
                    type="text"
                    name="gestionnaire"
                    id="gestionnaire"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                    placeholder="Gestionnaire"
                    :value="modal_data.organisation.intitule"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div v-hide-toast v-if="$attrs.flash.success && toasted" id="toast-bottom-right" class="flex justify-evenly fixed right-5 bottom-5 items-center p-4 space-x-4 w-full max-w-xs text-gray-500 bg-white rounded-lg divide-x divide-gray-200 shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Check icon</span>
        </div>
        <div class="text-sm pl-2 font-normal">{{$attrs.flash.success}}</div>
        <button @click="closeToast" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
    <div v-hide-toast v-if="$attrs.flash.error && toasted" id="toast-bottom-right" class="flex justify-evenly fixed right-5 bottom-5 items-center p-4 space-x-4 w-full max-w-xs text-gray-500 bg-white rounded-lg divide-x divide-gray-200 shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="pl-4 text-sm font-normal">{{$attrs.flash.error}}</div>
            <button  @click="closeToast" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
    </div>

  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
  organisations: Object,
  filters: Object
});

let closed = ref(true);
let toasted = ref(true);
let modal_data = ref(null);
let search = ref(props.filters.search);

function closeToast() {
    toasted.value = false;
}

const vHideToast = {
  mounted: (el) => {
    setTimeout(() => {
      closeToast();
    }, 3000);
  }
}

function openModal(organisation) {
closed.value = false;
modal_data.value = organisation;
}

function closeModal() {
closed.value = true;
modal_data.value = null;
}

watch(search, debounce(function (value) {
    Inertia.get("/corbeille/organisation/", { search: value }, { preserveState: true, replace: true });
}, 300));

</script>
