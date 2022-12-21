<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import { percentToDecimal } from "@/functions/numberFormat.js";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from "vue";

const members = usePage().props.value.members;
const services = usePage().props.value.services;

const form = useForm({
    memberId: '',
    name: '',
    discount: 0,
    service: '',
    serviceQty: 1,
    subTotal: 0,
    totalPrice: 0,
    clothes: [{
        cloth: '',
        quantity: 1,
    }],
});
const isMemberName = ref(false);
const additionalDiscount = ref(0);
const memberDiscount = ref(0);

function filterMember() {
    return members.filter((m) => m.id == form.memberId)[0];
}

function filterService() {
    return services.filter((s) => s.id == form.service)[0];
}

const memberName = computed({
    get() {
        if (form.memberId !== '') {
            const { name, discount } = filterMember();
            form.name = name;
            memberDiscount.value = discount;
            isMemberName.value = true;
        } else if (isMemberName.value) {
            isMemberName.value = false;
            form.name = '';
            memberDiscount.value = 0;
        }
        return form.name;
    },
    set(value) {
        form.name = value;
    }
})

const subTotalOrder = computed(() => {
    form.subTotal = form.service !== ''
        ? filterService().price * form.serviceQty
        : 0;
    return form.subTotal;
});

const orderTotalPrice = computed(() => {
    if (!!additionalDiscount.value && form.subTotal !== '') {
        if (additionalDiscount.value.includes('%')) {
            if (!!memberDiscount.value) {
                form.discount = form.subTotal * (percentToDecimal(additionalDiscount.value) + memberDiscount.value).toFixed(2);
            } else {
                form.discount = form.subTotal * percentToDecimal(additionalDiscount.value);
            }
        } else {
            if (!!memberDiscount.value) {
                form.discount = form.subTotal * memberDiscount.value;
                form.discount += parseInt(additionalDiscount.value);
            } else {
                form.discount = additionalDiscount.value;
            }
        }
        form.totalPrice = form.subTotal - form.discount;
    } else if (!!memberDiscount.value) {
        form.discount = form.subTotal * memberDiscount.value;
        form.totalPrice = form.subTotal - form.discount;
    } else if (form.subTotal !== '') {
        form.totalPrice = form.subTotal;
    }

    if (form.totalPrice < 0) {
        form.totalPrice = 0;
    }

    return form.totalPrice;
});

function addCloth() {
    form.clothes.push({
        cloth: '',
        quantity: 1,
    })
}

function removeCloth(index) {
    form.clothes.splice(index, 1);
}

function submit() {
    form.post(route('order.create'), {
        onSuccess() {
            form.reset()
            additionalDiscount.value = 0;
        },
    });
}

</script>

<template>

    <Head title="Add Order" />
    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Add Order</h2>
            </div>
            <div class="mt-10 mx-auto max-w-7xl">
                <div class="p-6 bg-white shadow-lg rounded-lg">
                    <form @submit.prevent="submit">
                        <h3 class="font-semibold text-lg">Customer Info</h3>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <!-- Input member id -->
                                <div>
                                    <InputLabel for="memberId" value="Member ID (optional)" class="mb-2" />
                                    <SelectInput v-model="form.memberId" id="memberId" class="w-full">
                                        <option value="">Select member ID</option>
                                        <option v-for="({ id }) in members" :key="id" :value="id">{{ id }}</option>
                                    </SelectInput>
                                    <InputError :message="form.errors.memberId" class="mt-1.5" />
                                </div>
                                <!-- Input name -->
                                <div class="mt-3">
                                    <InputLabel for="name" value="Name" class="mb-2" />
                                    <TextInput v-model="memberName" id="name" type="text" class="w-full" required
                                        :readonly="form.memberId !== ''" />
                                    <InputError :message="form.errors.name" class="mt-1.5" />
                                </div>
                                <!-- Input service -->
                                <div class="mt-3">
                                    <div class="flex gap-3">
                                        <div class="w-full">
                                            <InputLabel for="service" value="Service" class="mb-2" />
                                            <SelectInput v-model="form.service" id="service" class="w-full" required>
                                                <option value="" selected>Select service</option>
                                                <option v-for="({ id, name, unit }) in services" :value="id">
                                                    {{ `${name} (${unit})` }}
                                                </option>
                                            </SelectInput>
                                        </div>
                                        <div class="ml-auto">
                                            <InputLabel for="serviceQty" value="Quantity" class="mb-2" />
                                            <TextInput v-model="form.serviceQty" id="serviceQty" type="number"
                                                class="max-w-[120px] w-full" min="1" required />
                                        </div>
                                    </div>
                                    <InputError :message="form.errors.service" class="mt-1.5" />
                                    <InputError :message="form.errors.serviceQty" class="mt-1.5" />
                                </div>
                            </div>
                            <div class="h-full flex flex-col">
                                <!-- Input sub total -->
                                <div>
                                    <InputLabel for="subTotal" value="Sub Total" class="mb-2" />
                                    <TextInput v-model="subTotalOrder" id="subTotal" type="text"
                                        class="w-full text-right" required readonly />
                                    <InputError :message="form.errors.subTotal" class="mt-1.5" />
                                </div>
                                <!-- Input discount -->
                                <div class="mt-3">
                                    <InputLabel for="discount" value="Additional Discount" class="mb-2" />
                                    <TextInput v-model="additionalDiscount" id="discount" type="text"
                                        class="w-full text-right" required />
                                    <InputError :message="form.errors.discount" class="mt-1.5" />
                                </div>
                                <!-- Input total price -->
                                <div class="mt-3">
                                    <InputLabel for="totalPrice" value="Total Price" class="mb-2" />
                                    <TextInput v-model="orderTotalPrice" id="totalPrice" type="text"
                                        class="w-full text-right" required readonly />
                                    <InputError :message="form.errors.totalPrice" class="mt-1.5" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col mt-3">
                            <h3 class="font-semibold text-lg">Order Detail</h3>
                            <SecondaryButton type="button" class="px-3 ml-auto" @click="addCloth">Add Cloth
                            </SecondaryButton>
                            <div class="grid grid-cols-2 gap-6 mb-3" v-for="(item, index) in form.clothes" :key="index">
                                <div>
                                    <InputLabel :for="`cloth[${index}]`" value="Cloth type" class="mb-2" />
                                    <TextInput v-model="item.cloth" :id="`cloth[${index}]`" type="text"
                                        class="w-full" />
                                    <InputError :message="form.errors[`clothes.${index}.cloth`]" class="mt-1.5" />
                                </div>
                                <div class="flex items-start">
                                    <div>
                                        <InputLabel :for="`quantity[${index}]`" value="Quantity" class="mb-2" />
                                        <TextInput v-model="item.quantity" :id="`quantity[${index}]`" type="number"
                                            min="1" class="max-w-[120px] w-full" />
                                        <InputError :message="form.errors[`clothes.${index}.quantity`]"
                                            class="mt-1.5" />
                                    </div>
                                    <button type="button" class="mb-2.5 px-3 self-end hover:scale-105"
                                        @click="removeCloth(index)" v-show="form.clothes.length > 1">
                                        <span class="sr-only">Delete cloth list</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4 ml-auto">
                                <PrimaryButton class="px-6 py-1.5" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Add
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
