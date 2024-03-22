<script setup>
import {storeToRefs} from "pinia";
import {useChangesStore} from "@/stores/useChangesStore.js";
import {useSelectsStore} from "@/stores/useSelectsStore.js";
import {useUsersStore} from "@/stores/useUsersStore.js";

const { bulkUpdateGroupId, getMembers } = useUsersStore()
const { getOnlyChangesIn, getChange } = useChangesStore()
const { selected } = storeToRefs(useSelectsStore())

async function onBulkUpdate() {
    const willUpdatedChanges = getOnlyChangesIn(selected.value);
    const items = willUpdatedChanges.map((key) => ({
        user_id: key,
        change_to: getChange(key)
    }))
    const success = await bulkUpdateGroupId({items});
    if (success) {
        getMembers();
        alert('SUCCESS!');
    }
}

</script>

<template>
    <div class="flex items-center justify-between mx-4 py-4">
        <button
            @click="onBulkUpdate"
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Update Checked</button>
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Export CSV</button>
    </div>
</template>
