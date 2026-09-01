$(function () {
    "use strict";

    // Initialize CKEditor on the specified textareas
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');

    // Initialize WYSIHTML5 editor on elements with class .textarea
    $('.textarea').wysihtml5();
});
