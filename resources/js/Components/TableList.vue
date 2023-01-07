<script setup>
import { computed, reactive, ref } from 'vue';
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    head: {
        type: Array,
        required: true,
    },
    data: {
        type: Array,
        required: true
    },
    action: {
        type: String,
        default: 'link',
    },
    url: {
        default: null,
    }
})

const originalData = [...props.data];
const sortDesc = ref(null);
const sortBy = reactive({
    col: null,
    type: null,
});
const sortedData = computed(() => {
    const { data } = props;
    if (sortDesc.value === null) return originalData;

    if (sortBy.type === 'String') {
        if (sortDesc.value) {
            return data.sort((a, b) => b[sortBy.col].localeCompare(a[sortBy.col], undefined, { numeric: true }));
        } else {
            return data.sort((a, b) => a[sortBy.col].localeCompare(b[sortBy.col], undefined, { numeric: true }));
        }
    } else {
        if (sortDesc.value) {
            return data.sort((a, b) => b[sortBy.col] - a[sortBy.col]);
        } else {
            return data.sort((a, b) => a[sortBy.col] - b[sortBy.col]);
        }
    }
})

function setSort(key, type) {
    if (sortBy.col === key) {
        if (sortDesc.value === null) {
            sortDesc.value = false;
        } else if (sortDesc.value) {
            sortDesc.value = null;
        } else {
            sortDesc.value = true;
        }
    } else {
        sortBy.col = key;
        sortDesc.value = false;
    }
    sortBy.type = type;
}
</script>

<template>
    <div class="p-6 bg-white shadow-lg rounded-lg">
        <slot />
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-left font-medium uppercase border-b-[3px] border-primary-800">
                    <tr>
                        <template v-for="({ key, label, sortable, type }) in head">
                            <th v-if="sortable" @click="setSort(key, type)"
                                class="relative py-3 px-3.5 cursor-pointer select-none">
                                {{ label }}
                                <template v-if="sortBy.col === key">
                                    <span v-if="sortDesc === true"
                                        class="absolute top-1/2 right-1.5 -translate-y-1/2 w-0 h-0 border-b-8 border-x-4 border-x-transparent border-b-black"
                                        aria-label="descending order"></span>
                                    <span v-else-if="sortDesc === false"
                                        class="absolute top-1/2 right-1.5 -translate-y-1/2 w-0 h-0 border-t-8 border-x-4 border-x-transparent border-t-black"
                                        aria-label="ascending order"></span>
                                </template>
                            </th>
                            <th v-else class="py-3 px-3.5 cursor-default">{{ label }}</th>
                        </template>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in sortedData" :key="index" class="group hover:bg-slate-50">
                        <td v-for="({ key }) in head" class="py-3 px-3.5">{{ data[key] }}</td>
                        <td v-if="action === 'modal'" class="py-3 px-3.5">
                            <button v-if="$page.props.auth.user.isAdmin" type="button"
                                @click="$emit('edit', 'edit', data)">
                                <span class="sr-only">Edit</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="24" width="24"
                                    class="inline hover:scale-x-110">
                                    <path
                                        d="M9 47.4q-1.2 0-2.1-.9-.9-.9-.9-2.1v-30q0-1.2.9-2.1.9-.9 2.1-.9h20.25L15 25.7v12.7h12.7L42 24v20.4q0 1.2-.9 2.1-.9.9-2.1.9Zm9-12v-8.5l15.1-15.1 8.55 8.4L26.5 35.4Zm25.8-17.35-8.55-8.4L38.1 6.8q.85-.85 2.125-.85t2.125.9l4.2 4.25q.85.9.85 2.125t-.9 2.075Z" />
                                </svg>
                            </button>
                        </td>
                        <td v-else-if="action === 'link'" class="py-3 px-3.5">
                            <Link :href="route(url, data.id)">
                            <span class="sr-only">Edit</span>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="24" width="24"
                                class="inline hover:scale-x-110">
                                <path
                                    d="M9 47.4q-1.2 0-2.1-.9-.9-.9-.9-2.1v-30q0-1.2.9-2.1.9-.9 2.1-.9h20.25L15 25.7v12.7h12.7L42 24v20.4q0 1.2-.9 2.1-.9.9-2.1.9Zm9-12v-8.5l15.1-15.1 8.55 8.4L26.5 35.4Zm25.8-17.35-8.55-8.4L38.1 6.8q.85-.85 2.125-.85t2.125.9l4.2 4.25q.85.9.85 2.125t-.9 2.075Z" />
                            </svg>
                            </Link>
                        </td>
                        <td v-else class="py-3 px-3.5">
                            <Link :href="route(url, data.id)">
                            Details
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <slot name="pagination" />
    </div>
</template>
