import {defineStore} from "pinia";
import {computed, ref} from "vue";

export const useUsersStore = defineStore('useUsersStore', () => {
    const rawData = ref([])
    const users = computed(() => rawData.value.data);

    async function getMembers() {
        try {
            const {data} = await axios.get(
                `http://localhost/api/members`
            );
            rawData.value = data;
            return data;
        } catch (e) {
            console.error(e);
            return [];
        }
    }

    return {rawData, users, getMembers};
});
