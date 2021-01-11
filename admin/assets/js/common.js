
var getConfirmation = function (message, url) {
    if (message && url) {
        if (confirm(message)) {
            location.href = location.href + url;
        }
    }
}