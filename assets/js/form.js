$(document).ready(function () {
    buscarAvaliadorCPF();
    $('#aguarde').hide();
    $('#inscrito').hide();


    $("#telefone").inputmask({
        mask: ["(99) 9 9999 - 9999", ],
        keepStatic: true

    });

    $("#telRes").inputmask({
        mask: ["(99) 9999 - 9999", ],
        keepStatic: true

    });

})



function buscarAvaliadorCPF() {

    $('#cpf').keyup(function () {
        $tamanho = $('#cpf').val().length;

        if ($tamanho == 11) {
            $cpf = $('#cpf').val();
            $id_minicurso = $('#id_minicurso').val();
            $.ajax({
                url: 'http://cev.urca.br/minicursos/Home/buscaCPF',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'cpf': $cpf,
                    'id_minicurso': $id_minicurso,
                })

            }).done(function (data) {
                $('#modalCadastro').html(data);
            });
        }
    })


}

function inscrever($id_pessoa, $id_minicurso, $nome) {
    $('#formulario').hide('slow');
    $('#aguarde').show('slow');
    $.ajax({
        url: 'http://cev.urca.br/minicursos/Home/inscrever',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id_pessoa': $id_pessoa,
            'id_minicurso': $id_minicurso,
        })

    }).done(function (data) {
        console.log(data);
        if (data == 1) {
            location.href = "http://cev.urca.br/minicursos/Home/comprovanteInscricao/" + $id_pessoa + "/" + $id_minicurso;
            setTimeout(function () {
                location.href = "http://cev.urca.br/minicursos/";
            }, 6000);
        } else if (data == 3) {
            $.notify({
                title: "<strong>Atenção </strong>",
                icon: 'glyphicon glyphicon-warning-sign',
                message: "Ops! Você já está inscrito neste minicurso"
            }, {
                type: 'danger',
                animate: {
                    enter: 'animated rollIn',
                    exit: 'animated rollOut'
                },
                placement: {
                    from: "bottom",
                    align: "right"
                },
                offset: 50,
                spacing: 10,
                z_index: 1031,
            });
            setTimeout(function () {
                location.href = "http://cev.urca.br/minicursos/";
            }, 2000);
        }
    });
}

function atribuirIDMinicurso($id_minicurso) {
    $('#id_minicurso').val($id_minicurso);
}

function salvarPessoa() {
    $id_minicurso = $('#id_minicurso').val();
    $nome = $('#nome').val();
    $cpf = $('#cpf').val();
    $email = $('#email').val();
    $telefone = $('#telefone').val();
    $telRes = $('#telRes').val();
    if ($nome == "" || $email == "") {
        $('#mensagem').removeClass("hidden");
        $('#mensagem').html("Preencha todos os dados para continuar!");
    } else {
        $('#mensagem').removeClass("hidden");
        $('#mensagem').html("Processando sua solicitação...aguarde...!");
        $.ajax({
            url: 'http://cev.urca.br/minicursos/Home/salvarPessoa',
            type: 'POST',
            dataType: 'html',
            data: ({
                'nome': $nome,
                'email': $email,
                'cpf': $cpf,
                'id_minicurso': $id_minicurso,
                'telefone': $telefone,
                'telRes': $telRes,

            })

        }).done(function (data) {


            if (data == 1) {                
                $('#mensagem').html("Inscrito com sucesso, cheque seu email e confira a confirmação de inscrição!");                
                setTimeout(function () {
                    location.href = "http://cev.urca.br/minicursos";
                }, 3000);
            } else if (data == 3) {
                $.notify({
                    title: "<strong>Atenção </strong>",
                    icon: 'glyphicon glyphicon-warning-sign',
                    message: "Ops! Já cadastrado"
                }, {
                    type: 'success',
                    animate: {
                        enter: 'animated rollIn',
                        exit: 'animated rollOut'
                    },
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    offset: 50,
                    spacing: 10,
                    z_index: 1031,
                });
                setTimeout(function () {
                    location.href = "http://cev.urca.br/minicursos/";
                }, 3000);
            }
        });
    }

}