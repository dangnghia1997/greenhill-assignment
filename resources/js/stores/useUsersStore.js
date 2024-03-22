import {defineStore} from "pinia";
import {computed, ref} from "vue";

export const useUsersStore = defineStore('useUsersStore', () => {
    const rawData = ref([])
    const users = computed(() => rawData.value?.data || []);
    const pageMeta = computed(() => rawData.value?.meta || {})
    const availableGroupUserIds = computed(() => rawData.value?.available_group_user_ids || [])
    const page = ref(1);

    async function goNextPage() {
        const lastPage = pageMeta.value?.last_page || 1
        const nextPage = page.value + 1 < lastPage ? page.value + 1 : lastPage ;
        page.value  = nextPage
        await getMembers();
    }

    async function goPrevPage() {
        const prevPage = page.value - 1 <= 0 ? 1: page.value - 1;
        page.value = prevPage;
        await getMembers();
    }

    async function getMembers() {
        try {
            const {data} = await axios.get(
                `http://localhost/api/members?page=${page.value}`
            );
            rawData.value = data;
            return data;
        } catch (e) {
            console.error(e);
            return [];
        }
    }

    async function updateGroupId(memberId, groupId) {
        try {
            const { data } = await axios.put(`http://localhost/api/members/${memberId}`, {
                change_to: groupId
            })
            return data.success
        } catch (e) {
            console.error(e);
            return false;
        }
    }

    async function bulkUpdateGroupId(payload) {
        try {
            const { data } = await axios.patch(`http://localhost/api/members`, payload)
            return data.success
        } catch (e) {
            console.error(e);
            return false;
        }
    }

    return {rawData, users, pageMeta, availableGroupUserIds, getMembers, updateGroupId, bulkUpdateGroupId, page, goNextPage, goPrevPage};
});
