import {defineStore} from "pinia";
import {ref} from "vue";

export const useChangesStore = defineStore(
    'useChangesStore',
    () => {
        const changes =  ref({});

        function addChange(key, value) {
            changes.value[key] = value
        }

        function hasChange(key) {
            return key in changes.value;
        }

        function getChange(key) {
            return changes.value[key]
        }

        function resetChanges() {
            changes.value = {}
        }

        function getOnlyChangesIn(list) {
            return Object.keys(changes.value)
                .filter(key => list.includes(parseInt(key)));
        }

        return {changes, resetChanges, addChange, hasChange, getChange, getOnlyChangesIn}
    }
)
