<template>
    <div class="relative py-3.5 pl-7 pr-10 min-w-[160px] w-60 aspect-video bg-no-repeat bg-cover rounded-md 2xl:w-80">
        <button type="button" class="absolute top-3 right-3" @click="$emit('edit')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="24" width="24"
                class="inline hover:scale-x-110 fill-white">
                <path
                    d="M9 47.4q-1.2 0-2.1-.9-.9-.9-.9-2.1v-30q0-1.2.9-2.1.9-.9 2.1-.9h20.25L15 25.7v12.7h12.7L42 24v20.4q0 1.2-.9 2.1-.9.9-2.1.9Zm9-12v-8.5l15.1-15.1 8.55 8.4L26.5 35.4Zm25.8-17.35-8.55-8.4L38.1 6.8q.85-.85 2.125-.85t2.125.9l4.2 4.25q.85.9.85 2.125t-.9 2.075Z" />
            </svg>
            <span class="sr-only">Edit member type</span>
        </button>
        <slot />
    </div>
</template>
