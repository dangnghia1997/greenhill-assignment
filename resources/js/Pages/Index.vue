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

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
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
            <TableTitle />
            <TableActions />
            <Table />
            <TablePagination />
        </Group>
    </div>
</template>
