<template>
    <div class="h-screen bg-gray-50 flex w-full gap-4">
        <Navigation />

        <main class="flex flex-col flex-1 px-4 overflow-hidden" @drop.prevent="handleDrop" @dragover.prevent="onDragOver"
            @dragleave.prevent="onDragLeave" :class="dragOver ? 'dropzone' : ''">

            <template v-if="dragOver" class="text-gray-500 text-center py-8 text-sm">
                Drop files here to upload
            </template>

            <template v-else>
                <div class="flex items-center justify-between w-full">
                    <SearchForm />
                    <UserSettingDropdown />
                </div>
                <div class="flex-1 flex flex-col overflow-hidden">
                    <slot></slot>
                </div>
            </template>

        </main>
    </div>

    <ErrorDialog />
    <FormProgress :form="fileUploadForm" />
    <Notification />
    <CustomContextMenu />
    <RenameFilesModal />
</template>


<script setup>
import Navigation from "@/Components/app/Navigation.vue";
import SearchForm from "@/Components/app/SearchForm.vue";
import UserSettingDropdown from "@/Components/app/UserSettingDropdown.vue";
import FormProgress from "@/Components/app/FormProgress.vue";
import ErrorDialog from "@/Components/ErrorDialog.vue";
import Notification from "@/Components/Notification.vue";

import { onMounted, ref } from "vue";
import { emitter, FILE_UPLOAD_STARTED, SHOW_CONTEXT_MENU, showErrorDialog, showSuccessNotification } from "@/event-bus.js";
import { useForm, usePage } from "@inertiajs/vue3";
import CustomContextMenu from "@/Components/CustomContextMenu.vue";
import RenameFilesModal from "@/Components/app/RenameFilesModal.vue";


const dragOver = ref(false);
const context = ref({})
const showContext = ref(false)

const page = usePage();
const fileUploadForm = useForm({
    files: [],
    relative_paths: [],
    parent_id: null
})


function onDragOver() {
    dragOver.value = true;
}

function onDragLeave() {
    dragOver.value = false;
}

function handleDrop(ev) {
    console.log(ev)
    dragOver.value = false;
    const files = ev.dataTransfer.files;
    if (!files.length) return;
    uploadFiles(files);

}

function uploadFiles(files) {
    fileUploadForm.parent_id = page.props.folder.id;
    fileUploadForm.files = files;
    fileUploadForm.relative_paths = [...files].map(f => f.webkitRelativePath);

    fileUploadForm.post(route('file.store'), {
        onSuccess: () => {
            showSuccessNotification(`${files.length} files have been updated !`)
        },
        onError: errors => {
            let message = '';
            if (Object.keys(errors).length > 0) {
                message = errors[Object.keys(errors)[0]]
            } else {
                message = 'Error during file upload. Please try again later.'
            }
            showErrorDialog(message);
        },
        onFinish: () => {
            fileUploadForm.clearErrors();
            fileUploadForm.reset();
        }
    });
}

// function onShowContextMenu(ct) {
//     showContext.value = !showContext.value
//     context.value = ct
// }

onMounted(() => {
    emitter.on(FILE_UPLOAD_STARTED, uploadFiles);
})

</script>

<style scoped>
.dropzone {
    width: 100%;
    height: 100%;
    color: #8d8d8d;
    border: 2px dashed gray;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
}
</style>
