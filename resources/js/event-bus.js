import mitt from "mitt";

export const FILE_UPLOAD_STARTED = 'FILE_UPLOAD_STARTED';
export const FILE_DOWNLOAD_FROM_MENU = 'FILE_DOWNLOAD_FROM_MENU';
export const FILE_SHARE_FROM_MENU = 'FILE_SHARE_FROM_MENU';
export const FILE_DELETE_FROM_MENU = 'FILE_DELETE_FROM_MENU';
export const SHOW_ERROR_DIALOG = 'SHOW_ERROR_DIALOG';
export const SHOW_NOTIFICATION = 'SHOW_NOTIFICATION';
export const SHOW_RENAME = 'SHOW_RENAME';
export const ON_SEARCH = 'ON_SEARCH';
export const SHOW_CONTEXT_MENU = 'SHOW_CONTEXT_MENU';

export const emitter = mitt()

//listen to an event


export function showErrorDialog(message) {
    emitter.emit(SHOW_ERROR_DIALOG, {message});
}
export function showErrorNotification(message) {
    emitter.emit(SHOW_NOTIFICATION, {type: 'error', message})
}

export function showSuccessNotification(message) {
    emitter.emit(SHOW_NOTIFICATION, {type: 'success', message})
}
