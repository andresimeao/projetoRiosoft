$(function () {
    console.log('[Application] Started!');

    // configurando toastr
    toastr.options.preventDuplicates = true;
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.options.timeOut = '5000';

    // inicia o sistema com as dependencias
    system.initialize([
        'js/core/app.http.js',
        'js/core/app.utils.js'
    ]);
    $(".user-name").html(system.getUser().nome);
  
  
    if(system.getUser().eAdministrador != "1") {
        $('.requireAdmin').remove();
    } else {
        $('.requireAdmin').removeClass('requireAdmin');
    }

    $('#logout-link').click(function () {
        if(confirm('Deseja realmente encerrar a sessão?')) {
            localStorage.removeItem("token");
            system.redirect('auth.php', "information", "Sessão encerrada com sucesso.");
        }
    })

    if(window.location.href.indexOf("auth.php") === -1 && !localStorage.getItem('token')) {
        system.loadWithMessage('auth.php', 'info', 'É necessário estar conectado para utilizar a aplicação.');
    }
});