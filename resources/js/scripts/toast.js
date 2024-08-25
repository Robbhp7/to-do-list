var Swal = require("sweetalert2").default;

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

/**
 *
 * @param {'warning' | 'error'  | 'success' | 'info' | 'question'} icon
 * @param {*} title
 * @param {*} message
 */
function toast(icon, title, message) {
    Toast.fire({ icon: icon, title: title, text: message });
}

function success(options = {}) {
    var title = options.title || 'Success';
    var message = options.message || '';

    toast("success", title, message);
}

module.exports = {
    success: success,
};
