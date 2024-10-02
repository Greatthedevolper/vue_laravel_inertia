<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
const props = defineProps({
    users: Object,
    errors: Object,
    flash: Object,
    auth: Object,
    searchTerm: String,
});
const search = ref(props.searchTerm);
watch(
    search,
    debounce(
        (q) => router.get("/", { search: q }, { preserveState: true }),
        500
    )
);

const getDate = (date) =>
    new Date(date).toLocaleDateString("en-us", {
        year: "numeric",
        month: "short",
        day: "numeric",
    });

function debounce(fn, delay) {
    let timeoutID;
    return function (...args) {
        if (timeoutID) {
            clearTimeout(timeoutID);
        }
        timeoutID = setTimeout(() => {
            fn.apply(this, args);
        }, delay);
    };
}
</script>
<template>
    <Head :title="`${$page.component}`" />
    <div class="flex justify-end my-2 px-3">
        <div class="md:w-1/4 w-1/2">
            <input
                type="search"
                placeholder="Search"
                class="border h-[30px] px-2 focus:border-0 rounded"
                v-model="search"
            />
        </div>
    </div>
    <div class="h-[calc(100%-80px)] overflow-y-auto overflow-x-auto px-3 pb-2">
        <table class="border border-yellow-400 w-full min-w-[700px]">
            <thead class="bg-yellow-400">
                <tr>
                    <th>#</th>
                    <th class="text-start">Name</th>
                    <th class="text-start">Avatar</th>
                    <th class="text-start">Email</th>
                    <th class="text-start">Create At</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(user, index) in props.users.data"
                    :key="index"
                    class="border border-yellow-400"
                >
                    <td class="px-2 py-3">{{ user.id }}</td>
                    <td class="px-2 py-3">{{ user.name }}</td>
                    <td class="px-2 py-3">
                        <img
                            :src="
                                user.avatar
                                    ? 'storage/' + user.avatar
                                    : 'storage/avatars/default-image.png'
                            "
                            alt=""
                            class="w-8 h-8 rounded-full border border-yellow-400 p-1"
                        />
                    </td>
                    <td class="px-2 py-3">{{ user.email }}</td>
                    <td class="px-2 py-3">{{ getDate(user.created_at) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="flex items-center md:justify-between justify-center p-2">
        <ul class="flex items-center gap-1">
            <li v-for="(page, index) in props.users.links" :key="index">
                <Link
                    :href="page.url || '#'"
                    v-html="page.label"
                    class="px-3 py-1 border border-yellow-400 rounded-sm min-w-fit"
                    :class="{
                        'bg-yellow-400 font-bold': page.active,
                        'hover:bg-yellow-400': page.url,
                        'text-slate-400 cursor-not-allowed': !page.url,
                    }"
                />
            </li>
        </ul>
        <p class="pe-3 md:block hidden">
            Showing from
            <span class="font-bold text-black">{{ users.from }}</span> to
            <span class="font-bold text-black">{{ users.to }}</span>
            of total
            <span class="font-bold text-black">{{ users.total }}</span>
        </p>
    </div>
</template>
