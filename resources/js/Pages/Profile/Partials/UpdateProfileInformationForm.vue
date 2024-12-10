<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const divisions = ref([]);
const form = useForm({
    name: user.name,
    username: user.username,
    email: user.email,
    division_id: user.division_id || "",
});

const showNotification = ref(false);
let timeout; // Variable pour gérer le délai du message

// Chargement des divisions via l'API
const fetchDivisions = async () => {
    try {
        const response = await axios.get('/divisions');
        divisions.value = response.data;

        if (form.division_id && !divisions.value.some(division => division.id === form.division_id)) {
            form.division_id = null;
        }

    } catch (error) {
        console.error('Erreur lors de la récupération des divisions:', error);
    }
};

onMounted(() => {
    fetchDivisions();
});

// Annulation du timeout si le composant est démonté
onUnmounted(() => {
    clearTimeout(timeout);
});

// Fonction pour soumettre le formulaire et afficher le message de succès
const submitForm = () => {
    form.patch(route('profile.update'), {
        onSuccess: () => {
            showNotification.value = true; // Affiche le message de succès
            timeout = setTimeout(() => {
                showNotification.value = false; // Masque le message après 3 secondes
            }, 3000);
        },
    });
};
</script>

<template>
    <section>
        <header>
            <div
                    v-show="showNotification && success"
                    class="my-2 py-2 px-3 font-medium text-sm bg-emerald-500 text-white"
                >
                    {{ success }}
                </div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informations de profil</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Mettez à jour vos informations de profil et l'adresse e-mail associée.
            </p>
        </header>

        <form @submit.prevent="submitForm" class="mt-6 space-y-6">
            <!-- Champ pour le nom -->
            <div>
                <InputLabel for="name" value="Nom et Prénom(s)" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Champ pour le nom d'utilisateur -->
            <div>
                <InputLabel for="username" value="Nom d'Utilisateur" />
                <TextInput
                    id="username"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.username"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <!-- Champ de sélection du division -->
            <div>
                <InputLabel for="division_id" value="Division Rattaché" />
                <select
                    id="division_id"
                    v-model="form.division_id"
                    class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    required
                >
                    <option value="" disabled>-- Sélectionnez une division --</option>
                    <option v-for="division in divisions" :key="division.id" :value="division.id">
                        {{ division.nom }}
                    </option>
                </select>
                <InputError :message="form.errors.division_id" class="mt-2" />
            </div>

            <!-- Champ pour l'adresse e-mail -->
            <div>
                <InputLabel for="email" value="Adresse Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Section pour la vérification de l'adresse e-mail -->
            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Votre adresse e-mail n'est pas vérifiée.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Cliquez ici pour renvoyer l'e-mail de vérification.
                    </Link>
                </p>
                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                </div>
            </div>

            <!-- Bouton d'enregistrement -->
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Enregistrer</PrimaryButton>

                <Transition
                    enter-active-class="transition-opacity duration-500"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="transition-opacity duration-500"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <p v-show="showNotification" class="text-sm text-gray-600 dark:text-gray-400">Enregistré.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
