<template>
    <Head title="চেকআউট - অর্গানিক চা" />
    <div class="min-h-screen bg-gray-50">
        <StickyRibbon />

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 mt-12">
            <!-- Back link -->
            <a href="/" class="inline-flex items-center gap-2 text-gray-600 hover:text-green-600 transition-colors mb-6">
                <ArrowLeftIcon class="w-4 h-4" />
                হোমে ফিরুন
            </a>

            <h1 class="text-3xl font-bold text-gray-900 mb-8">চেকআউট</h1>

            <!-- Steps indicator -->
            <div class="flex items-center justify-center mb-10">
                <div v-for="(step, i) in steps" :key="i" class="flex items-center">
                    <div :class="`flex items-center gap-2 ${i + 1 <= currentStep ? 'text-green-600' : 'text-gray-400'}`">
                        <div :class="`w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all ${i + 1 < currentStep ? 'bg-green-600 text-white' : i + 1 === currentStep ? 'bg-green-100 text-green-700 ring-2 ring-green-600' : 'bg-gray-200 text-gray-500'}`">
                            <CheckIcon v-if="i + 1 < currentStep" class="w-4 h-4" />
                            <span v-else>{{ formatBangla(i + 1) }}</span>
                        </div>
                        <span class="text-sm font-medium hidden sm:inline">{{ step }}</span>
                    </div>
                    <div v-if="i < steps.length - 1" :class="`w-12 sm:w-20 h-0.5 mx-2 ${i + 1 < currentStep ? 'bg-green-600' : 'bg-gray-200'}`"></div>
                </div>
            </div>

            <div class="grid lg:grid-cols-5 gap-8">
                <!-- Order Form (3 cols) -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Step 1: Select Products -->
                    <div v-if="currentStep === 1" class="bg-white rounded-2xl shadow-sm p-6 sm:p-8 border border-gray-100 scroll-reveal">
                        <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <ShoppingBagIcon class="w-5 h-5 text-green-600" />
                            পণ্য নির্বাচন
                        </h2>

                        <div class="space-y-4 mb-6">
                            <div v-for="p in allProducts" :key="p.id"
                                 :class="`flex items-center gap-4 p-4 rounded-xl border-2 transition-all cursor-pointer hover:border-green-300 ${selectedProducts.find(s => s.id === p.id) ? 'border-green-600 bg-green-50' : 'border-gray-200'}`"
                                 @click="toggleProduct(p)">
                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-green-100">
                                    <img :src="p.image" :alt="p.name" class="w-full h-full object-cover" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-900 truncate">{{ p.name }}</h4>
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-green-600 font-bold">{{ formatBangla(p.price) }}৳</span>
                                        <span class="text-sm text-gray-400 line-through">{{ formatBangla(p.original_price) }}৳</span>
                                    </div>
                                </div>
                                <!-- Qty controls (only if selected) -->
                                <div v-if="selectedProducts.find(s => s.id === p.id)" class="flex items-center gap-2">
                                    <button @click.stop="updateItemQty(p.id, -1)"
                                            class="w-8 h-8 rounded-lg border-2 border-gray-200 hover:border-green-600 transition-colors flex items-center justify-center text-lg font-bold">-</button>
                                    <span class="w-8 text-center font-bold">{{ selectedProducts.find(s => s.id === p.id)?.quantity }}</span>
                                    <button @click.stop="updateItemQty(p.id, 1)"
                                            class="w-8 h-8 rounded-lg border-2 border-gray-200 hover:border-green-600 transition-colors flex items-center justify-center text-lg font-bold">+</button>
                                </div>
                                <div v-else class="w-8 h-8 rounded-full border-2 border-gray-300 flex items-center justify-center">
                                    <PlusIcon class="w-4 h-4 text-gray-400" />
                                </div>
                            </div>
                        </div>

                        <button @click="nextStep" :disabled="selectedProducts.length === 0"
                                :class="`w-full py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 transition-all ${selectedProducts.length > 0 ? 'bg-green-600 hover:bg-green-700 text-white shadow-lg' : 'bg-gray-200 text-gray-400 cursor-not-allowed'}`">
                            পরবর্তী ধাপ
                            <ArrowRightIcon class="w-5 h-5" />
                        </button>
                    </div>

                    <!-- Step 2: Delivery Info -->
                    <div v-if="currentStep === 2" class="bg-white rounded-2xl shadow-sm p-6 sm:p-8 border border-gray-100 scroll-reveal">
                        <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <TruckIcon class="w-5 h-5 text-green-600" />
                            ডেলিভারি তথ্য
                        </h2>
                        <form @submit.prevent="nextStep" class="space-y-5">
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">নাম *</label>
                                    <input v-model="form.name" type="text" required placeholder="আপনার নাম"
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">ফোন *</label>
                                    <input v-model="form.phone" type="tel" required placeholder="০১XXXXXXXXX"
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ইমেইল</label>
                                <input v-model="form.email" type="email" placeholder="example@email.com"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ঠিকানা *</label>
                                <textarea v-model="form.address" required rows="3" placeholder="বাড়ি নং, রোড, এলাকা"
                                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">শহর/এলাকা *</label>
                                <select v-model="form.city" required
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                                    <option value="">-- শহর নির্বাচন করুন --</option>
                                    <option value="chittagong">চট্টগ্রাম (ডেলিভারি: ৬০৳)</option>
                                    <option value="outside">চট্টগ্রামের বাইরে (ডেলিভারি: ১২০৳)</option>
                                </select>
                                <div v-if="form.city" class="mt-2 flex items-center gap-2 text-sm" :class="deliveryCharge === 60 ? 'text-green-600' : 'text-amber-600'">
                                    <MapPinIcon class="w-4 h-4" />
                                    <span>ডেলিভারি চার্জ: <strong>{{ formatBangla(deliveryCharge) }}৳</strong></span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">বিশেষ অনুরোধ</label>
                                <textarea v-model="form.notes" rows="2" placeholder="কোনো বিশেষ অনুরোধ থাকলে লিখুন"
                                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none"></textarea>
                            </div>
                            <div class="flex gap-3">
                                <button type="button" @click="currentStep = 1"
                                        class="px-6 py-4 rounded-xl border-2 border-gray-200 text-gray-600 hover:border-green-600 hover:text-green-600 font-bold transition-colors">
                                    পূর্ববর্তী
                                </button>
                                <button type="submit"
                                        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 shadow-lg transition-all">
                                    পরবর্তী ধাপ
                                    <ArrowRightIcon class="w-5 h-5" />
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Step 3: Payment & Confirm -->
                    <div v-if="currentStep === 3" class="bg-white rounded-2xl shadow-sm p-6 sm:p-8 border border-gray-100 scroll-reveal">
                        <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <CreditCardIcon class="w-5 h-5 text-green-600" />
                            পেমেন্ট ও নিশ্চিতকরণ
                        </h2>

                        <!-- Payment method selector -->
                        <div class="space-y-3 mb-6">
                            <h3 class="text-sm font-medium text-gray-700 mb-3">পেমেন্ট পদ্ধতি নির্বাচন করুন</h3>
                            <label v-for="method in paymentMethods" :key="method.id"
                                   :class="`flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all ${form.payment_method === method.id ? 'border-green-600 bg-green-50' : 'border-gray-200 hover:border-green-300'}`">
                                <input type="radio" v-model="form.payment_method" :value="method.id" class="sr-only" />
                                <div :class="`w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 ${form.payment_method === method.id ? 'bg-green-600' : 'bg-gray-100'}`">
                                    <component :is="method.icon" :class="`w-5 h-5 ${form.payment_method === method.id ? 'text-white' : 'text-gray-500'}`" />
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900">{{ method.name }}</p>
                                    <p class="text-sm text-gray-500">{{ method.desc }}</p>
                                </div>
                                <div :class="`w-5 h-5 rounded-full border-2 flex items-center justify-center ${form.payment_method === method.id ? 'border-green-600' : 'border-gray-300'}`">
                                    <div v-if="form.payment_method === method.id" class="w-3 h-3 bg-green-600 rounded-full"></div>
                                </div>
                            </label>
                        </div>

                        <!-- Review delivery info -->
                        <div class="bg-gray-50 rounded-xl p-4 mb-6">
                            <h4 class="font-bold text-gray-700 text-sm mb-2">ডেলিভারি তথ্য</h4>
                            <p class="text-gray-900">{{ form.name }} — {{ form.phone }}</p>
                            <p class="text-gray-600 text-sm">{{ form.address }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ form.city === 'chittagong' ? 'চট্টগ্রাম' : 'চট্টগ্রামের বাইরে' }}
                                · ডেলিভারি: {{ formatBangla(deliveryCharge) }}৳
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" @click="currentStep = 2"
                                    class="px-6 py-4 rounded-xl border-2 border-gray-200 text-gray-600 hover:border-green-600 hover:text-green-600 font-bold transition-colors">
                                পূর্ববর্তী
                            </button>
                            <button @click="submitOrder"
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                                <CheckCircleIcon class="w-5 h-5" />
                                অর্ডার নিশ্চিত করুন
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Order Summary (2 cols) -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-900 mb-6">অর্ডার সারাংশ</h2>

                        <!-- Items -->
                        <div v-if="selectedProducts.length > 0" class="space-y-4 mb-6">
                            <div v-for="item in selectedProducts" :key="item.id" class="flex items-center gap-3">
                                <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0 bg-green-100">
                                    <img :src="item.image" :alt="item.name" class="w-full h-full object-cover" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 text-sm truncate">{{ item.name }}</p>
                                    <p class="text-xs text-gray-500">{{ formatBangla(item.quantity) }} × {{ formatBangla(item.price) }}৳</p>
                                </div>
                                <span class="font-bold text-green-600">{{ formatBangla(item.price * item.quantity) }}৳</span>
                            </div>
                        </div>
                        <div v-else class="text-center py-8 text-gray-400">
                            <ShoppingBagIcon class="w-12 h-12 mx-auto mb-3 opacity-50" />
                            <p>কোনো পণ্য নির্বাচন করা হয়নি</p>
                        </div>

                        <!-- Price breakdown -->
                        <div v-if="selectedProducts.length > 0" class="space-y-3 pt-4 border-t border-gray-200">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>সাবটোটাল</span>
                                <span>{{ formatBangla(subtotal) }}৳</span>
                            </div>
                            <div class="flex justify-between text-sm text-green-600 font-medium">
                                <span>প্রথম অর্ডার ছাড় (২০%)</span>
                                <span>-{{ formatBangla(discount) }}৳</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>ডেলিভারি চার্জ</span>
                                <span>{{ form.city ? formatBangla(deliveryCharge) + '৳' : '—' }}</span>
                            </div>
                            <div class="flex justify-between font-bold text-xl pt-3 border-t border-gray-200">
                                <span>মোট</span>
                                <span class="text-green-600">{{ formatBangla(total) }}৳</span>
                            </div>
                        </div>

                        <!-- Savings badge -->
                        <div v-if="discount > 0" class="mt-4 bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                            <p class="text-sm text-green-700 font-medium">
                                আপনি সাশ্রয় করছেন <strong>{{ formatBangla(discount) }}৳</strong>!
                            </p>
                        </div>

                        <!-- Trust badges -->
                        <div class="mt-6 pt-4 border-t border-gray-200 space-y-3">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <ShieldCheckIcon class="w-4 h-4 text-green-600" />
                                <span>নিরাপদ চেকআউট</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <ArrowPathIcon class="w-4 h-4 text-green-600" />
                                <span>৭ দিনের রিটার্ন পলিসি</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import StickyRibbon from '../Components/Landing/StickyRibbon.vue';
import {
    ArrowLeftIcon, ArrowRightIcon, CheckIcon, ShoppingBagIcon,
    TruckIcon, CreditCardIcon, BanknotesIcon, CheckCircleIcon,
    ShieldCheckIcon, ArrowPathIcon, MapPinIcon, PlusIcon,
    DevicePhoneMobileIcon,
} from '@heroicons/vue/24/outline';

const props = defineProps({
    products: { type: Object, default: () => ({}) },
    cartItems: { type: Array, default: () => [] },
});

const currentStep = ref(props.cartItems.length > 0 ? 2 : 1);
const steps = ['পণ্য', 'ডেলিভারি', 'নিশ্চিতকরণ'];

const form = reactive({
    name: '', phone: '', email: '', address: '', city: '', notes: '',
    payment_method: 'cod',
});

const paymentMethods = [
    {
        id: 'cod',
        name: 'ক্যাশ অন ডেলিভারি',
        desc: 'পণ্য পেয়ে ডেলিভারি ম্যানকে পেমেন্ট করুন',
        icon: BanknotesIcon,
    },
    {
        id: 'bkash',
        name: 'বিকাশ',
        desc: 'বিকাশ নম্বরে সেন্ড মানি করুন',
        icon: DevicePhoneMobileIcon,
    },
    {
        id: 'nagad',
        name: 'নগদ',
        desc: 'নগদ নম্বরে সেন্ড মানি করুন',
        icon: DevicePhoneMobileIcon,
    },
];

const selectedProducts = ref(props.cartItems.length ? [...props.cartItems] : []);

const allProducts = computed(() => Object.values(props.products));

function toggleProduct(product) {
    const existing = selectedProducts.value.find(s => s.id === product.id);
    if (existing) {
        selectedProducts.value = selectedProducts.value.filter(s => s.id !== product.id);
    } else {
        selectedProducts.value.push({ ...product, quantity: 1 });
    }
}

function updateItemQty(productId, delta) {
    const item = selectedProducts.value.find(s => s.id === productId);
    if (item) {
        item.quantity = Math.max(1, item.quantity + delta);
    }
}

function nextStep() {
    if (currentStep.value < 3) currentStep.value++;
}

function formatBangla(n) {
    const b = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return String(Math.round(n)).replace(/\d/g, d => b[d]);
}

const subtotal = computed(() => selectedProducts.value.reduce((sum, item) => sum + item.price * item.quantity, 0));
const discount = computed(() => Math.round(subtotal.value * 0.20));
const deliveryCharge = computed(() => form.city === 'chittagong' ? 60 : 120);
const total = computed(() => subtotal.value - discount.value + (form.city ? deliveryCharge.value : 0));

function submitOrder() {
    router.post('/checkout', {
        name: form.name,
        phone: form.phone,
        email: form.email || null,
        address: form.address,
        city: form.city,
        payment_method: form.payment_method,
        items: selectedProducts.value.map(item => ({
            product_id: item.id,
            quantity: item.quantity,
            unit_price: item.price,
        })),
        notes: form.notes || null,
    });
}
</script>
