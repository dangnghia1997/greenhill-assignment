<script setup>
import {onMounted, ref} from "vue";
import {storeToRefs} from "pinia";
import {useUsersStore} from "@/stores/useUsersStore.js";

const { users, availableGroupUserIds } = storeToRefs(useUsersStore())
const { getMembers } = useUsersStore()

onMounted(async () => {
    await getMembers();
});

const changedList = ref({});

function onChange(event, userId) {
    changedList.value[userId] = event.target.value;
    console.log('selected ', event.target.value, 'userId: ' + userId)
    console.log(changedList.value)
}

function onUpdate(event, userId) {
    console.log('updated ', event.target.value, 'userId: ' + userId)
    if (userId in changedList.value) {
        console.log('existed');
        console.log('HERE ', changedList.value[userId]);
        const changeToUserId = changedList.value[userId];
        // TODO: send api update with changeToUserId param
    }
}

</script>

<template>
    <div class="relative overflow-x-auto shadow-md mx-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all" type="checkbox"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-2 py-3">
                    #
                </th>
                <th scope="col" class="px-2 py-3">
                    ID
                </th>
                <th scope="col" class="px-2 py-3">
                    GROUP ID
                </th>
                <th scope="col" class="px-2 py-3">
                    Change To
                </th>
                <th scope="col" class="px-2 py-3">
                    FIRST NAME
                </th>
                <th scope="col" class="px-2 py-3">
                    LAST NAME
                </th>
                <th scope="col" class="px-2 py-3">
                    EMAIL
                </th>
                <th scope="col" class="px-2 py-3">
                    PHONE
                </th>
                <th scope="col" class="px-2 py-3">
                    FAX
                </th>
                <th scope="col" class="px-2 py-3">
                    ACTION
                </th>
            </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b text-sm hover:bg-gray-50" v-for="(user, idx) in users" :key="user">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-1" type="checkbox"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ idx + 1 }}
                    </th>
                    <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ user.id }}
                    </th>
                    <td class="px-2 py-4">
                        {{ user.group_id }}
                    </td>
                    <td class="px-2 py-4">
                        <select
                            @change="onChange($event, user.id)"
                            id="small"
                            class="block max-w-20 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                            <option v-for="groupID in availableGroupUserIds" :value="groupID" :selected="groupID === user.group_id">
                                {{groupID}}
                            </option>
                        </select>
                    </td>
                    <td class="px-2 py-4">
                        {{ user.first_name }}
                    </td>
                    <td class="px-2 py-4">
                        {{ user.last_name }}
                    </td>
                    <td class="px-2 py-4">
                        {{ user.email }}
                    </td>
                    <td class="px-2 py-4">
                        {{ user.phone }}
                    </td>
                    <td class="px-2 py-4">
                        &nbsp;
                    </td>
                    <td class="px-2 py-4">
                        <button
                            @click="onUpdate($event, user.id)"
                            type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-2 py-1">
                            Update
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

