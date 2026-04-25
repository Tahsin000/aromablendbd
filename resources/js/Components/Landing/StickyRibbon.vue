<template>
    <div v-if="showRibbon" :class="[
        'fixed top-0 left-0 right-0 z-50 shadow-lg transition-transform duration-300',
        isDismissed ? '-translate-y-full' : 'translate-y-0'
    ]">
        <div class="relative overflow-hidden" :class="ribbonBgClass">
            <div class="absolute inset-0 opacity-20">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent -translate-x-full animate-shimmer"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 py-3">
                <div class="flex items-center justify-center gap-3 sm:gap-6 text-white text-sm">
                    <span class="inline-flex items-center gap-1.5 bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full shrink-0 animate-pulse">
                        <TagIcon class="w-3.5 h-3.5" />
                        {{ currentText.badge_text }}
                    </span>

                    <span class="font-medium text-center transition-opacity duration-500 hidden sm:inline">
                        {{ currentText.promotion_text }}
                    </span>

                    <div v-if="showTimer && isTimerInRange" class="flex items-center gap-2 shrink-0">
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

                    <a :href="currentText.link_url"
                       class="hidden lg:inline-flex items-center gap-1 bg-white text-green-700 text-xs font-bold px-4 py-1.5 rounded-full hover:bg-yellow-300 hover:text-green-800 transition-all duration-300 transform hover:scale-105">
                        {{ currentText.cta }}
                        <ArrowRightIcon class="w-3 h-3" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div v-if="showRibbon && !isDismissed" class="h-[52px]"></div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import { TagIcon, ClockIcon, ArrowRightIcon } from '@heroicons/vue/24/solid';

const props = defineProps({
    content: { type: Object, default: () => ({}) },
});

const isDismissed = ref(false);
const countdown = ref({ hours: '00', minutes: '00', seconds: '00' });
const currentIndex = ref(0);
const isTimerInRange = ref(false);
let timer = null;
let rotationTimer = null;

const ribbonDefaults = {
    status: true,
    color: 'green',
    texts: [
        { badge_text: 'অফার', promotion_text: 'প্রথম অর্ডারে ২০% ছাড়!', cta: 'অফার দেখুন', link_url: '#offer' },
    ],
    timer: {
        enabled: false,
        countdown_label: '',
        start_date: '',
        end_date: '',
    },
};

const ribbonConfig = computed(() => ({
    ...ribbonDefaults,
    ...props.content,
    timer: { ...ribbonDefaults.timer, ...(props.content?.timer || {}) },
}));

const showRibbon = computed(() => {
    const s = ribbonConfig.value.status;
    return s === true || s === 'true' || s === 1;
});

const textsArray = computed(() => {
    const t = ribbonConfig.value.texts;
    return Array.isArray(t) && t.length > 0 ? t : ribbonDefaults.texts;
});

const currentText = computed(() => textsArray.value[currentIndex.value % textsArray.value.length]);

const showTimer = computed(() => ribbonConfig.value.timer?.enabled === true);

const ribbonBgClass = computed(() => {
    const color = ribbonConfig.value.color || 'green';
    const map = {
        green: 'bg-gradient-to-r from-green-700 via-emerald-700 to-teal-700',
        red: 'bg-gradient-to-r from-red-700 via-rose-700 to-pink-700',
        yellow: 'bg-gradient-to-r from-yellow-600 via-amber-600 to-orange-600',
        blue: 'bg-gradient-to-r from-blue-700 via-indigo-700 to-violet-700',
    };
    return map[color] || map.green;
});

function pad(n) { return String(n).padStart(2, '0'); }

function checkTimerRange() {
    const { start_date, end_date } = ribbonConfig.value.timer;
    if (!start_date || !end_date) { isTimerInRange.value = true; return; }
    const today = new Date(); today.setHours(0, 0, 0, 0);
    const start = new Date(start_date + 'T00:00:00');
    const end = new Date(end_date + 'T23:59:59');
    isTimerInRange.value = today >= start && today <= end;
}

function updateCountdown() {
    if (!isTimerInRange.value) { countdown.value = { hours: '00', minutes: '00', seconds: '00' }; return; }
    const end = new Date(ribbonConfig.value.timer.end_date + 'T23:59:59');
    const diff = Math.max(0, end - new Date());
    const h = Math.floor(diff / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);
    countdown.value = { hours: pad(h), minutes: pad(m), seconds: pad(s) };
}

function rotateText() {
    if (textsArray.value.length > 1) {
        currentIndex.value = (currentIndex.value + 1) % textsArray.value.length;
    }
}

onMounted(() => {
    checkTimerRange();
    if (showTimer.value) updateCountdown();
    timer = setInterval(() => { if (showTimer.value) updateCountdown(); }, 1000);
    if (textsArray.value.length > 1) {
        rotationTimer = setInterval(rotateText, 5000);
    }
});

onUnmounted(() => {
    if (timer) clearInterval(timer);
    if (rotationTimer) clearInterval(rotationTimer);
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
