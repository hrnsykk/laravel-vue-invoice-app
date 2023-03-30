<template>
    <div class="flex mb-2 justify-between">
        <div class="title">Category</div>
        <button
            class="bg-blue-600 text-white rounded-md px-10 py-1"
            @click="create"
        >
            New
        </button>
    </div>

    <table class="w-full">
        <thead class="bg-slate-300 rounded-sm">
            <tr class="text-xs uppercase py-2 text-slate-800">
                <th class="py-2">#</th>
                <th class="py-2">Category Name</th>
                <th class="py-2">Status</th>
                <th class="py-2">Control</th>
            </tr>
        </thead>
        <tbody>
            <tr
                class="text-center border border-gray-200 text-xs text-slate-800"
                v-for="(item, index) in categories"
            >
                <td class="py-2">{{ index + 1 }}</td>
                <td class="py-2">{{ item.name }}</td>
                <td class="py-2">
                    <span v-if="item.status">
                        <okay fill="green" class="inline" />
                    </span>
                    <span v-else>
                        <negative fill="red" class="inline" />
                    </span>
                </td>
                <td class="py-2">
                    <div class="flex justify-center">
                        <edit
                            width="20"
                            height="16"
                            class="cursor-pointer"
                            :class="{ 'pointer-events-none': item.id == 1 }"
                            @click="edit_item(item)"
                        />
                        <delete_item
                            width="20"
                            class="cursor-pointer"
                            :class="{ 'pointer-events-none': item.id == 1 }"
                            fill="red"
                            @click="CategoriesStore.delete(item.id)"
                        />
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <Modal
        v-if="category_create_status"
        :sub_component="sub_category_name"
        @close_main_modal="category_create_status = !category_create_status"
        v-bind:data="data"
    />
</template>

<script setup>
import { ref, computed } from "vue";
import okay from "../components/icons/okay.vue";
import edit from "../components/icons/edit.vue";
import negative from "../components/icons/negative.vue";
import delete_item from "../components/icons/delete.vue";

import { useCategoriesStore } from "@/src/stores/categories.js";
import Modal from "../components/modal.vue";

const category_create_status = ref(false);
const sub_category_name = ref("");
const data = ref("");
const CategoriesStore = useCategoriesStore();
CategoriesStore.fetchCategories();

const categories = computed(() => {
    return CategoriesStore.getCategories;
});

const edit_item = (item) => {
    data.value = item;
    category_create_status.value = true;
    sub_category_name.value = "category_edit";
};

const create = () => {
    category_create_status.value = true;
    sub_category_name.value = "category_create";
};
</script>

<style lang="scss" scoped></style>
