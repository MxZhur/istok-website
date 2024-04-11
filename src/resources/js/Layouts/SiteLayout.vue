<script setup lang="ts">
import SiteHeader from './Partials/SiteHeader.vue';
import SiteFooter from './Partials/SiteFooter.vue';

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <SiteHeader />

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <slot></slot>
            </main>

            <SiteFooter />
        </div>
    </div>
</template>
