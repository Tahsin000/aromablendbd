<template>
    <Head title="অর্গানিক - প্রাকৃতিক চা" />
    <div class="min-h-screen">
        <StickyRibbon />
        <HeroSection @go-product="goToProduct" />
        <ProductOverview :products="products" />
        <OfferSection />
        <ProductGallery />
        <ReviewCarousel />
        <FooterSection />
    </div>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import StickyRibbon from '../Components/Landing/StickyRibbon.vue';
import HeroSection from '../Components/Landing/HeroSection.vue';
import ProductOverview from '../Components/Landing/ProductOverview.vue';
import OfferSection from '../Components/Landing/OfferSection.vue';
import ProductGallery from '../Components/Landing/ProductGallery.vue';
import ReviewCarousel from '../Components/Landing/ReviewCarousel.vue';
import FooterSection from '../Components/Landing/FooterSection.vue';

defineProps({
    products: { type: Object, default: () => ({}) },
});

function goToProduct(id) {
    router.visit(`/product/${id}`);
}
</script>
