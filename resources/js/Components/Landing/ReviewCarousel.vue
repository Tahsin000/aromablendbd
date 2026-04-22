<template>
    <section class="bg-gradient-to-br from-gray-50 to-green-50 py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm uppercase tracking-wider">
                    <ChatBubbleLeftRightIcon class="w-4 h-4" />
                    গ্রাহকদের মতামত
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-3">
                    আমাদের <span class="text-green-600">সন্তুষ্ট</span> গ্রাহকরা কী বলছেন
                </h2>
            </div>

            <!-- Auto-scrolling review carousel -->
            <div class="relative overflow-hidden">
                <div class="flex gap-6 animate-scroll" ref="trackRef">
                    <div v-for="(review, i) in allReviews" :key="`${i}-${review.name}`"
                         class="flex-shrink-0 w-80 bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 scroll-reveal"
                         :style="`animation-delay: ${i * 0.1}s`">
                        <!-- Stars -->
                        <div class="flex gap-1 mb-3">
                            <StarIcon v-for="s in review.stars" :key="s" class="w-5 h-5 text-yellow-400" />
                        </div>
                        <p class="text-gray-700 text-sm mb-4 leading-relaxed">"{{ review.text }}"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-green-700 font-bold text-sm">{{ review.initial }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ review.name }}</p>
                                <p class="text-gray-500 text-xs">{{ review.location }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed } from 'vue';
import { ChatBubbleLeftRightIcon, StarIcon } from '@heroicons/vue/24/outline';

const reviews = [
    { name: 'রহিম আহমেদ', location: 'ঢাকা', initial: 'রা', text: 'অর্গানিক চা সত্যিই অসাধারণ! স্বাদ আর গন্ধ দুটোই প্রিমিয়াম। পরিবারের সবাই এখন এই চা ছাড়া অন্য কিছু খায় না।', stars: 5 },
    { name: 'ফারহানা খান', location: 'চট্টগ্রাম', initial: 'ফা', text: 'গ্রিন টি অর্ডার করেছিলাম, প্যাকেজিং ছিল দারুণ। চা পাতা একদম তাজা আর সুগন্ধি। আবার অর্ডার করবো।', stars: 5 },
    { name: 'কামাল হোসেন', location: 'সিলেট', initial: 'কা', text: 'দীর্ঘদিন ধরে ভালো চা খুঁজছিলাম। অর্গানিক চা সেই খোঁজ শেষ করেছে। কোয়ালিটি টপ নচ!', stars: 5 },
    { name: 'নাসরিন আক্তার', location: 'রাজশাহী', initial: 'না', text: 'হার্বাল টি আমার ঘুমের সমস্যা অনেকটাই কমিয়ে দিয়েছে। রাতে এক কাপ খেলে গভীর ঘুম হয়। ধন্যবাদ অর্গানিক!', stars: 4 },
    { name: 'জাহিদ হাসান', location: 'খুলনা', initial: 'জা', text: 'কম্বো প্যাক কিনেছিলাম - তিন ধরনের চা একসাথে। প্রতিটি আলাদা স্বাদের এবং খুবই মানসম্মত।', stars: 5 },
    { name: 'সালমা বেগম', location: 'চট্টগ্রাম', initial: 'সা', text: 'ব্ল্যাক টি এর সুগন্ধ অসাধারণ। প্রতিদিন সকালে এক কাপ দিয়ে দিন শুরু করি। ডেলিভারিও খুব দ্রুত।', stars: 5 },
    { name: 'তানভীর রহমান', location: 'ঢাকা', initial: 'তা', text: 'বন্ধুর কাছ থেকে শুনে অর্ডার করেছিলাম। এখন নিজেই সবাইকে রেকমেন্ড করি। প্রিমিয়াম কোয়ালিটি চা।', stars: 4 },
    { name: 'মাহমুদা ইসলাম', location: 'বরিশাল', initial: 'মা', text: 'গ্রিন টি দিয়ে ডায়েট শুরু করেছি। স্বাদ হালকা কিন্তু তৃপ্তিদায়ক। ওজন কমাতেও সাহায্য করছে।', stars: 5 },
];

// Duplicate for seamless scroll
const allReviews = computed(() => [...reviews, ...reviews]);
</script>

<style scoped>
@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.animate-scroll {
    animation: scroll 40s linear infinite;
}
.animate-scroll:hover {
    animation-play-state: paused;
}
</style>
