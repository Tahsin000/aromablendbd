<template>
    <div class="min-h-screen flex flex-col">
        <main class="flex-1">
            <slot />
        </main>

        <FooterSection v-if="showFooter" :content="footerContent" />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import FooterSection from '../Components/Landing/FooterSection.vue';

const page = usePage();

const footerContent = computed(() => page.props.site?.footer ?? null);

const showFooter = computed(() => {
    const footer = footerContent.value;
    if (!footer || typeof footer !== 'object') {
        return false;
    }

    if (!Object.prototype.hasOwnProperty.call(footer, 'status')) {
        return true;
    }

    const status = footer.status;
    return status === true || status === 'true' || status === 1 || status === '1';
});
</script>
