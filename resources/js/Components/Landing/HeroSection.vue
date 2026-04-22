<template>
    <section class="relative bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 overflow-hidden">
        <!-- Animated background blobs -->
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-10 left-10 w-72 h-72 bg-green-300 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-300 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-16 lg:pt-28 lg:pb-24">
            <!-- Mobile: tag centered, desktop: left-aligned -->
            <div class="text-center lg:text-right">
                <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 text-sm font-medium px-4 py-2 rounded-full mb-4 animate-fade-in-up">
                    <LeafIcon class="w-4 h-4" />
                    ১০০% প্রাকৃতিক ও জৈব
                </span>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center mt-6">
                <!-- Left: Hero content -->
                <div class="z-20 text-center lg:text-right order-2 lg:order-1">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight mb-4 animate-fade-in-up">
                        সেরা মানের <span class="text-green-600">অর্গানিক চা</span>
                        <br class="hidden sm:block" /> আপনার দরজায়
                    </h1>
                    <p class="text-base sm:text-lg lg:text-xl text-gray-600 mb-6 max-w-xl mx-auto lg:mx-0 animate-fade-in-up" style="animation-delay: 0.2s">
                        সিলেটের পাহাড়ি বাগান থেকে সংগ্রহ করা বিশুদ্ধ জৈব চা পাতা। কোনো রাসায়নিক সার নেই, কোনো কৃত্রিম স্বাদ নেই — শুধু প্রকৃতির আসল স্বাদ।
                    </p>

                    <!-- CTA buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start animate-fade-in-up mb-8" style="animation-delay: 0.4s">
                        <a href="#products" class="group bg-green-600 hover:bg-green-700 text-white text-base sm:text-lg font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            পণ্য দেখুন
                            <ArrowDownIcon class="w-5 h-5 group-hover:translate-y-1 transition-transform" />
                        </a>
                        <a href="#offer" class="group bg-white hover:bg-gray-50 text-green-600 text-base sm:text-lg font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-xl border-2 border-green-600 hover:border-green-700 transition-all duration-300 flex items-center justify-center gap-2">
                            <TagIcon class="w-5 h-5" />
                            অফার দেখুন
                        </a>
                    </div>

                    <!-- Trust stats row -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 max-w-lg mx-auto animate-fade-in-up" style="animation-delay: 0.6s">
                        <div class="text-center">
                            <p class="text-xl sm:text-2xl font-bold text-green-600">৫০০০+</p>
                            <p class="text-xs sm:text-sm text-gray-500">সন্তুষ্ট গ্রাহক</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xl sm:text-2xl font-bold text-green-600">৪.৮/৫</p>
                            <p class="text-xs sm:text-sm text-gray-500">গড় রেটিং</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xl sm:text-2xl font-bold text-green-600">১০০০০+</p>
                            <p class="text-xs sm:text-sm text-gray-500">অর্ডার সম্পন্ন</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Hero product visual -->
                <div class="order-1 lg:order-2">
                    <div class="relative max-w-sm sm:max-w-md lg:max-w-lg mx-auto">
                        <!-- Glow ring -->
                        <div class="absolute inset-4 bg-green-300 rounded-full opacity-20 blur-2xl animate-pulse"></div>

                        <!-- Main product card -->
                        <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden border border-green-100">
                            <!-- Hero product image -->
                            <div class="relative h-48 sm:h-56 lg:h-64 bg-gradient-to-br from-green-100 to-emerald-100 overflow-hidden cursor-pointer"
                                 @click="$emit('go-product', 'green-tea')">
                                <img :src="heroProduct.image" :alt="heroProduct.name"
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" />
                                <!-- Badge -->
                                <span class="absolute top-3 left-3 bg-green-600 text-white text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1">
                                    <TagIcon class="w-3 h-3" />
                                    {{ heroProduct.badge }}
                                </span>
                                <!-- Price tag -->
                                <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1.5">
                                    <span class="text-lg font-bold text-green-600">{{ formatBangla(heroProduct.price) }}৳</span>
                                    <span class="text-xs text-gray-400 line-through ml-1">{{ formatBangla(heroProduct.original_price) }}৳</span>
                                </div>
                            </div>

                            <!-- Quick category nav -->
                            <div class="grid grid-cols-4 gap-2 p-3 sm:p-4">
                                <div v-for="cat in categories" :key="cat.id"
                                     @click="$emit('go-product', cat.id)"
                                     class="flex flex-col items-center gap-1 p-2 sm:p-3 rounded-xl hover:bg-gray-50 transition-colors cursor-pointer group">
                                    <div :class="`w-10 h-10 sm:w-12 sm:h-12 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform ${cat.bg}`">
                                        <component :is="cat.icon" :class="`w-5 h-5 sm:w-6 sm:h-6 ${cat.color}`" />
                                    </div>
                                    <span class="text-[10px] sm:text-xs text-gray-600 font-medium text-center leading-tight">{{ cat.label }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave separator -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full" preserveAspectRatio="none">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>
</template>

<script setup>
import { computed } from 'vue';
import { ArrowDownIcon, TagIcon } from '@heroicons/vue/24/outline';

const LeafIcon = { template: `<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c-1.5 0-2.8.4-3.9 1.1C5.3 6 4 9 4 12c0 5.5 3.8 8.5 8 8.5s8-3 8-8.5c0-3-1.3-6-4.1-7.9C14.8 3.4 13.5 3 12 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18"/></svg>` };

const props = defineProps({
    products: { type: Object, default: () => ({}) },
});

const heroProduct = computed(() => props.products['green-tea'] || {});

const categories = [
    {
        id: 'green-tea',
        label: 'সবুজ চা',
        bg: 'bg-green-50',
        color: 'text-green-600',
        icon: { template: `<svg class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>` },
    },
    {
        id: 'black-tea',
        label: 'কালো চা',
        bg: 'bg-amber-50',
        color: 'text-amber-700',
        icon: { template: `<svg class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/></svg>` },
    },
    {
        id: 'floral-tea',
        label: 'ফুলের চা',
        bg: 'bg-pink-50',
        color: 'text-pink-500',
        icon: { template: `<svg class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>` },
    },
    {
        id: 'combo-pack',
        label: 'হার্বাল চা',
        bg: 'bg-teal-50',
        color: 'text-teal-600',
        icon: { template: `<svg class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/></svg>` },
    },
];

function formatBangla(n) {
    const b = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return String(n).replace(/\d/g, d => b[d]);
}
</script>

<style scoped>
@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up { animation: fade-in-up 0.8s ease-out both; }
</style>
