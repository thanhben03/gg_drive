<template>
    <!--this is component mode of context-menu-->
    <context-menu
        v-model:show="show"
        :options="optionsComponent"
    >
        <context-menu-item label="Download" @click="download" />
        <context-menu-item label="Rename" @click="rename" />
        <context-menu-item label="Share" @click="share" />
        <context-menu-item label="Move to trash" icon="icon-reload-1" @click="onDelete" />
<!--        <context-menu-separator />-->
<!--        <context-menu-group label="Menu with child">-->
<!--            <context-menu-item label="Item1" @click="alertContextMenuItemClicked('Item2-1')" />-->
<!--            <context-menu-item label="Item1" @click="alertContextMenuItemClicked('Item2-2')" />-->
<!--            <context-menu-group label="Child with v-for 50">-->
<!--                <context-menu-item v-for="index of 50" :key="index" :label="'Item3-'+index" @click="alertContextMenuItemClicked('Item3-' + index)" />-->
<!--            </context-menu-group>-->
<!--        </context-menu-group>-->
    </context-menu>
</template>

<script setup>
import { MenuOptions, ContextMenu, ContextMenuGroup, ContextMenuSeparator, ContextMenuItem } from '@imengyu/vue3-context-menu';
import {computed, onMounted, ref} from "vue";
import {
    emitter,
    FILE_DELETE_FROM_MENU,
    FILE_DOWNLOAD_FROM_MENU,
    FILE_SHARE_FROM_MENU,
    SHOW_CONTEXT_MENU, SHOW_RENAME
} from "@/event-bus.js";

const show = ref(false)
const file = ref(null)
// const props = defineProps({
//     show: Boolean,
//     context: Object
// })


const optionsComponent = ref({
    iconFontClass: 'iconfont',
    customClass: "class-a",
    zIndex: 3,
    minWidth: 230,
    x: 1,
    y: 1
})


function onShowContextMenu(ct) {
    optionsComponent.value.x = ct.e.x;
    optionsComponent.value.y = ct.e.y;
    file.value = ct.file;
    show.value = !show.value
}

function share() {
    emitter.emit(FILE_SHARE_FROM_MENU);
}

function download() {
    emitter.emit(FILE_DOWNLOAD_FROM_MENU);

}

function onDelete() {
    emitter.emit(FILE_DELETE_FROM_MENU);

}

function rename() {
    emitter.emit(SHOW_RENAME, file.value);
}

function close () {
    console.log('close context')
}

onMounted(() => {
    emitter.on(SHOW_CONTEXT_MENU, onShowContextMenu);

})

</script>
