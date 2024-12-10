<script setup>
import TextInput from "@/Components/TextInput.vue";
import UserListItem from "@/Components/app/UserListItem.vue";
import { ref, computed } from "vue";

const searchKeyword = ref("");

const props = defineProps({
  users: Array
});

const filteredUsers = computed(() => {
  if (!searchKeyword.value.trim()) {
    return props.users;
  }
  const keyword = searchKeyword.value.toLowerCase();
  return props.users.filter((user) =>
    user.name.toLowerCase().includes(keyword) || 
    user.username.toLowerCase().includes(keyword)
  );
});
</script>

<template>
  <!-- Champ de recherche -->
  <TextInput v-model="searchKeyword" placeholder="Tapez pour rechercher" class="w-full mt-3" />

  <!-- Liste des utilisateurs -->
  <div class="mt-3 h-[200px] lg:flex-1 overflow-auto">
    <div v-if="filteredUsers.length === 0" class="text-gray-400 text-center p-3">
      
    </div>

    <div v-else>
      <UserListItem v-for="user in filteredUsers" :key="user.id" :user="user" class="rounded-lg" />
    </div>
  </div>
</template>
