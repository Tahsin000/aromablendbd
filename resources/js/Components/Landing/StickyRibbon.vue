<template>
    <div :class="[
        'fixed top-0 left-0 right-0 z-50 shadow-lg transition-transform duration-300',
        isDismissed ? '-translate-y-full' : 'translate-y-0'
    ]">
        <!-- Gradient background with shimmer -->
        <div class="relative bg-gradient-to-r from-green-700 via-emerald-700 to-teal-700 overflow-hidden">
            <!-- Shimmer animation -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent -translate-x-full animate-shimmer"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 py-3">
                <div class="flex items-center justify-center gap-3 sm:gap-6 text-white text-sm">
                    <!-- Promo badge -->
                    <span class="inline-flex items-center gap-1.5 bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full shrink-0 animate-pulse">
                        <TagIcon class="w-3.5 h-3.5" />
                        {{ currentMessage.badge }}
                    </span>

                    <!-- Rotating message -->
                    <span class="font-medium text-center transition-opacity duration-500 hidden sm:inline">
                        {{ currentMessage.text }}
                    </span>

                    <!-- Countdown -->
                    <div class="flex items-center gap-2 shrink-0">
                        <ClockIcon class="w-4 h-4 text-yellow-300 hidden sm:block" />
                        <div class="flex gap-1.5">
                            <div v-for="(unit, key) in countdown" :key="key" class="flex items-center">
                                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 min-w-[36px] text-center">
                                    <span class="font-mono font-bold text-sm">{{ unit }}</span>
                                </div>
                                <span v-if="key !== 'seconds'" class="text-yellow-300 mx-0.5 font-bold">:</span>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <a :href="currentMessage.link"
                       class="hidden lg:inline-flex items-center gap-1 bg-white text-green-700 text-xs font-bold px-4 py-1.5 rounded-full hover:bg-yellow-300 hover:text-green-800 transition-all duration-300 transform hover:scale-105">
                        {{ currentMessage.cta }}
                        <ArrowRightIcon class="w-3 h-3" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Spacer to prevent content overlap -->
    <div v-if="!isDismissed" class="h-[52px]"></div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { TagIcon, ClockIcon, ArrowRightIcon, XMarkIcon } from '@heroicons/vue/24/solid';

const isDismissed = ref(false);
const messageIndex = ref(0);
const countdown = ref({ hours: '00', minutes: '00', seconds: '00' });
let timer = null;
let messageTimer = null;

const messages = [
    {
        badge: 'অফার',
        text: 'প্রথম অর্ডারে ২০% ছাড়! সিলেটের সেরা জৈব চা এখন আপনার দোরগোড়ায়',
        link: '/#offer',
        cta: 'অফার দেখুন',
    },
    {
        badge: 'ফ্রি ডেলিভারি',
        text: '৫০০৳ এর উপরে অর্ডারে ফ্রি ডেলিভারি - সারাদেশে ৩-৫ দিনের মধ্যে',
        link: '/#products',
        cta: 'পণ্য দেখুন',
    },
    {
        badge: 'সীমিত স্টক',
        text: 'ফ্লোরাল হার্বাল ১৮টি বাকি - তাড়াহুড়ো করুন, শেষ হয়ে যাবে!',
        link: '/product/floral-tea',
        cta: 'এখনই নিন',
    },
    {
        badge: 'মানি-ব্যাক',
        text: '৭ দিনের মানি-ব্যাক গ্যারান্টি - পছন্দ না হলে ফেরত, ঝুঁকি মুক্ত!',
        link: '/#contact',
        cta: 'অর্ডার করুন',
    },
];

const currentMessage = computed(() => messages[messageIndex.value]);

function pad(n) { return String(n).padStart(2, '0'); }

function updateCountdown() {
    const end = new Date();
    end.setHours(23, 59, 59, 0);
    const diff = Math.max(0, end - new Date());
    const h = Math.floor(diff / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);
    countdown.value = { hours: pad(h), minutes: pad(m), seconds: pad(s) };
}

function rotateMessage() {
    messageIndex.value = (messageIndex.value + 1) % messages.length;
}

function dismiss() {
    isDismissed.value = true;
}

onMounted(() => {
    updateCountdown();
    timer = setInterval(updateCountdown, 1000);
    messageTimer = setInterval(rotateMessage, 5000);
});

onUnmounted(() => {
    if (timer) clearInterval(timer);
    if (messageTimer) clearInterval(messageTimer);
});
</script>

<style scoped>
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(200%); }
}
.animate-shimmer {
    animation: shimmer 3s infinite;
}
</style>
