<script setup>
import {onMounted, ref} from "vue";
import {storeToRefs} from "pinia";
import {useUsersStore} from "@/stores/useUsersStore.js";

const { fileId } = storeToRefs(useUsersStore());

const file = ref(null)

async function onUploaded(event) {
    file.value = event.target.files[0]
    const uploaded = await uploadFile();
    console.log(uploaded)
}

async function uploadFile() {
    const formData = new FormData();
    formData.append('file', file.value);
    try {
        const {data} = await axios.post(
            `http://localhost/api/upload`,
            formData
        );
        fileId.value = data.fileId || null;
        return data;
    } catch (e) {
        if (e.code === "ERR_BAD_REQUEST") {
            const {data} = e.response
            alert(data.message);
        }
        return [];
    }
}

</script>

<template>
    <div class="flex items-center justify-center w-2/4 mx-auto py-4">
        <label for="dropzone-file"
               class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                    class="font-semibold">Click to upload</span></p>
                <p class="text-xs text-gray-500 dark:text-gray-400">CSV, XLS, XLXS (MAX SIZE: 2MB)</p>
            </div>
            <input id="dropzone-file" type="file" ref="file" @change="onUploaded" class="hidden"/>
        </label>
    </div>
</template>
