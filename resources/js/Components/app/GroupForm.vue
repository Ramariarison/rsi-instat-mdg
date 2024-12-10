<script setup>

import InputTextarea from "@/Components/InputTextarea.vue";
import Checkbox from "@/Components/Checkbox.vue";
import TextInput from "@/Components/TextInput.vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

defineProps({
    form: Object
})

const editor = ClassicEditor;
const editorConfig = {
    toolbar: ['bold', 'italic', '|', 'bulletedList', 'numberedList', '|', 'heading', '|', 'outdent', 'indent', '|', 'link', '|', 'blockQuote'],
}

</script>

<template>
    <div class="mb-3 dark:text-gray-100">
        <label>Nom du Groupe</label>
        <TextInput
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            required
            autofocus
        />
    </div>

    <div class="mb-3 dark:text-gray-100">
        <label>
            <Checkbox name="remember" v-model:checked="form.auto_approval"/>
            Permettre l'auto approbation
        </label>
    </div>

    <div class="mb-3 dark:text-gray-100">
        <label>A propos du Groupe</label>
        <ckeditor :editor="editor" v-model="form.about" :config="editorConfig"></ckeditor>
    </div>
</template>

<style scoped>

</style>
