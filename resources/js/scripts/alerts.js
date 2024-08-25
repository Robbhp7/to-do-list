var Swal = require("sweetalert2").default;

function onConfirm(callback, options = {}) {
    var title = options.title || 'Title';
    var message = options.message || 'Message';
    var confirm = options.confirm || 'Confirm';
    var cancel = options.cancel || 'Cancel';
    var icon = options.icon || 'warning';

    Swal.fire({
        title: title,
        text: message,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: "#337ab7",
        cancelButtonColor: "#d9534f",
        confirmButtonText: confirm,
        cancelButtonText: cancel,
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
}

module.exports = {
    onConfirm: onConfirm,
};
