<script setup>
defineProps(['fill']);
</script>

<template>
    <!-- Desktop svg -->
    <svg
        class="rotate-180 self-end hidden lg:inline"
        viewBox="0 0 1440 320"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path
            d="M0,96L60,85.3C120,75,240,53,360,42.7C480,32,600,32,720,37.3C840,43,960,53,1080,80C1200,107,1320,149,1380,170.7L1440,192L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"
            :fill="fill"
        />
    </svg>
    <!-- Mobile svg -->
    <svg
        class="self-end drop-shadow-[0_-4px_6px_rgba(0,0,0,0.25)] lg:hidden"
        viewBox="0 0 375 102"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path
            d="M375 51L359.375 56.6844C343.75 62.1562 312.5 73.8437 281.25 79.3156C250 85 218.75 85 187.5 82.1844C156.25 79.1563 125 73.8438 93.75 59.5C62.5 45.1563 31.25 22.8438 15.625 11.3156L1.43051e-05 0V102H15.625C31.25 102 62.5 102 93.75 102C125 102 156.25 102 187.5 102C218.75 102 250 102 281.25 102C312.5 102 343.75 102 359.375 102H375V51Z"
            :fill="fill"
        />
    </svg>
</template>
