<template>
    <modal :show="props.modelValue || show" @show="onShow" max-width="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Change Name
            </h2>
            <div class="mt-6">
                <InputLabel for="changeName" value="Enter Email Address" class="sr-only" />

                <TextInput type="text" ref="nameInput" id="changeName" v-model="form.name"
                    :class="form.errors.name ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''"
                    class="mt-1 block w-full" placeholder="Enter Email Address" @keyup.enter="rename" />
                <InputError :message="form.errors.name" class="mt-2" />

            </div>
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                <PrimaryButton class="ml-3" :class="{ 'opacity-25': form.processing }" @click="rename"
                    :disable="form.processing">
                    Submit
                </PrimaryButton>
            </div>
        </div>
    </modal>
</template>

<script setup>
// Imports
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {nextTick, onMounted, ref} from "vue";
import {emitter, FILE_SHARE_FROM_MENU, SHOW_RENAME, showSuccessNotification} from "@/event-bus.js";

// Uses
const form = useForm({
    name: null,
    id: null,
    parent_id: null
})
const page = usePage();

// Refs
const nameInput = ref(null)
const show = ref(false)

// Props & Emit
const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: Boolean,
})
// Computed

// Methods
function onShow() {
    nextTick(() => {
        nameInput.value.focus()
    })
}

function onShowModalRename(file) {
    show.value = true
    form.name = file.name
    form.id = file.id
}

function rename() {
    form.parent_id = page.props.folder.id
    const name = form.name
    form.post(route('file.rename'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
            form.reset();
            // Show success notification
            showSuccessNotification(`File has change name successfully !`)
        },
        onError: () => name.value.focus()
    })
}

function closeModal() {
    emit('update:modelValue')
    show.value = false
    form.clearErrors();
    form.reset()
}

// Hooks
onMounted(() => {
    emitter.on(SHOW_RENAME, onShowModalRename)
})

</script>

<style scoped></style>
