<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

import Group from "@/Components/Group.vue";
import Table from "@/Components/Table.vue";
import TableActions from "@/Components/TableActions.vue";
import UploadArea from "@/Components/UploadArea.vue";
import TableTitle from "@/Components/TableTitle.vue";
import TablePagination from "@/Components/TablePagination.vue";
import {storeToRefs} from "pinia";
import {useUsersStore} from "@/stores/useUsersStore.js";

const { fileId } = storeToRefs(useUsersStore())
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
    fileId.value = null;
})

</script>

<template>
    <Head title="Home" />

    <div class="bg-[url('/bg.jpg')] bg-contain">
        <Group class="min-h-screen shadow-md py-8">
            <h1 class="text-gray-900 font-medium text-4xl text-center">
                Green Hill - Assignment
            </h1>
            <UploadArea />
            <div v-if="fileId">
                <TableTitle />
                <TableActions />
                <Table />
                <TablePagination />
            </div>
            <div v-else class="mx-4 flex items-center justify-center border-2 border-dashed rounded-lg min-h-96 bg-gray-50">
                <div>
                    <h1 class="text-sm text-gray-500 font-semibold uppercase">No data</h1>
                    <p class="text-sm text-gray-500 font-semibold">..... ....... .....</p>
                </div>
            </div>
        </Group>
    </div>
</template>
