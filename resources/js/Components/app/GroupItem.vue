<script setup>
import {Link} from '@inertiajs/vue3'

defineProps({
    group: Object,
})
</script>

<template>
    <div class="mb-1 cursor-pointer dark:bg-gray-900 bg-gray-100 hover:bg-gray-200 dark:hover:bg-slate-800">
        <Link :href="route('group.profile', group.slug)" class="flex items-start gap-2 py-2 px-2">
            <img alt="" :src="group.thumbnail_url" class="w-[32px] rounded-full"/>
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h3 class="font-black">{{ group.name }}</h3>
                </div>
<!--                <div class="text-xs text-gray-500" v-html="group.description"></div>-->
                <span class="text-xs">
                    {{ group.status === 'approved' ? (group.role === 'admin' ? group.role : 'membre') : 'pas membre' }}
                </span>
            </div>
        </Link>
    </div>
</template>

<style scoped>

</style>
