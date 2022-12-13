<script setup>
import { Link } from "@inertiajs/inertia-vue3";
defineProps({
  links: Array
});
</script>

<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap justify-end mt-6">
      <template v-for="(link, key) in links" :key="key">
        <div v-if="link.url === null" class="mb-1 mr-1 px-4 py-3 text-slate-400 text-sm leading-4 border rounded"
          v-html="link.label" />
        <Link v-else :key="`link-${key}`"
          class="mb-1 mr-1 px-4 py-3 text-sm leading-4 transition-all focus:text-white focus:bg-tertiary-400 border focus:border-tertiary-400 rounded-md"
          :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div>
</template>
