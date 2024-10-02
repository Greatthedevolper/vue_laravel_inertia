<script setup>
defineProps({
    users: Object,
});
</script>
<template>
    <Head :title="`${$page.component}`" />
    <table class="border border-yellow-400 w-full">
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
                v-for="(user, index) in users.data"
                :key="index"
                class="border border-yellow-400"
            >
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>
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
                <td>{{ user.email }}</td>
                <td>{{ user.created_at }}</td>
            </tr>
        </tbody>
    </table>
</template>

