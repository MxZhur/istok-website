<template>
    <div class="py-4">
        <div v-if="images.length === 1">
            <img :src="images[0]" class="object-contain" height="300">
        </div>
        <Carousel v-else-if="images.length > 1" :wrap-around="true">
            <Slide v-for="slide in images" :key="slide">
                <img :src="slide" class="object-contain h-72" height="300">
            </Slide>

            <template #addons>
                <Navigation />
                <Pagination />
            </template>
        </Carousel>
    </div>
</template>

<script setup lang="ts">
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

defineProps<{
    images: string[];
}>();

</script>
