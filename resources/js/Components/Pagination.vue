<template>
  <div>
    <Component
      :is="link.url ? 'Link' : 'span'"
      v-for="link in links"
      :key="link.url"
      :href="link.url"
      class="px-1"
      :class="{ 'text-gray-500': ! link.url, 'font-bold' : link.active }"
      v-html="link.label"
    />
  </div>
</template>

<script>
export default {
  props: {
    links: Array
  }
};
</script>
