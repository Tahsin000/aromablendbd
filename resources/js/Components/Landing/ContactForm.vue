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

                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white text-lg font-bold py-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <PaperAirplaneIcon class="w-5 h-5" />
                        {{ c.submit_button }}
                    </button>

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
import { ref, reactive, computed } from 'vue';
import { PaperAirplaneIcon } from '@heroicons/vue/24/outline';

const success = ref(false);
const form = reactive({
    name: '', phone: '', email: '', address: '',
    city: '', product: '', quantity: 1, message: ''
});

const props = defineProps({
    products: { type: Object, required: true },
    content: { type: Object, default: () => ({}) },
});

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
    privacy_note: 'সাবমিট করলে আপনি আমাদের গোপনীয়তা নীতিতে সম্মত হচ্ছেন',
    success_title: 'ধন্যবাদ! আপনার অর্ডার সফলভাবে জমা হয়েছে।',
    success_message: 'আমরা শীঘ্রই আপনার সাথে যোগাযোগ করবো।',
    ...props.content,
}));

const productsList = computed(() => Object.values(props.products));
const selectedProduct = computed(() => productsList.value.find(p => p.id === form.product));
const deliveryCharge = computed(() => form.city === 'chittagong' ? 60 : 120);
const subtotal = computed(() => selectedProduct.value ? selectedProduct.value.price * form.quantity : 0);
const discount = computed(() => Math.round(subtotal.value * 0.20));
const total = computed(() => subtotal.value - discount.value + deliveryCharge.value);

function submitForm() {
    success.value = true;
    setTimeout(() => {
        Object.keys(form).forEach(key => form[key] = key === 'quantity' ? 1 : '');
        success.value = false;
    }, 5000);
}
</script>
