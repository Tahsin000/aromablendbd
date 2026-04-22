<template>
    <div ref="sliderRef" class="relative overflow-hidden rounded-2xl" @touchstart="onTouchStart" @touchmove="onTouchMove" @touchend="onTouchEnd" @mousedown="onDragStart">
        <!-- Track -->
        <div class="flex transition-transform duration-500 ease-out select-none"
             :style="{ transform: `translateX(-${translateX}%)`, cursor: isDragging ? 'grabbing' : 'grab' }">
            <div v-for="(item, i) in trackItems" :key="`${item.id}-${i}`"
                 :style="{ width: `${slideWidth}%`, flexShrink: 0 }"
                 class="px-3">
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1 border border-gray-100 group cursor-pointer h-full"
                     @click="!isDragging && goToProduct(item.id)"
                     @mouseenter="pauseAutoplay"
                     @mouseleave="resumeAutoplay">
                    <!-- Image -->
                    <div class="relative h-48 bg-gradient-to-br from-green-100 to-emerald-100 overflow-hidden">
                        <img :src="item.image" :alt="item.name"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                             loading="lazy" />
                        <!-- Badge -->
                        <span class="absolute top-3 left-3 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                            <TagIcon class="w-3 h-3" />
                            {{ item.badge }}
                        </span>
                        <!-- Discount Badge -->
                        <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            -{{ discountPercent(item) }}%
                        </span>
                        <!-- Stock urgency -->
                        <span v-if="item.stock <= 20" class="absolute bottom-3 left-3 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                            <FireIcon class="w-3 h-3" />
                           仅剩 {{ formatBangla(item.stock) }}টি
                        </span>
                    </div>
                    <!-- Content -->
                    <div class="p-5">
                        <h4 class="text-lg font-bold text-gray-900 mb-2">{{ item.name }}</h4>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ truncate(item.desc) }}</p>
                        <!-- Price -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline gap-2">
                                <span class="text-2xl font-bold text-green-600">{{ formatBangla(item.price) }}৳</span>
                                <span class="text-sm text-gray-400 line-through">{{ formatBangla(item.original_price) }}৳</span>
                            </div>
                            <button class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors flex items-center gap-1">
                                <ShoppingBagIcon class="w-4 h-4" />
                                দেখুন
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button v-if="canGoPrev" @click="prev"
                class="absolute left-1 top-1/2 -translate-y-1/2 -translate-x-2 bg-white shadow-lg rounded-full p-2 hover:bg-gray-50 transition-colors z-10 group">
            <ChevronLeftIcon class="w-5 h-5 text-gray-700 group-hover:text-green-600 transition-colors" />
        </button>
        <button v-if="canGoNext" @click="next"
                class="absolute right-1 top-1/2 -translate-y-1/2 translate-x-2 bg-white shadow-lg rounded-full p-2 hover:bg-gray-50 transition-colors z-10 group">
            <ChevronRightIcon class="w-5 h-5 text-gray-700 group-hover:text-green-600 transition-colors" />
        </button>

        <!-- Dots -->
        <div class="flex justify-center gap-2 mt-6">
            <button v-for="i in totalDots" :key="i"
                    @click="goToSlide(i - 1)"
                    :class="`rounded-full transition-all duration-300 ${i - 1 === activeDot ? 'bg-green-600 w-8 h-3' : 'bg-gray-300 w-3 h-3'}`" />
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { TagIcon, ShoppingBagIcon, ChevronLeftIcon, ChevronRightIcon, FireIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    products: { type: Array, required: true },
    slidesPerView: { type: Number, default: 3 },
    autoplayInterval: { type: Number, default: 4000 },
});

const currentSlide = ref(0);
const isDragging = ref(false);
const dragStartX = ref(0);
const dragOffset = ref(0);
let autoplayTimer = null;

// Infinite loop: clone first/last items
const trackItems = computed(() => {
    const p = props.products;
    if (p.length <= props.slidesPerView) return p;
    return [...p.slice(-props.slidesPerView), ...p, ...p.slice(0, props.slidesPerView)];
});

const slidesPerView = computed(() => props.slidesPerView);
const totalSlides = computed(() => props.products.length);
const slideWidth = computed(() => 100 / slidesPerView.value);

// Offset for cloned items
const realStart = computed(() => props.slidesPerView);
const realEnd = computed(() => props.products.length + props.slidesPerView - 1);

const translateX = computed(() => {
    const total = trackItems.value.length;
    return (currentSlide.value / total) * 100;
});

const activeDot = computed(() => {
    let idx = currentSlide.value - props.slidesPerView;
    if (idx < 0) idx += props.products.length;
    return idx % props.products.length;
});

const totalDots = computed(() => props.products.length);
const canGoNext = computed(() => props.products.length > props.slidesPerView);
const canGoPrev = computed(() => props.products.length > props.slidesPerView);

function next() {
    currentSlide.value++;
    // Infinite loop reset
    if (currentSlide.value >= realEnd.value) {
        setTimeout(() => {
            currentSlide.value = props.slidesPerView;
        }, 500);
    }
}

function prev() {
    currentSlide.value--;
    if (currentSlide.value < 0) {
        setTimeout(() => {
            currentSlide.value = realEnd.value - 1;
        }, 500);
    }
}

function goToSlide(dotIndex) {
    currentSlide.value = dotIndex + props.slidesPerView;
}

function goToProduct(id) {
    router.visit(`/product/${id}`);
}

// Autoplay
function startAutoplay() {
    stopAutoplay();
    autoplayTimer = setInterval(next, props.autoplayInterval);
}
function stopAutoplay() { if (autoplayTimer) clearInterval(autoplayTimer); }
function pauseAutoplay() { stopAutoplay(); }
function resumeAutoplay() { startAutoplay(); }

// Touch/Swipe
function onTouchStart(e) { dragStartX.value = e.touches[0].clientX; }
function onTouchMove(e) { dragOffset.value = e.touches[0].clientX - dragStartX.value; }
function onTouchEnd() { handleSwipeEnd(dragOffset.value); dragOffset.value = 0; }

// Mouse drag
function onDragStart(e) {
    if (e.button !== 0) return;
    isDragging.value = true;
    dragStartX.value = e.clientX;
    pauseAutoplay();

    const move = (ev) => { dragOffset.value = ev.clientX - dragStartX.value; };
    const up = () => {
        isDragging.value = false;
        handleSwipeEnd(dragOffset.value);
        dragOffset.value = 0;
        resumeAutoplay();
        document.removeEventListener('mousemove', move);
        document.removeEventListener('mouseup', up);
    };
    document.addEventListener('mousemove', move);
    document.addEventListener('mouseup', up);
}

function handleSwipeEnd(offset) {
    const threshold = 50;
    if (offset < -threshold) next();
    else if (offset > threshold) prev();
}

// Utilities
function discountPercent(item) {
    return Math.round((1 - item.price / item.original_price) * 100);
}
function formatBangla(n) {
    const b = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return String(n).replace(/\d/g, d => b[d]);
}
function truncate(text, len = 70) {
    return text.length > len ? text.substring(0, len) + '...' : text;
}

onMounted(() => {
    // Initialize to first real slide (after clones)
    currentSlide.value = props.slidesPerView;
    startAutoplay();
});
onUnmounted(() => stopAutoplay());
</script>
