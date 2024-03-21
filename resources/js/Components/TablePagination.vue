<script setup>
import {storeToRefs} from "pinia";
import {useUsersStore} from "@/stores/useUsersStore.js";

const {
    pageMeta,
    page,
} = storeToRefs(useUsersStore())

const {
    goNextPage,
    goPrevPage
} = useUsersStore()

</script>

<template>
    <div class="flex flex-col items-center py-5">
        <span class="text-sm text-gray-700 dark:text-gray-400">
      Showing <span class="font-semibold text-gray-900 dark:text-white">{{ pageMeta.from }}</span> to <span class="font-semibold text-gray-900 dark:text-white">{{ pageMeta.to }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ pageMeta.total}}</span> Entries
  </span>
        <div class="inline-flex mt-2 xs:mt-0">
            <button
                v-if="page > 1"
                @click="goPrevPage"
                class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Prev
            </button>
            <button
                v-if="page < pageMeta.last_page"
                @click="goNextPage"
                class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Next
            </button>
        </div>
    </div>
</template>
