<template>
    <component
        :is="as"
        :type="type"
        :href="href"
        :disabled="disabled"
        :class="[
            'relative overflow-hidden',
            baseClasses,
            sizeClasses,
            variantClasses,
            disabledClasses,
            animationClasses,
            className
        ]"
        @click="handleClick"
        @mouseenter="isHovering = true"
        @mouseleave="isHovering = false"
    >
        <!-- Ripple effect -->
        <span
            v-for="ripple in ripples"
            :key="ripple.id"
            class="ripple"
            :style="{
                left: `${ripple.x}px`,
                top: `${ripple.y}px`,
                width: `${ripple.size}px`,
                height: `${ripple.size}px`
            }"
        ></span>

        <!-- Loading spinner -->
        <svg
            v-if="loading"
            class="animate-spin -ml-1 mr-2 h-5 w-5"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
        >
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>

        <!-- Icon slot -->
        <slot name="icon"></slot>

        <!-- Default slot for button text/content -->
        <slot></slot>

        <!-- FOMO pulse overlay -->
        <span v-if="fomoPulse" class="fomo-pulse"></span>
    </component>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    as: { type: String, default: 'button' },
    href: { type: String, default: null },
    type: { type: String, default: 'button' },
    variant: { type: String, default: 'primary' },
    size: { type: String, default: 'md' },
    autoWidth: { type: Boolean, default: false },
    disabled: { type: Boolean, default: false },
    loading: { type: Boolean, default: false },
    fomoPulse: { type: Boolean, default: false },
    attentionSeeker: { type: Boolean, default: false },
    bounceOnHover: { type: Boolean, default: true },
    scaleOnClick: { type: Boolean, default: true },
    ripple: { type: Boolean, default: true },
    className: { type: String, default: '' }
});

const emit = defineEmits(['click']);

const isHovering = ref(false);
const ripples = ref([]);
let rippleId = 0;

const baseClasses = 'font-bold flex items-center justify-center gap-2 transition-all duration-300 rounded-xl shadow-lg';

const sizeClasses = computed(() => {
    if (props.autoWidth) return 'px-8 py-3.5 text-lg inline-flex';
    switch (props.size) {
        case 'sm': return 'px-3 py-2 text-xs w-full';
        case 'lg': return 'w-full py-4 text-lg';
        default: return 'w-full py-3.5 text-base sm:text-lg';
    }
});

const variantClasses = computed(() => {
    switch (props.variant) {
        case 'secondary':
            return 'bg-white hover:bg-yellow-300 hover:text-green-800 text-green-600';
        case 'outline':
            return 'bg-transparent hover:bg-green-50 text-green-600 border-2 border-green-600';
        default:
            return 'bg-green-600 hover:bg-green-700 text-white hover:shadow-xl';
    }
});

const disabledClasses = computed(() => {
    if (props.disabled) {
        return 'opacity-60 cursor-not-allowed transform-none';
    }
    return '';
});

const animationClasses = computed(() => {
    if (props.disabled) return '';
    const classes = [];
    if (props.attentionSeeker) classes.push('animate-attention-seeker');
    if (props.bounceOnHover) classes.push('hover:-translate-y-1');
    if (props.scaleOnClick) classes.push('active:scale-95');
    return classes.join(' ');
});

function handleClick(event) {
    if (props.disabled || props.loading) return;

    if (props.ripple) {
        const rect = event.currentTarget.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        ripples.value.push({
            id: rippleId++,
            x: event.clientX - rect.left - size / 2,
            y: event.clientY - rect.top - size / 2,
            size
        });

        setTimeout(() => {
            ripples.value = ripples.value.slice(1);
        }, 600);
    }

    emit('click', event);
}
</script>

<style scoped>
.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: scale(0);
    animation: ripple-effect 0.6s ease-out;
    pointer-events: none;
}

@keyframes ripple-effect {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

.fomo-pulse {
    position: absolute;
    inset: 0;
    border-radius: inherit;
    animation: fomo-pulse 2s ease-in-out infinite;
    pointer-events: none;
}

@keyframes fomo-pulse {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
    }
    50% {
        box-shadow: 0 0 0 8px rgba(34, 197, 94, 0);
    }
}

.animate-attention-seeker {
    animation: attention-seeker 1.5s ease-in-out infinite;
    transform-origin: center;
}

@keyframes attention-seeker {
    0%, 100% {
        transform: scale(1) rotate(0deg);
    }
    20% {
        transform: scale(1.08) rotate(-2deg);
    }
    40% {
        transform: scale(1.08) rotate(2deg);
    }
    60% {
        transform: scale(1.08) rotate(-2deg);
    }
    80% {
        transform: scale(1.08) rotate(2deg);
    }
}
</style>
