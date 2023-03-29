<template>
    <!-- Main modal -->
    <div
        id="defaultModal"
        tabindex="-1"
        aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full"
    >
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
                >
                    <h3
                        class="text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        Product
                    </h3>
                    <button
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="$emit('close')"
                    >
                        <svg
                            aria-hidden="true"
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="mb-6">
                        <label for="name" class="block text-white text-sm"
                            >Product Name</label
                        >
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="rounded-sm w-full mt-1 h-9 text-sm pl-2"
                            v-model="product.name"
                        />
                    </div>

                    <div class="mb-6">
                        <label for="price" class="block text-white text-sm"
                            >Product Price</label
                        >
                        <input
                            type="text"
                            id="name"
                            name="price"
                            class="rounded-sm w-full mt-1 h-9 text-sm pl-2"
                            v-model="product.price"
                        />
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                >
                    <button
                        type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        @click="saveProduct"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { ref } from "vue";
import Axios from "axios";

const emit = defineEmits(["close", "updateProduct"]);
const product = ref({
    name: null,
    price: null,
});

const saveProduct = async () => {
    await Axios.post("/api/product", product.value).then((response) => {
        if (response.data) {
            console.log(response.data);
        }
    });
    emit("updateProduct");
    emit("close");
};
</script>

<style lang="scss" scoped></style>
