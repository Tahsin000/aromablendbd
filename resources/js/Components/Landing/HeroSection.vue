<template>
    <section class="relative bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 overflow-hidden">
        <!-- Animated background blobs -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-green-300 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-300 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Content -->
                <div class="text-center lg:text-right" dir="rtl">
                    <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 text-sm font-medium px-4 py-2 rounded-full mb-6 animate-fade-in-up">
                        <LeafIcon class="w-4 h-4" />
                        ১০০% প্রাকৃতিক ও জৈব
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6 animate-fade-in-up">
                        সেরা মানের <span class="text-green-600">অর্গানিক চা</span>
                        <br>আপনার দরজায়
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-xl mx-auto lg:mx-0 animate-fade-in-up" style="animation-delay: 0.2s">
                        সিলেটের পাহাড়ি বাগান থেকে সংগ্রহ করা বিশুদ্ধ জৈব চা পাতা। কোনো রাসায়নিক সার নেই, কোনো কৃত্রিম স্বাদ নেই - শুধু প্রকৃতির আসল স্বাদ।
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-fade-in-up" style="animation-delay: 0.4s">
                        <a href="#products" class="group bg-green-600 hover:bg-green-700 text-white text-lg font-semibold px-8 py-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2">
                            পণ্য দেখুন
                            <ArrowDownIcon class="w-5 h-5 group-hover:translate-y-1 transition-transform" />
                        </a>
                        <a href="#offer" class="group bg-white hover:bg-gray-50 text-green-600 text-lg font-semibold px-8 py-4 rounded-lg border-2 border-green-600 hover:border-green-700 transition-all duration-300 flex items-center gap-2">
                            <TagIcon class="w-5 h-5" />
                            অফার দেখুন
                        </a>
                    </div>
                </div>

                <!-- Right: Tea Visual -->
                <div class="relative animate-fade-in-left">
                    <div class="aspect-square max-w-lg mx-auto relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-200 to-emerald-200 rounded-full opacity-30 blur-xl animate-pulse"></div>
                        <div class="relative bg-gradient-to-br from-amber-50 to-green-50 rounded-3xl p-8 shadow-2xl border border-green-100">
                            <div class="text-center">
                                <div class="w-32 h-32 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-20 h-20 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                                    </svg>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow group cursor-pointer" @click="$emit('go-product', 'green-tea')">
                                        <div class="w-12 h-12 mx-auto bg-green-50 rounded-lg flex items-center justify-center group-hover:bg-green-100 transition-colors">
                                            <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-2 font-medium">সবুজ চা</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow group cursor-pointer" @click="$emit('go-product', 'black-tea')">
                                        <div class="w-12 h-12 mx-auto bg-amber-50 rounded-lg flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                                            <svg class="w-8 h-8 text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-2 font-medium">কালো চা</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow group cursor-pointer" @click="$emit('go-product', 'floral-tea')">
                                        <div class="w-12 h-12 mx-auto bg-pink-50 rounded-lg flex items-center justify-center group-hover:bg-pink-100 transition-colors">
                                            <svg class="w-8 h-8 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-2 font-medium">ফুলের চা</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow group cursor-pointer" @click="$emit('go-product', 'combo-pack')">
                                        <div class="w-12 h-12 mx-auto bg-teal-50 rounded-lg flex items-center justify-center group-hover:bg-teal-100 transition-colors">
                                            <svg class="w-8 h-8 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-2 font-medium">হার্বাল চা</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave separator -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>
</template>

<script setup>
import { ArrowDownIcon, TagIcon } from '@heroicons/vue/24/outline';
const LeafIcon = { template: `<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c-1.5 0-2.8.4-3.9 1.1C5.3 6 4 9 4 12c0 5.5 3.8 8.5 8 8.5s8-3 8-8.5c0-3-1.3-6-4.1-7.9C14.8 3.4 13.5 3 12 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18"/></svg>` };
</script>

<style scoped>
@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fade-in-left {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}
.animate-fade-in-up { animation: fade-in-up 0.8s ease-out both; }
.animate-fade-in-left { animation: fade-in-left 1s ease-out both; }
</style>
