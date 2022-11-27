<template>
    <div class="p-6 bg-white shadow-lg rounded-lg">
        <slot />
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="font-medium uppercase border-b-[3px] border-primary-800">
                    <tr>
                        <slot name="thead" />
                    </tr>
                </thead>
                <tbody class="text-center">
                    <slot name="tbody" />
                </tbody>
            </table>
        </div>
    </div>
</template>
