<template>
    <section class="bg-white py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm uppercase tracking-wider">
                    <MapIcon class="w-4 h-4" />
                    আমাদের যাত্রা
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-3">
                    বাগান থেকে <span class="text-green-600">আপনার কাপ</span> পর্যন্ত
                </h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto text-lg">
                    সিলেটের পাহাড় থেকে আপনার টেবিলে - প্রতিটি ধাপে যত্ন ও ভালোবাসা
                </p>
            </div>

            <!-- Timeline -->
            <div class="relative">
                <!-- Center line -->
                <div class="absolute left-1/2 transform -translate-x-0.5 h-full w-0.5 bg-green-200 hidden lg:block"></div>

                <div class="space-y-12 lg:space-y-0">
                    <div v-for="(step, i) in steps" :key="i"
                         class="lg:grid lg:grid-cols-2 lg:gap-8 items-center scroll-reveal"
                         :style="`animation-delay: ${i * 0.2}s`">
                        <!-- Left content -->
                        <div :class="`relative ${i % 2 === 0 ? 'lg:text-right lg:pr-12' : 'lg:col-start-2 lg:text-left lg:pl-12'}`">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-3 mb-3" :class="i % 2 === 0 ? 'lg:justify-end' : ''">
                                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                        <component :is="step.icon" class="w-6 h-6 text-green-600" />
                                    </div>
                                    <span class="text-xs font-bold text-green-600 bg-green-100 px-2 py-1 rounded-full">ধাপ {{ i + 1 }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ step.title }}</h3>
                                <p class="text-gray-600 text-sm">{{ step.desc }}</p>
                            </div>
                        </div>

                        <!-- Right image -->
                        <div :class="`relative mt-4 lg:mt-0 ${i % 2 === 0 ? '' : 'lg:col-start-2'}`">
                            <div class="aspect-video rounded-2xl overflow-hidden shadow-lg bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center">
                                <svg class="w-24 h-24 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="step.svgPath" />
                                </svg>
                            </div>
                        </div>

                        <!-- Center dot (lg only) -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 top-6 w-4 h-4 bg-green-600 rounded-full border-4 border-white shadow hidden lg:block"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import {
    MapIcon, SunIcon, HandRaisedIcon, FireIcon,
    CubeIcon, TruckIcon, HeartIcon,
} from '@heroicons/vue/24/outline';

const steps = [
    {
        icon: SunIcon,
        title: 'পাহাড়ি বাগানে জন্ম',
        desc: 'সিলেটের ২০০০ ফুট উচ্চতায় অবস্থিত আমাদের জৈব চা বাগানে প্রাকৃতিক পরিবেশে চা পাতা জন্মায়। বৃষ্টি, কুয়াশা আর মাটির মিশ্রণে তৈরি হয় অনন্য স্বাদ।',
        svgPath: 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z',
    },
    {
        icon: HandRaisedIcon,
        title: 'হাতে সংগ্রহ',
        desc: 'অভিজ্ঞ বাগান কর্মীরা প্রতিটি পাতা যত্ন সহকারে হাতে তোলেন। শুধু দুটি পাতা আর একটি কুঁড়ি - সেরা মান নিশ্চিত করতে।',
        svgPath: 'M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75z',
    },
    {
        icon: FireIcon,
        title: 'প্রক্রিয়াকরণ',
        desc: 'তোলা পাতা দ্রুত প্রক্রিয়াকরণ কেন্দ্রে পাঠানো হয়। অক্সিডেশন, রোলিং ও ড্রাইয়িং - প্রতিটি ধাপে বিশেষজ্ঞ নজরদারি।',
        svgPath: 'M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z',
    },
    {
        icon: CubeIcon,
        title: 'ভ্যাকুয়াম প্যাকেজিং',
        desc: 'তাজা চা পাতা ভ্যাকুয়াম সিল প্যাকেজিং করা হয় যাতে স্বাদ, সুগন্ধ ও গুণমান দীর্ঘস্থায়ী হয়। প্রতিটি প্যাকেটে উৎপাদনের তারিখ দেওয়া থাকে।',
        svgPath: 'M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z',
    },
    {
        icon: TruckIcon,
        title: 'আপনার দরজায় ডেলিভারি',
        desc: 'প্যাকেজিং শেষে ২৪ ঘন্টার মধ্যে ডেলিভারি পাঠানো হয়। চট্টগ্রামে ১-২ দিন, সারাদেশে ৩-৫ দিনের মধ্যে পৌঁছে যায়।',
        svgPath: 'M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12',
    },
    {
        icon: HeartIcon,
        title: 'আপনার কাপে ভালোবাসা',
        desc: 'সবশেষে - একটি গরম কাপে ঢেলে নিন। প্রতিটি চুমুকে পাবেন সিলেটের পাহাড়ের স্বাদ, বাগানের সুগন্ধ আর প্রকৃতির আশীর্বাদ।',
        svgPath: 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z',
    },
];
</script>
