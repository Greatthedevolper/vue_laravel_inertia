<script setup>
import {ref} from "vue";
import FlashMessage from "../components/FlashMessage.vue";
const flashShow = ref(true);
const handleCloseMessage = () => {
    flashShow.value = false;
};
</script>

<template>
    <div>
        <header
            class="bg-red-400 flex items-center justify-between h-[50px] px-3"
        >
            <h3>Welcome {{ $page.props?.auth?.user?.name || "Guest" }}</h3>
            <nav>
                <ul class="flex items-center gap-2">
                    <template v-if="$page.props?.auth?.user">
                        <li>
                            <Link :href="route('home')" preserve-scroll
                                >Home</Link
                            >
                        </li>
                        <li>
                            <div class="dropdown dropdown-bottom dropdown-end">
                                <div tabindex="0" role="button">
                                    <img
                                        :src="
                                            $page.props?.auth?.user?.avatar
                                                ? 'storage/' +
                                                  $page.props?.auth?.user
                                                      ?.avatar
                                                : 'storage/avatars/default-image.png'
                                        "
                                        class="h-8 w-8 rounded-full object-cover shadow-sm"
                                        alt="User avatar"
                                    />
                                </div>
                                <ul
                                    tabindex="0"
                                    class="dropdown-content menu bg-base-100 rounded-box z-[1] w-30 p-2 shadow"
                                >
                                    <li>
                                        <Link
                                            :href="route('logout')"
                                            method="post"
                                            type="button"
                                            as="button"
                                        >
                                            Logout
                                        </Link>
                                    </li>
                                    <li>
                                        <Link :href="route('profile')"
                                            >Profile</Link
                                        >
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </template>
                    <template v-else>
                        <li><Link :href="route('login')">Login</Link></li>
                        <li><Link :href="route('signup')">Sign Up</Link></li>
                    </template>
                </ul>
            </nav>
        </header>
        <main>
            <FlashMessage @closeMessage="handleCloseMessage" v-if="$page?.props?.flash?.message && flashShow"
                :title="$page?.props?.flash?.message"
                :flashClass="$page?.props?.flash?.type"
            />
            <slot />
        </main>
    </div>
</template>
