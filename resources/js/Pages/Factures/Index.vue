<template>
  <Head title="Facture" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Factures de l'abonnement : {{ $page.props.abonnement.n_client }} |
          {{ $page.props.abonnement.nom }} {{ $page.props.abonnement.prenom }}
        </h2>
      </div>
    </template>
    <div class="container pt-4 m-auto">
      <div class="overflow-x-auto relative max-w-full shadow-lg sm:rounded-lg">
        <div class="flex justify-between items-center p-4 bg-white dark:bg-gray-800">
          <div class="flex gap-2">
            <Link
              href="/facture/create"
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
                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                />
              </svg>
            </Link>
            Importer une facture
          </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="py-3 px-6">F_CUSTCODE</th>
              <th scope="col" class="py-3 px-6">Date</th>
              <th scope="col" class="py-3 px-6">Ref Facture</th>
              <th scope="col" class="py-3 px-6">Statut</th>
              <th scope="col" class="py-3 px-6">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="facture in $page.props.factures.data"
              :key="facture.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
              <th
                scope="row"
                class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white"
              >
                <div class="pl-3">
                  <div class="text-base font-semibold">
                    {{ facture.F_CUSTCODE }}
                  </div>
                  <div class="font-normal text-gray-500">
                    {{ abonnement.nom }} {{ abonnement.prenom }}
                  </div>
                </div>
              </th>
              <td class="py-4 px-6">
                <div class="flex items-center">
                  {{ facture.date }}
                </div>
              </td>
              <td class="py-4 px-6">
                <div class="text-base font-semibold">{{ facture.REF_FACT }}</div>
                <div class="font-normal text-gray-500">{{ facture.CMOTIF_RS }}</div>
              </td>
              <td class="py-4 px-6">
                <div class="flex items-center">
                  <div class="flex items-center">
                    <div
                      v-if="facture.statut == 'Payée'"
                      class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"
                    ></div>
                    <div
                      v-if="facture.statut == 'En attente'"
                      class="h-2.5 w-2.5 rounded-full bg-orange-400 mr-2"
                    ></div>
                    <div
                      v-if="facture.statut == 'Non payée'"
                      class="h-2.5 w-2.5 rounded-full bg-red-400 mr-2"
                    ></div>
                    {{ facture.statut }}
                  </div>
                </div>
              </td>
              <td class="md:flex h-4 w-4">
                <Link
                  :href="'/facture/' + facture.id + '/download'"
                  class="text-blue-500 hover:text-blue-700 text-sm ml-3"
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
                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                  </svg>
                </Link>
                <!-- Modal toggle -->
                <a
                  href="#"
                  type="button"
                  @click="openModal(facture)"
                  data-modal-toggle="editUserModal"
                  class="font-medium text-green-600 dark:text-green-500 hover:underline"
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
                      d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"
                    />
                  </svg>
                </a>

                <!-- Delete record -->
                <Link
                  :href="`/facture/${facture.id}/destroy`"
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
          :links="factures.links"
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
              id="facture_form"
              class="relative bg-white rounded-lg shadow dark:bg-gray-700"
            >
              <!-- Modal header -->
              <div
                class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600"
              >
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                  Détails de la facture
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
                      for="date"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Date</label
                    >
                    <input
                      readonly
                      id="date"
                      type="text"
                      name="date"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="Prénom"
                      required=""
                      :value="modal_data.date"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="montant_supplementaire"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Montant_supplementaire</label
                    >
                    <input
                      readonly
                      type="text"
                      name="montant_supplementaire"
                      id="montant_supplementaire"
                      placeholder="Montant supplementaire"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      required=""
                      :value="modal_data.montant_supplementaire"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="echeance"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Echéance</label
                    >
                    <input
                      readonly
                      type="text"
                      name="echeance"
                      id="echeance"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="Echeance"
                      required=""
                      :value="modal_data.echeance"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="statut"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >statut</label
                    >
                    <input
                      readonly
                      type="text"
                      name="statut"
                      id="statut"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="statut"
                      required=""
                      :value="modal_data.statut"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="F_OHXACT"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >F_OHXACT</label
                    >
                    <input
                      readonly
                      type="text"
                      name="F_OHXACT"
                      id="F_OHXACT"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="F_OHXACT"
                      :value="modal_data.F_OHXACT"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="F_CUSTCODE"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >F_CUSTCODE</label
                    >
                    <input
                      readonly
                      type="text"
                      name="F_CUSTCODE"
                      id="F_CUSTCODE"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="F_CUSTCODE"
                      :value="modal_data.F_CUSTCODE"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="DOHA"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >DOHA</label
                    >
                    <input
                      readonly
                      type="text"
                      name="DOHA"
                      id="DOHA"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="DOHA"
                      :value="modal_data.DOHA"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="ND_SUP"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >ND_SUP</label
                    >
                    <input
                      readonly
                      type="text"
                      name="ND_SUP"
                      id="ND_SUP"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="ND_SUP"
                      :value="modal_data.ND_SUP"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="LOGIN"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >LOGIN</label
                    >
                    <input
                      readonly
                      type="text"
                      name="LOGIN"
                      id="LOGIN"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="Login"
                      :value="modal_data.LOGIN"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="REF_FACT"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >REF_FACT</label
                    >
                    <input
                      readonly
                      type="text"
                      name="REF_FACT"
                      id="REF_FACT"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="REF_FACT"
                      :value="modal_data.REF_FACT"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="PRODUIT"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >PRODUIT</label
                    >
                    <input
                      readonly
                      type="text"
                      name="PRODUIT"
                      id="PRODUIT"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="Produit"
                      :value="modal_data.PRODUIT"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="PL_TAR"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >PL_TAR</label
                    >
                    <input
                      readonly
                      type="text"
                      name="PL_TAR"
                      id="PL_TAR"
                      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                      placeholder="PL_TAR"
                      :value="modal_data.PL_TAR"
                    />
                  </div>
                </div>
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
  abonnement: Object,
  factures: Object,
});

let closed = ref(true);
let toasted = ref(true);
let modal_data = ref(null);

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

function openModal(facture) {
  closed.value = false;
  modal_data.value = facture;
}

function closeModal() {
  closed.value = true;
  modal_data.value = null;
}

function update_facture(id) {
  let form = document.getElementById("facture_form");
  let formData = new FormData(form);
  let data = {};
  for (let entry of formData.entries()) {
    data[entry[0]] = entry[1];
  }
  Inertia.post("/facture/" + facture.id + "/edit", data, {
    preserveState: true,
    replace: true,
  });
  closed.value = true;
  toasted.value = true;
}
</script>
