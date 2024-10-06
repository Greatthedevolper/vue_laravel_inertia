<script setup>
</script>
<template>
    <Head title="Home" />
    <div>
        <h3 class="bg-red-500 text-red-100">{{ $page?.url }}</h3>    
        <div class="mt-[600px]">
            <Link  :href="route('home')"  preserve-scroll>Login</Link> 
        </div>
    </div>
</template>