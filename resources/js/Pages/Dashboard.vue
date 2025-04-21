<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import updateLocale from 'dayjs/plugin/updateLocale';
dayjs.extend(relativeTime);
dayjs.extend(updateLocale);

dayjs.updateLocale('en', {
  relativeTime: {
    future: 'in %s',
    past: '%s ago',
    s: 'a few seconds',
    m: '1 minute',
    mm: '%d minutes',
    h: '1 hour',
    hh: '%d hours',
    d: '1 day',
    dd: '%d days',
    M: '1 month',
    MM: '%d months',
    y: '1 year',
    yy: '%d years'
  }
});
const props = defineProps<{
    jobPosts: Array<{
        id: number;
        title: string;
        company_name: string;
        location: string;
        salary: string;
        description: string;
        experience: string;
        extra_info: string;
        company_logo: string | null;
        created_at: string;
        skills: Array<{ title: string }>;
    }>
}>();

import { ref } from 'vue';

const allJobs = ref(props.jobPosts); // original
const jobPosts = ref([...props.jobPosts]); // filtered

const handleSearch = ({ title, location }: { title: string; location: string }) => {
  jobPosts.value = allJobs.value.filter(job =>
    (title ? job.title.toLowerCase().includes(title.toLowerCase()) : true) &&
    (location ? job.location.toLowerCase().includes(location.toLowerCase()) : true)
  );
};


</script>

<template>

    <Head title="Job Listings" />

    <AuthenticatedLayout>
        <!-- Hero Section -->
        <Hero :jobPosts="jobPosts"  @search="handleSearch" />

        <!-- Job List Section -->
        <div class="bg-gray-50 py-12">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-gray-900">Available Positions</h2>
                    <p class="mt-2 text-lg text-gray-600">Find your next career opportunity</p>
                </div>

                <!-- Job Grid -->
                <!-- Job Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Job Card -->
                    <div v-for="job in jobPosts" :key="job.id"
                        class="relative bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col justify-between">
                        <!-- Card Header -->
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ job.title }}</h3>
                                    <div class="flex items-center mt-2">
                                        <img v-if="job.company_logo" :src="job.company_logo" :alt="job.company_name"
                                            class="w-10 h-10 rounded-full object-cover border border-gray-200" />
                                        <span class="ml-3 text-sm font-medium text-gray-700">{{ job.company_name
                                            }}</span>
                                    </div>
                                </div>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ job.experience }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="px-6 pb-4">
                            <!-- Location & Salary -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ job.location }}
                                </div>
                                <span class="text-sm font-semibold text-green-600">{{ job.salary }}</span>
                            </div>

                            <!-- Description -->
                            <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                                {{ job.description }}
                            </p>

                            <!-- Extra Info -->
                            <div v-if="job.extra_info" class="mb-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    {{ job.extra_info }}
                                </span>
                            </div>

                            <!-- Skills -->
                            <div class="flex flex-wrap gap-2">
                                <span v-for="(skill, i) in job.skills" :key="i"
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ skill.title }}
                                </span>
                               
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div  class="flex justify-between items-center px-6 py-4 bg-gray-50 border-t border-gray-100 text-xs text-gray-400">
                            <button
                                class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-md transition-colors">
                                Apply
                            </button>
                            <span>{{ dayjs(job.created_at).fromNow() }}</span>
                            
                        </div>
                    </div>
                </div>


                <!-- Empty State -->
                <div v-if="jobPosts.length === 0" class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No job openings</h3>
                    <p class="mt-1 text-gray-500">Check back later for new opportunities.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>