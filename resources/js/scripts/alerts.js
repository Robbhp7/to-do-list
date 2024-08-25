var Swal = require("sweetalert2").default;

function onConfirm(callback, options = {}) {
    var title = options.title || 'Title';
    var message = options.message || 'Message';
    var confirm = options.confirm || 'Confirm';
    var cancel = options.cancel || 'Cancel';

    Swal.fire({
        title: title,
        text: message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
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
