<template>
  <Head title="Abonnement" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Annuaire abonnements
        </h2>
        <Link
          v-if="$attrs.auth.user.role == 'Administrateur'"
          :href="route('corbeille.abonnement')"
          class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
        >
          <h4>Corbeille</h4>
        </Link>
      </div>
    </template>
    <div class="container pt-4 m-auto">
      <div class="overflow-x-auto relative max-w-full shadow-lg sm:rounded-lg">
        <div class="flex justify-between items-center p-4 bg-white dark:bg-gray-800">
          <div class="flex gap-2">
            <Link
              href="/abonnement/create"
              class="text-green-500 hover:text-green-700 text-sm ml-3"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </Link>
            Ajouter un abonnement
          </div>
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
              v-for="abonnement in $page.props.abonnements.data"
              :key="abonnement.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
              <th
                scope="row"
                class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white"
              >
                <div class="pl-3">
                  <div class="text-base font-semibold">
                    {{ abonnement.nom }} {{ abonnement.prenom }}
                  </div>
                  <div class="font-normal text-gray-500">{{ abonnement.CIN }}</div>
                </div>
              </th>
              <td class="py-4 px-6">
                <div class="flex items-center">
                  {{ abonnement.ville }}
                </div>
              </td>
              <td class="py-4 px-6">
                <div class="text-base font-semibold">
                  {{ abonnement.organisation.intitule }}
                </div>
                <div class="font-normal text-gray-500">
                  {{ abonnement.organisation.sigle }}
                </div>
              </td>
              <td class="py-4 px-6">
                <div class="flex items-center">
                  {{ abonnement.n_client }}
                </div>
              </td>
              <td class="md:flex h-4 w-4">
                <Link
                  :href="`/abonnement/${abonnement.id}/factures`"
                  class="text-green-600 hover:text-green-900"
                >
                  Factures
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                  </svg>
                </Link>
                <!-- Modal toggle -->
                <a
                  href="#"
                  type="button"
                  @click="openModal(abonnement)"
                  data-modal-toggle="editUserModal"
                  class="font-medium text-emerald-600 dark:text-emerald-500 hover:underline"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-blue-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                    />
                  </svg>
                </a>
                <!-- Delete record -->
                <Link
                  :href="`/abonnement/${abonnement.id}/delete`"
                  class="text-red-600 hover:text-red-900"
                >
                  <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    ></path>
                  </svg>
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
        <Pagination
          :links="abonnements.links"
          class="p-4 mx-auto text-gray-700 bg-white text-center"
        />
        <!-- Edit user modal -->
        <div
          v-if="!closed"
          id="editUserModal"
          tabindex="-1"
          class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center p-4 w-full md:inset-0 h-modal md:h-full flex"
          aria-modal="true"
          role="dialog"
        >
          <div class="relative w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <form
              id="abonnement_form"
              class="relative bg-white rounded-lg shadow dark:bg-gray-700"
            >
              <!-- Modal header -->
              <div
                class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600"
              >
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                  Éditer
                </h3>
                <button
                  type="button"
                  @click="closeModal()"
                  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                  data-modal-toggle="editUserModal"
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
                    <input
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
                    <input
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
                    <input
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
                    <input
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
                    <input
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
                    <input
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
                    <input
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
                    <input
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
                    <input
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
                    <select
                      name="organisation_id"
                      id="organisation_id"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="Organisation"
                      required=""
                    >
                      <option disabled>Choisir une organisation</option>
                      <option
                        v-for="org in orgs"
                        :key="org.id"
                        :selected="org.id === modal_data.organisation.id"
                        :value="org.id"
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
                  @click.prevent="update_abonnement(modal_data.id)"
                  class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800"
                >
                  Mettre à jour
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div
      v-hide-toast
      v-if="$attrs.flash.success && toasted"
      id="toast-bottom-right"
      class="flex justify-evenly fixed right-5 bottom-5 items-center p-4 space-x-4 w-full max-w-xs text-gray-500 bg-white rounded-lg divide-x divide-gray-200 shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
      role="alert"
    >
      <div
        class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200"
      >
        <svg
          aria-hidden="true"
          class="w-5 h-5"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
            clip-rule="evenodd"
          ></path>
        </svg>
        <span class="sr-only">Check icon</span>
      </div>
      <div class="text-sm pl-2 font-normal">{{ $attrs.flash.success }}</div>
      <button
        @click="closeToast"
        type="button"
        class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        data-dismiss-target="#toast-success"
        aria-label="Close"
      >
        <span class="sr-only">Close</span>
        <svg
          aria-hidden="true"
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
    <div
      v-hide-toast
      v-if="$attrs.flash.error && toasted"
      id="toast-bottom-right"
      class="flex justify-evenly fixed right-5 bottom-5 items-center p-4 space-x-4 w-full max-w-xs text-gray-500 bg-white rounded-lg divide-x divide-gray-200 shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
      role="alert"
    >
      <div
        class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200"
      >
        <svg
          aria-hidden="true"
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
        <span class="sr-only">Error icon</span>
      </div>
      <div class="pl-4 text-sm font-normal">{{ $attrs.flash.error }}</div>
      <button
        @click="closeToast"
        type="button"
        class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        data-dismiss-target="#toast-danger"
        aria-label="Close"
      >
        <span class="sr-only">Close</span>
        <svg
          aria-hidden="true"
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
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
  abonnements: Object,
  filters: Object,
  orgs: Object,
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
  },
};

function openModal(abonnement) {
  closed.value = false;
  modal_data.value = abonnement;
}

function closeModal() {
  closed.value = true;
  modal_data.value = null;
}

watch(
  search,
  debounce(function (value) {
    Inertia.get("/abonnement", { search: value }, { preserveState: true, replace: true });
  }, 300)
);

function update_abonnement(id) {
  let form = document.getElementById("abonnement_form");
  let formData = new FormData(form);
  let data = {};
  for (let entry of formData.entries()) {
    data[entry[0]] = entry[1];
  }
  Inertia.post("/abonnement/" + id, data, { preserveState: true, replace: true });
  closed.value = true;
  toasted.value = true;
}
</script>
