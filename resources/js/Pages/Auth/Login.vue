<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in"/>
        <div class="text-center dark:text-gray-100">
            <h2 class="text-center">Se connecter</h2>
            <span class="text-gray-400 text-sm">ou</span>
            <div class="flex justify-center">
                <Link :href="route('register')" class="inline-block hover:underline">
                    créer nouveau compte
                </Link>
            </div>
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="mt-6">
                <InputLabel class="ml-2" for="email" value="Adresse Email"/>

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div class="mt-4">
                <InputLabel class="ml-2" for="password" value="Mot de Passe"/>

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password"/>
            </div>

            <div class="block ml-2 mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember"/>
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Se souvenir de moi</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-6">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    Mot de Passe oublié?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Se connecter
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
