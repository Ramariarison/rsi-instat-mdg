<script setup>
import TextInput from "@/Components/TextInput.vue";
import GroupItem from "@/Components/app/GroupItem.vue";
import { PlusCircleIcon } from "@heroicons/vue/20/solid/index.js";
import { ref, computed } from "vue";
import GroupModal from "@/Components/app/GroupModal.vue";

const searchKeyword = ref("");
const showNewGroupModal = ref(false);

const props = defineProps({
  groups: Array
});

const filteredGroups = computed(() => {
  if (!searchKeyword.value.trim()) {
    return props.groups; // Retourne tous les groupes si aucun mot-clé
  }
  const keyword = searchKeyword.value.toLowerCase();
  return props.groups.filter((group) =>
    group.name.toLowerCase().includes(keyword)
  );
});

function onGroupCreate(group) {
  props.groups.unshift(group);
}
</script>

<template>
  <div class="flex gap-2 mt-3">
    <div class="flex items-center">
      <button
        @click="showNewGroupModal = true"
        class="flex items-center justify-center gap-1 text-sm bg-indigo-500 hover:bg-indigo-600 text-white rounded px-3 py-2.5"
      >
        <PlusCircleIcon class="w-5 h-5" />
      </button>
    </div>
    <TextInput v-model="searchKeyword" placeholder="Tapez pour rechercher" class="w-full" />
  </div>

  <div class="mt-3 h-[200px] lg:flex-1 overflow-auto">
    <!-- Message en cas d'absence de résultats -->
    <div v-if="filteredGroups.length === 0" class="text-gray-400 text-center p-3">

    </div>
    <div v-else>
      <GroupItem v-for="group in filteredGroups" :key="group.id" :group="group" />
    </div>
  </div>

  <GroupModal v-model="showNewGroupModal" @create="onGroupCreate" />
</template>