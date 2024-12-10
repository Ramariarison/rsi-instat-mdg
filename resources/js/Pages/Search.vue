<script setup>
import UserListItem from "@/Components/app/UserListItem.vue";
import GroupItem from "@/Components/app/GroupItem.vue";
import PostList from "@/Components/app/PostList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    search: String,
    users: Array,
    groups: Array,
    posts: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <!-- Confinement dans l'écran -->
        <div class="p-4 bg-gray-100 min-h-screen max-h-screen overflow-y-auto">
            <!-- Conteneur centralisé avec largeur ajustée -->
            <div class="max-w-4xl mx-auto w-full">
                <!-- Utilisateurs et Groupes -->
                <div v-if="!search.startsWith('#')" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Utilisateurs -->
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-4">
                        <h2 class="underline text-lg font-bold text-black flex items-center">
                            <i class="fas fa-user-friends mr-2"></i> Utilisateurs
                        </h2>
                        <div class="mt-2 max-h-64 overflow-y-auto">
                            <template v-if="users.length">
                                <UserListItem v-for="user of users" :key="user.id" :user="user" />
                            </template>
                            <div v-else class="py-4 text-center text-gray-500">
                                Aucun utilisateur n'a été trouvé.
                            </div>
                        </div>
                    </div>

                    <!-- Groupes -->
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-4">
                        <h2 class="underline text-lg font-bold text-black flex items-center">
                            <i class="fas fa-users mr-2"></i> Groupes
                        </h2>
                        <div class="mt-2 max-h-64 overflow-y-auto">
                            <template v-if="groups.length">
                                <GroupItem v-for="group of groups" :key="group.id" :group="group" />
                            </template>
                            <div v-else class="py-4 text-center text-gray-500">
                                Aucun groupe n'a été trouvé.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publications -->
                <div class="mt-4">
                    <h2 class="ml-2 underline text-lg font-bold text-black">
                        <i class="fas fa-newspaper mr-2"></i> Publications
                    </h2>
                    <div class="h-auto overflow-y-auto">
                        <template v-if="posts.data.length">
                            <PostList :posts="posts.data" class="mt-4" />
                        </template>
                        <div v-else class="py-4 text-center text-gray-500">
                            Aucune publication n'a été trouvée.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Barre de défilement personnalisée */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-thumb {
    background-color: #9ca3af;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #6b7280;
}

::-webkit-scrollbar-track {
    background-color: #f3f4f6;
}
</style>
