<script setup lang="ts">
import SiteHeader from './Partials/SiteHeader.vue';
import SiteFooter from './Partials/SiteFooter.vue';
import SiteMenu from './Partials/SiteMenu.vue';

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <SiteHeader />

            <div class="flex flex-col md:flex-row max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
                <div class="md:w-3/12 w-full md:mr-4 mr-0 mb-4">
                    <SiteMenu />
                </div>
                <main class="w-full md:w-9/12 rounded-md p-4 bg-white">
                    <div class="text-3xl font-bold">
                        <slot name="heading"></slot>
                    </div>
                    <!-- Page Content -->
                    <slot></slot>
                </main>
            </div>

            <SiteFooter />
        </div>
    </div>
</template>
