<template>
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-3">অর্গানিক</h3>
                    <p class="text-gray-400">
                        সিলেটের পাহাড়ি বাগান থেকে বিশুদ্ধ জৈব চা পাতা - প্রকৃতির আসল স্বাদ আপনার কাপে।
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-3">দ্রুত লিংক</h4>
                    <ul class="space-y-2">
                        <li><a href="#products" class="hover:text-green-400 transition-colors">পণ্যসমূহ</a></li>
                        <li><a href="#offer" class="hover:text-green-400 transition-colors">অফার</a></li>
                        <li><a href="#reviews" class="hover:text-green-400 transition-colors">রিভিউ</a></li>
                        <li><a href="#contact" class="hover:text-green-400 transition-colors">যোগাযোগ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-3">যোগাযোগ</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center gap-2"><PhoneIcon class="w-4 h-4" />+৮৮০ ১XXX-XXXXXX</li>
                        <li class="flex items-center gap-2"><EnvelopeIcon class="w-4 h-4" />info@organic-tea.com</li>
                        <li class="flex items-center gap-2"><MapPinIcon class="w-4 h-4" />সিলেট, বাংলাদেশ</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-500 text-sm">&copy; {{ new Date().getFullYear() }} অর্গানিক। সর্বস্বত্ব সংরক্ষিত।</p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { PhoneIcon, EnvelopeIcon, MapPinIcon } from '@heroicons/vue/24/outline';
</script>
