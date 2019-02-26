$BASE_URL = "http://localhost/App_tabeliao/";



$(document).ready(function () {


    var app = document.getElementById('titulo');

    var typewriter = new Typewriter(app, {
        loop: true
    });

    typewriter.typeString('Bem vindo ao COMPARE ALL!')
            .pauseFor(2500)


            .start();


    $('#login-button').click(function () {
        if ($('#email').val() == "" || $('#senha').val() == "") {

            var app = document.getElementById('titulo');

            var typewriter = new Typewriter(app, {
                loop: true
            });

            typewriter.typeString('Informe todos os dados para continuar...')
                    .pauseFor(2500)
                    .deleteAll()

                    .start();
        } else {
            $('#form-logar').removeAttr('onsubmit');
        }
    });




});