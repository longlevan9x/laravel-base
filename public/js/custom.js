//PNotify.defaults.styling = 'bootstrap3'; // Bootstrap version 3
PNotify.defaults.icons = 'bootstrap3'; // glyphicons
PNotify.defaults.icons = 'fontawesome4'; // Font Awesome 4

/**
 * @param {string} $text
 * @param {string} $title
 * @param {boolean} $hide
 * @constructor
 */
function PNotifyAlert($title, $text, $hide = true) {
    new PNotify({
        text:  $text,
        title: $title,
        type:  "alert",
        styling : 'bootstrap3',
        hide : $hide
    });
}

/**
 * @param {string} $text
 * @param {string} $title
 * @param {boolean} $hide
 * @constructor
 */
function PNotifySuccess($title, $text, $hide = true) {
    new PNotify({
        text:  $text,
        title: $title,
        type:  "info",
        styling : 'bootstrap3',
        hide : $hide
    });
}
