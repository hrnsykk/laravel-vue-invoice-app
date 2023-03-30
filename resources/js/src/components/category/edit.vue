<template>
    <div class="flex justify-between mb-5 border-gray-400 border-b pb-2">
        <div class="title uppercase text-sm text-gray-500">Edit Category</div>
        <close @click="$emit('close_modal')" />
    </div>
    <form @submit.prevent="store.update({ props })">
        <div>
            <label for="id" class="block pb-2 font-medium text-sm text-gray-500"
                >Id</label
            >
            <input
                type="text"
                id="id"
                name="id"
                v-model="props.data.id"
                class="border border-gray-400 w-full rounded-md h-8 pl-2"
            />
        </div>
        <div>
            <label
                for="name"
                class="block pb-2 font-medium text-sm text-gray-500"
                >Category Name</label
            >
            <input
                type="text"
                id="name"
                name="name"
                v-model="props.data.name"
                class="border border-gray-400 w-full rounded-md h-8 pl-2"
            />
        </div>

        <div class="mt-3">
            <button
                class="bg-blue-600 w-full text-white h-8 text-sm font-bold rounded-md uppercase"
            >
                Update
            </button>
        </div>
    </form>
</template>

<script setup>
import { ref } from "vue";
import close from "../icons/close.vue";
import { useCategoriesStore } from "@/src/stores/categories";

const store = useCategoriesStore();

const emits = defineEmits(["close_modal"]);
const props = defineProps(["data"]);

const form = ref({
    id: null,
    name: null,
});
</script>

<style lang="scss" scoped></style>
