<template>
  <Head title="Livres" />

  <breeze-authenticated-layout>
    <template #header>
      <h2 class="h4 font-weight-bold">
        Livres
      </h2>
    </template>
    <!-- Page content here -->
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3'

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
  },
}
</script>
