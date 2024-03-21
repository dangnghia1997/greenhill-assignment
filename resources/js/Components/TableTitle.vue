<script setup>
import {storeToRefs} from "pinia";
import {useUsersStore} from "@/stores/useUsersStore.js";

const {
    pageMeta,
    page,
} = storeToRefs((useUsersStore()))

const {
    goNextPage,
    goPrevPage,
} = useUsersStore()
</script>

<template>
<div class="flex items-center justify-between mt-8">
    <div class="flex flex-col">
        <h2 class="w-full mx-5 text-xl font-medium">User List</h2>
        <p class="mx-5 text-sm text-gray-600">Showing <b class="underline">{{ pageMeta.from }}</b> to <b class="underline">{{ pageMeta.to }}</b> of <b class="underline">{{ pageMeta?.total || 0 }}</b> Entries</p>
    </div>
    <div class="inline-flex mx-5">
        <button
            v-if="page > 1"
            @click="goPrevPage"
            class="flex items-center justify-center px-3 h-8 text-xs font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900">
            Prev
        </button>
        <button
            v-if="page < pageMeta.last_page"
            @click="goNextPage"
            class="flex items-center justify-center px-3 h-8 text-xs font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            Next
        </button>
    </div>
</div>
</template>

