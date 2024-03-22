import {defineStore} from "pinia";
import {ref} from "vue";

export const useSelectsStore = defineStore(
    'useSelectsStore',
    () => {
        const selected = ref([])

        function setSelected(_selected) {
            selected.value = _selected;
        }

        return {selected, setSelected}
    }
)
