<template>
    <section id="contact" class="bg-gradient-to-br from-gray-50 to-green-50 py-20 lg:py-28">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm uppercase tracking-wider">
                    <PaperAirplaneIcon class="w-4 h-4" />
                    যোগাযোগ
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-3">
                    অর্ডার করতে <span class="text-green-600">ফর্ম</span> পূরণ করুন
                </h2>
                <p class="text-gray-600 mt-4 text-lg">
                    আপনার তথ্য দিন - আমরা দ্রুত যোগাযোগ করবো
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10 border border-gray-100 scroll-reveal">
                <form @submit.prevent="submitForm" class="space-y-6">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">আপনার নাম *</label>
                            <input v-model="form.name" type="text" required placeholder="পূর্ণ নাম লিখুন"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">মোবাইল নম্বর *</label>
                            <input v-model="form.phone" type="tel" required placeholder="০১XXXXXXXXX"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ইমেইল</label>
                        <input v-model="form.email" type="email" placeholder="example@email.com"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ঠিকানা *</label>
                        <textarea v-model="form.address" required rows="3" placeholder="সম্পূর্ণ ঠিকানা লিখুন"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">শহর *</label>
                        <select v-model="form.city" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            <option value="">-- শহর নির্বাচন করুন --</option>
                            <option value="chittagong">চট্টগ্রাম (ডেলিভারি: ৬০৳)</option>
                            <option value="outside">চট্টগ্রামের বাইরে (ডেলিভারি: ১২০৳)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">পছন্দের পণ্য *</label>
                        <select v-model="form.product" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            <option value="">-- পণ্য নির্বাচন করুন --</option>
                            <option v-for="p in products" :key="p.id" :value="p.id">{{ p.name }} ({{ p.price }}৳)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">পরিমাণ</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">বিশেষ অনুরোধ</label>
                        <textarea v-model="form.message" rows="2" placeholder="কোনো বিশেষ অনুরোধ থাকলে লিখুন"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none"></textarea>
                    </div>

                    <!-- Order Summary -->
                    <div v-if="selectedProduct" class="bg-green-50 border border-green-200 rounded-xl p-4">
                        <h4 class="font-bold text-green-800 mb-2">অর্ডার সারাংশ</h4>
                        <div class="space-y-1 text-sm text-green-700">
                            <div class="flex justify-between"><span>{{ selectedProduct.name }} × {{ form.quantity }}</span><span>{{ subtotal }}৳</span></div>
                            <div class="flex justify-between"><span>প্রথম অর্ডার ছাড় (২০%)</span><span class="text-red-600">-{{ discount }}৳</span></div>
                            <div class="flex justify-between"><span>ডেলিভারি ({{ form.city === 'chittagong' ? 'চট্টগ্রাম' : 'বাইরে' }})</span><span>{{ deliveryCharge }}৳</span></div>
                            <div class="flex justify-between font-bold text-base pt-2 border-t border-green-200"><span>মোট</span><span>{{ total }}৳</span></div>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white text-lg font-bold py-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <PaperAirplaneIcon class="w-5 h-5" />
                        অর্ডার সাবমিট করুন
                    </button>

                    <p class="text-xs text-gray-500 text-center">
                        সাবমিট করলে আপনি আমাদের গোপনীয়তা নীতিতে সম্মত হচ্ছেন
                    </p>
                </form>

                <!-- Success message -->
                <div v-if="success" class="mt-6 bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                    <p class="text-green-800 font-medium">ধন্যবাদ! আপনার অর্ডার সফলভাবে জমা হয়েছে।</p>
                    <p class="text-green-600 text-sm mt-1">আমরা শীঘ্রই আপনার সাথে যোগাযোগ করবো।</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import { PaperAirplaneIcon } from '@heroicons/vue/24/outline';

const success = ref(false);
const form = reactive({
    name: '', phone: '', email: '', address: '',
    city: '', product: '', quantity: 1, message: ''
});

const props = defineProps({
    products: { type: Object, required: true },
});

const productsList = computed(() => Object.values(props.products));
const selectedProduct = computed(() => productsList.value.find(p => p.id === form.product));
const deliveryCharge = computed(() => form.city === 'chittagong' ? 60 : 120);
const subtotal = computed(() => selectedProduct.value ? selectedProduct.value.price * form.quantity : 0);
const discount = computed(() => Math.round(subtotal.value * 0.20));
const total = computed(() => subtotal.value - discount.value + deliveryCharge.value);

function toBangla(n) {
    const b = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return String(n).replace(/\d/g, d => b[d]);
}

function submitForm() {
    // TODO: Connect to backend API
    success.value = true;
    setTimeout(() => {
        Object.keys(form).forEach(key => form[key] = key === 'quantity' ? 1 : '');
        success.value = false;
    }, 5000);
}
</script>
