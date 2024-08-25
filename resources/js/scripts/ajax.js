$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

class AjaxCall {
    VALID_METHODS = ["get", "post", "put", "delete", "patch"];

    constructor(options = {}) {
        this.options = options;

        this._setup();
        this._exec();
    }

    _setup() {
        this.url = this.options.url;
        this.method = this.options.method || "get";
        this.data = this.options.data;

        this.method = this.method.toLowerCase();

        this._getSetupMethod();
    }

    _exec() {
        this._loading();
        $.ajax(this._getConfig());
    }

    _add(key, value) {
        var data = this.data;

        if (data instanceof FormData) {
            data.append(key, value);
        } else if (typeof data === "string") {
            if (data.length === 0) {
                data = key + "=";
            } else {
                data += "&" + key + "=";
            }
        } else if (typeof data === "object") {
            data[key] = value;
        } else {
            data = { [key]: value };
        }

        this.data = data;
    }

    _getData() {
        if (this._method) {
            this._add("_method", this._method);
        }

        return this.data;
    }

    _getConfig() {
        var config = {
            url: this.url,
            method: this.method,
            data: this._getData(),
            success: this._onSuccess.bind(this),
            error: this._onError.bind(this),
            complete: this._onComplete.bind(this),
        };

        if (this.data instanceof FormData) {
            config.processData = false;
            config.contentType = false;
        }

        return config;
    }

    _getSetupMethod() {
        if (this.VALID_METHODS.indexOf(this.method) === -1) {
            console.error("Method not valid: " + JSON.stringify(this.method));
        }

        var requestMethod,
            _method = this.method;

        switch (_method) {
            case "put":
            case "delete":
            case "patch":
                requestMethod = "post";
                break;
            default:
                requestMethod = _method;
                _method = undefined;
        }

        this.method = requestMethod;
        this._method = _method;
    }

    _onSuccess(res) {
        if (this.options.onSuccess) {
            this.options.onSuccess(res);
        }
    }

    /**
     * @param {Error} e
     */
    _onError(e) {
        if (this.options.onError) {
            this.options.onError(e);
        }

        var message = e.message;

        if (e.responseJSON) {
            message = e.responseJSON.message || e.responseJSON.error;
        }
    }

    _onComplete(e) {
        if (this.options.onComplete) {
            this.options.onComplete();
        }

        this._loading(false);
    }

    _loading(isLoading = true) {

    }
}


function ajaxCall(options = {}) {
    return new AjaxCall(options);
}

window.AjaxCall = AjaxCall;
window.ajaxCall = ajaxCall;

module.exports = {
    create: ajaxCall,
};
