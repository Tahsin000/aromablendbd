<template>
    <section id="contact" class="bg-gradient-to-br from-gray-50 to-green-50 py-20 lg:py-28">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm uppercase tracking-wider">
                    <PaperAirplaneIcon class="w-4 h-4" />
                    {{ c.badge }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-3" v-html="c.title_1 + '<span class=text-green-600>' + c.title_highlight + '</span>' + c.title_2">
                </h2>
                <p class="text-gray-600 mt-4 text-lg">
                    {{ c.description }}
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10 border border-gray-100 scroll-reveal">
                <form @submit.prevent="submitForm" class="space-y-6">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ c.form_name }}</label>
                            <input v-model="form.name" type="text" required :placeholder="c.form_name_placeholder"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ c.form_phone }}</label>
                            <input v-model="form.phone" type="tel" required :placeholder="c.form_phone_placeholder"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ c.form_email }}</label>
                        <input v-model="form.email" type="email" :placeholder="c.form_email_placeholder"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ c.form_address }}</label>
                        <textarea v-model="form.address" required rows="3" :placeholder="c.form_address_placeholder"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ c.form_city }}</label>
                        <select v-model="form.city" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            <option value="">{{ c.form_city_placeholder }}</option>
                            <option value="chittagong">{{ c.city_chittagong }}</option>
                            <option value="outside">{{ c.city_outside }}</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ c.form_product }}</label>
                        <select v-model="form.product" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            <option value="">{{ c.form_product_placeholder }}</option>
                            <option v-for="p in productsList" :key="p.id" :value="p.id">{{ p.name }} ({{ p.price }}৳)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ c.form_quantity }}</label>
                        <div class="flex items-center gap-3">
                            <button type="button" @click="form.quantity = Math.max(1, form.quantity - 1)"
                                    class="w-10 h-10 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors flex items-center justify-center text-lg font-bold">-</button>
                            <input v-model.number="form.quantity" type="number" min="1"
                                   class="w-20 text-center px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                            <button type="button" @click="form.quantity++"
                                    class="w-10 h-10 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors flex items-center justify-center text-lg font-bold">+</button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ c.form_message }}</label>
                        <textarea v-model="form.message" rows="2" :placeholder="c.form_message_placeholder"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none"></textarea>
                    </div>

                    <!-- Order Summary -->
                    <div v-if="selectedProduct" class="bg-green-50 border border-green-200 rounded-xl p-4">
                        <h4 class="font-bold text-green-800 mb-2">{{ c.summary_title }}</h4>
                        <div class="space-y-1 text-sm text-green-700">
                            <div class="flex justify-between"><span>{{ selectedProduct.name }} × {{ form.quantity }}</span><span>{{ subtotal }}৳</span></div>
                            <div class="flex justify-between"><span>প্রথম অর্ডার ছাড় (২০%)</span><span class="text-red-600">-{{ discount }}৳</span></div>
                            <div class="flex justify-between"><span>ডেলিভারি ({{ form.city === 'chittagong' ? 'চট্টগ্রাম' : 'বাইরে' }})</span><span>{{ deliveryCharge }}৳</span></div>
                            <div class="flex justify-between font-bold text-base pt-2 border-t border-green-200"><span>মোট</span><span>{{ total }}৳</span></div>
                        </div>
                    </div>

                    <!-- Captcha -->
                    <div v-if="captchaEnabled" class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Human Verification</p>
                        <div ref="captchaContainer" class="min-h-[78px]"></div>
                        <p v-if="captchaError" class="mt-2 text-sm text-red-600">{{ captchaError }}</p>
                        <button v-if="captchaError"
                                type="button"
                                @click="renderCaptcha"
                                :disabled="isCaptchaRendering"
                                class="mt-2 text-xs font-semibold text-green-700 hover:text-green-800 disabled:text-gray-400">
                            Retry captcha
                        </button>
                    </div>

                    <AnimatedButton
                        type="submit"
                        :attention-seeker="true"
                        :disabled="isSubmitting || (captchaEnabled && !captchaToken)"
                        :loading="isSubmitting"
                        size="lg"
                    >
                        <template #icon>
                            <PaperAirplaneIcon class="w-5 h-5" />
                        </template>
                        {{ c.submit_button }}
                    </AnimatedButton>

                    <p class="text-xs text-gray-500 text-center">
                        {{ c.privacy_note }}
                    </p>
                </form>

                <!-- Success message -->
                <div v-if="success" class="mt-6 bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                    <p class="text-green-800 font-medium">{{ c.success_title }}</p>
                    <p class="text-green-600 text-sm mt-1">{{ c.success_message }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, reactive, computed, watch, nextTick, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import { PaperAirplaneIcon } from '@heroicons/vue/24/outline';
import AnimatedButton from '../AnimatedButton.vue';

const props = defineProps({
    products: { type: Object, required: true },
    content: { type: Object, default: () => ({}) },
    captcha: { type: Object, default: () => ({ enabled: false, site_key: '' }) },
});

const success = ref(false);
const isSubmitting = ref(false);
const form = reactive({
    name: '', phone: '', email: '', address: '',
    city: '', product: '', quantity: 1, message: ''
});

// Captcha state
const captchaContainer = ref(null);
const captchaWidgetId = ref(null);
const captchaToken = ref('');
const captchaError = ref('');
const isCaptchaRendering = ref(false);
const captchaEnabled = computed(() => Boolean(props.captcha?.enabled && props.captcha?.site_key));
let recaptchaLoadPromise = null;

const productsList = computed(() => Object.values(props.products));

const c = computed(() => ({
    badge: 'যোগাযোগ',
    title_1: 'অর্ডার করতে ',
    title_highlight: 'ফর্ম',
    title_2: ' পূরণ করুন',
    description: 'আপনার তথ্য দিন - আমরা দ্রুত যোগাযোগ করবো',
    form_name: 'আপনার নাম *',
    form_name_placeholder: 'পূর্ণ নাম লিখুন',
    form_phone: 'মোবাইল নম্বর *',
    form_phone_placeholder: '০১XXXXXXXXX',
    form_email: 'ইমেইল',
    form_email_placeholder: 'example@email.com',
    form_address: 'ঠিকানা *',
    form_address_placeholder: 'সম্পূর্ণ ঠিকানা লিখুন',
    form_city: 'শহর *',
    form_city_placeholder: '-- শহর নির্বাচন করুন --',
    city_chittagong: 'চট্টগ্রাম (ডেলিভারি: ৬০৳)',
    city_outside: 'চট্টগ্রামের বাইরে (ডেলিভারি: ১২০৳)',
    form_product: 'পছন্দের পণ্য *',
    form_product_placeholder: '-- পণ্য নির্বাচন করুন --',
    form_quantity: 'পরিমাণ',
    form_message: 'বিশেষ অনুরোধ',
    form_message_placeholder: 'কোনো বিশেষ অনুরোধ থাকলে লিখুন',
    summary_title: 'অর্ডার সারাংশ',
    submit_button: 'অর্ডার সাবমিট করুন',
    privacy_note: '',
    success_title: 'ধন্যবাদ! আপনার অর্ডার সফলভাবে জমা হয়েছে।',
    success_message: 'আমরা শীঘ্রই আপনার সাথে যোগাযোগ করবো।',
    ...props.content,
}));
const selectedProduct = computed(() => productsList.value.find(p => p.id === form.product));
const deliveryCharge = computed(() => form.city === 'chittagong' ? 60 : 120);
const subtotal = computed(() => selectedProduct.value ? selectedProduct.value.price * form.quantity : 0);
const discount = computed(() => Math.round(subtotal.value * 0.20));
const total = computed(() => subtotal.value - discount.value + deliveryCharge.value);

// Captcha functions (cloned from Checkout.vue)
function onCaptchaSuccess(token) {
    captchaToken.value = token || '';
    captchaError.value = '';
}

function onCaptchaExpired() {
    captchaToken.value = '';
}

function onCaptchaError() {
    captchaToken.value = '';
    captchaError.value = 'Captcha could not be verified. Please try again.';
}

function loadRecaptchaScript() {
    if (window.grecaptcha?.render) {
        return Promise.resolve(window.grecaptcha);
    }
    if (recaptchaLoadPromise) {
        return recaptchaLoadPromise;
    }
    const waitForApi = () => new Promise((resolve, reject) => {
        let attempts = 0;
        const maxAttempts = 80;
        const interval = setInterval(() => {
            if (window.grecaptcha?.render) {
                clearInterval(interval);
                resolve(window.grecaptcha);
                return;
            }
            attempts++;
            if (attempts >= maxAttempts) {
                clearInterval(interval);
                reject(new Error('reCAPTCHA API did not become ready in time.'));
            }
        }, 100);
    });
    recaptchaLoadPromise = new Promise((resolve, reject) => {
        const existing = document.querySelector('script[data-recaptcha="contact"]');
        if (existing) {
            waitForApi().then(resolve).catch(reject);
            return;
        }
        const script = document.createElement('script');
        script.src = 'https://www.google.com/recaptcha/api.js?render=explicit';
        script.async = true;
        script.defer = true;
        script.dataset.recaptcha = 'contact';
        script.onload = () => {
            waitForApi().then(resolve).catch(reject);
        };
        script.onerror = () => reject(new Error('Failed to load captcha script.'));
        document.head.appendChild(script);
    }).finally(() => {
        if (!window.grecaptcha?.render) {
            recaptchaLoadPromise = null;
        }
    });
    return recaptchaLoadPromise;
}

async function renderCaptcha() {
    if (!captchaEnabled.value || isCaptchaRendering.value || captchaWidgetId.value !== null) return;
    isCaptchaRendering.value = true;
    await nextTick();
    if (!captchaContainer.value) {
        isCaptchaRendering.value = false;
        return;
    }
    try {
        await loadRecaptchaScript();
        if (!window.grecaptcha) return;
        captchaContainer.value.innerHTML = '';
        captchaWidgetId.value = window.grecaptcha.render(captchaContainer.value, {
            sitekey: String(props.captcha.site_key || '').trim(),
            callback: onCaptchaSuccess,
            'expired-callback': onCaptchaExpired,
            'error-callback': onCaptchaError,
        });
    } catch (error) {
        captchaWidgetId.value = null;
        captchaError.value = 'Captcha is unavailable right now. Please try again in a moment.';
    } finally {
        isCaptchaRendering.value = false;
    }
}

function resetCaptcha() {
    captchaToken.value = '';
    if (window.grecaptcha && captchaWidgetId.value !== null) {
        window.grecaptcha.reset(captchaWidgetId.value);
    }
}

onMounted(async () => {
    if (captchaEnabled.value) {
        await renderCaptcha();
    }
});

async function submitForm() {
    if (captchaEnabled.value && !captchaToken.value) {
        captchaError.value = 'Please complete the captcha before placing the order.';
        return;
    }

    isSubmitting.value = true;
    captchaError.value = '';

    router.post('/checkout', {
        name: form.name,
        phone: form.phone,
        email: form.email || null,
        address: form.address,
        city: form.city,
        payment_method: 'cod',
        payment_number: null,
        transaction_id: null,
        captcha_token: captchaToken.value || null,
        items: [{
            product_id: form.product,
            quantity: form.quantity,
            unit_price: selectedProduct.value?.price || 0,
        }],
        notes: form.message || null,
    }, {
        onError: (errors) => {
            if (errors?.captcha_token) {
                captchaError.value = errors.captcha_token;
            }
            if (captchaEnabled.value) {
                resetCaptcha();
            }
        },
        onFinish: () => {
            isSubmitting.value = false;
        },
    });
}
</script>
