<template>
    <section id="products" class="bg-white py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm uppercase tracking-wider">
                    <SparklesIcon class="w-4 h-4" />
                    আমাদের বিশেষত্ব
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-3">
                    কেন <span class="text-green-600">অর্গানিক</span> চা সেরা?
                </h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto text-lg">
                    প্রতিটি কাপে প্রকৃতির বিশুদ্ধতা - আমাদের চা পাতা সিলেটের পাহাড়ি বাগান থেকে সরাসরি আপনার কাপে আসে
                </p>
            </div>

            <!-- Feature Cards -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
                <div v-for="(feature, i) in features" :key="feature.title"
                     class="group bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 border border-green-100 scroll-reveal"
                     :style="`animation-delay: ${i * 0.15}s`">
                    <div class="w-16 h-16 mx-auto bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-200 group-hover:scale-110 transition-all duration-300">
                        <component :is="feature.icon" class="w-8 h-8 text-green-600" />
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ feature.title }}</h3>
                    <p class="text-gray-600 text-sm">{{ feature.desc }}</p>
                </div>
            </div>

            <!-- Product Slider -->
            <div>
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-10">
                    আমাদের জনপ্রিয় পণ্যসমূহ
                </h3>
                <ProductSlider :products="productsList" />
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed } from 'vue';
import ProductSlider from './ProductSlider.vue';
import {
    SparklesIcon,
    ShieldCheckIcon,
    TruckIcon,
    StarIcon,
    BoltIcon,
} from '@heroicons/vue/24/outline';

const features = [
    { icon: ShieldCheckIcon, title: '১০০% জৈব', desc: 'কোনো রাসায়নিক সার বা কীটনাশক ব্যবহার করা হয় না' },
    { icon: TruckIcon, title: 'পাহাড়ি বাগান', desc: 'সিলেটের পাহাড়ি এলাকার উচ্চতায় grown premium চা পাতা' },
    { icon: StarIcon, title: 'হাতে তোলা', desc: 'অভিজ্ঞ চা বাগান কর্মীদের দ্বারা যত্ন সহকারে হাতে সংগ্রহ' },
    { icon: BoltIcon, title: 'তাজা প্যাকেজিং', desc: 'স্বাদ ও গুণমান বজায় রাখতে ভ্যাকুয়াম সিল প্যাকেজিং' },
];

const props = defineProps({
    products: { type: Object, required: true },
});

const productsList = computed(() => Object.values(props.products));
</script>
