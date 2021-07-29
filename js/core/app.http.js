
var http = {
    __convertData: function (body) {
        if(body instanceof Object && !(body instanceof FormData)) {
            try {
                return JSON.stringify(body);
            } catch (e) {}
        }
        return body;
    },
    post: function (url, body) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: http.__convertData(body),
                processData: false,
                contentType: false,
                success: function (data) {
                    resolve(data);
                },
                error: function (a, b, c) {
                    reject(a);
                }
            })
        });
    },
    get: function (url) {
        debugger;
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    resolve(data);
                },
                error: function (a, b, c) {
                    reject(a);
                }
            })
        });
    },
    put: function (url, body) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'PUT',
                dataType: 'json',
                data: http.__convertData(body),
                processData: false,
                contentType: false,
                success: function (data) {
                    resolve(data);
                },
                error: function (a, b, c) {
                    reject(a);
                }
            })
        });
    },
    delete: function (url) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'DELETE',
                dataType: 'json',
                success: function (data) {
                    resolve(data);
                },
                error: function (a, b, c) {
                    reject(a);
                }
            })
        });
    }
};

// interceptando todos os retornos do ajax
/*$.ajaxSetup({
    beforeSend: function (xhr,settings) {
        var token = localStorage.getItem('token');
        if(token) {
            xhr.setRequestHeader('token', token);
        }

        // gerando código unico para o loading
        xhr.loadingCode = new Date().getTime() + '-' + Math.round(Math.random() * (9999999999 - 1000000000) + 1000000000);
        $('body').append('<div class="loading" id="'+xhr.loadingCode+'"><span class="fas fa-sync fa-spin"></span></div>')
        return xhr;
    },
    complete:function(xhr){
        $('#'+xhr.loadingCode).remove();
    }
});*/

// interceptando todos os requests do ajax
/*$(document).ajaxSuccess(function(event, request, settings) {
    var token = request.getResponseHeader('token');
    if(token) {
        localStorage.setItem('token', token);
    }
});*/

// verificando se é um erro para mostrar o toastr
/*$(document).ajaxError(function(event, jqxhr, settings, thrownError) {
    var defaultMessage = 'Ocorreu um erro de sistema, tente novamente mais tarde!';
    if (jqxhr.status === 401 && window.location.pathname.indexOf('auth.php') === -1) {
        system.redirect('auth.php', 'info', jqxhr.responseJSON.message || jqxhr.responseJSON.error || 'Usuário não autenticado');
    } else if (jqxhr.status === 401 || jqxhr.status === 412 || jqxhr.status === 417 || jqxhr.status === 403) {
        toastr.error(jqxhr.responseJSON.message || jqxhr.responseJSON.error || defaultMessage, 'Ops!');
    } else {
        toastr.error(defaultMessage, 'Ops!');
    }
    // console.log(event, jqxhr, settings, thrownError);
});*/

