<template>
  <div>
    <Head :title="form.name" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/abonnements">Abonnements</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="abonnement.deleted_at" class="mb-6" @restore="restore"> This abonnement has been deleted. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
          <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
          <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Address" />
          <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2" label="City" />
          <text-input v-model="form.region" :error="form.errors.region" class="pb-8 pr-6 w-full lg:w-1/2" label="Province/State" />
          <select-input v-model="form.country" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2" label="Country">
            <option :value="null" />
            <option value="CA">Canada</option>
            <option value="US">United States</option>
          </select-input>
          <text-input v-model="form.postal_code" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Postal code" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!abonnement.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Abonnement</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Abonnement</loading-button>
        </div>
      </form>
    </div>
    <h2 class="mt-12 text-2xl font-bold">Collaborateurs</h2>
    <div class="mt-6 bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Name</th>
          <th class="pb-4 pt-6 px-6">City</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Phone</th>
        </tr>
        <tr v-for="collaborateur in abonnement.collaborateurs" :key="collaborateur.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/collaborateurs/${collaborateur.id}/edit`">
              {{ collaborateur.name }}
              <icon v-if="collaborateur.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/collaborateurs/${collaborateur.id}/edit`" tabindex="-1">
              {{ collaborateur.city }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/collaborateurs/${collaborateur.id}/edit`" tabindex="-1">
              {{ collaborateur.phone }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/collaborateurs/${collaborateur.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="abonnement.collaborateurs.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No collaborateurs found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    abonnement: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: this.abonnement.name,
        email: this.abonnement.email,
        phone: this.abonnement.phone,
        address: this.abonnement.address,
        city: this.abonnement.city,
        region: this.abonnement.region,
        country: this.abonnement.country,
        postal_code: this.abonnement.postal_code,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/abonnements/${this.abonnement.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this abonnement?')) {
        this.$inertia.delete(`/abonnements/${this.abonnement.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this abonnement?')) {
        this.$inertia.put(`/abonnements/${this.abonnement.id}/restore`)
      }
    },
  },
}
</script>
