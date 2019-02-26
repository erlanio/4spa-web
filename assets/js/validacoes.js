$BASE_URL = "http://localhost/4spa/"

$(document).ready(function () {

    //ALTERA MODAL
    $(".modal-wide").on("show.bs.modal", function () {
        var height = $(window).height() - 200;
        $(this).find(".modal-body").css("max-height", height);
    });

    //MONTA TABELA ESCOLAS
    criarTabelaEscola();
    $('#tabela-escolas').css('width', '100%');

    //MASCARAS
    $("#telefone").inputmask({
        mask: ["(99) 99999-9999", ],
        keepStatic: true
    });
    $("#telefoneEdit").inputmask({
        mask: ["(99) 99999-9999", ],
        keepStatic: true
    });

    //GET CIDADE
    $('#estado').change(function () {
        var id_estado = $('#estado').val();
        $.post($BASE_URL + 'escolas/getCidades', {id_estado: id_estado},
                function (data) {
                    console.log(data);

                    $("#cidades").html(data).selectpicker('refresh');
                    $('#cidades').removeAttr('disabled');
                }
        )
    })
    
    $('#estadoEdit').change(function () {
        var id_estado = $('#estadoEdit').val();
        $.post($BASE_URL + 'escolas/getCidades', {id_estado: id_estado},
                function (data) {
                    console.log(data);

                    $("#cidadesEdit").html(data).selectpicker('refresh');
                    $('#cidadesEdit').removeAttr('disabled');
                }
        )
    })



    //LOGIN
    $('#btn-logar').click(function () {
        email = $('#login-email').val();
        senha = $('#login-senha').val();
        if (email == "" || senha == "") {
            $('#retorno-login').addClass("alert alert-danger");
            $('#retorno-login').html("Informe todos os dados para continuar!");
        } else {
            $.ajax({
                url: $BASE_URL + 'Login/logar',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'email': email,
                    'senha': senha,
                })

            }).done(function (data) {
                console.log(data);
                if (data == 2) {
                    $('#retorno-login').addClass("alert alert-danger");
                    $('#retorno-login').html("Email ou senha incorretos!");
                } else {
                    location.href = $BASE_URL + "Home";
                }

            });
        }
    })
    //fim login

    //SALVAR ESCOLA

    $('#salvar-escola').click(function () {

        $nomeEscola = $('#escola').val();
        $estado = $('#estado').val();
        $cidade = $('#cidades').val();
        $tipo = $('#tipoEscola').val();
        $bairro = $('#bairro').val();
        $numero = $('#num').val();
        $email = $('#email').val();
        $rua = $('#rua').val();
        $telefone = $('#telefone').val();

        if ($nomeEscola == "" || $estado == "selecione" || $cidade == "selecione" || $tipo == "selecione" || $email == "") {
            notify("Informe todos os dados para continuar!", "danger");
        } else {
            $.ajax({
                url: $BASE_URL + 'escolas/salvar',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'nomeEscola': $nomeEscola,
                    'estado': $estado,
                    'cidade': $cidade,
                    'tipo': $tipo,
                    'bairro': $bairro,
                    'numero': $numero,
                    'email': $email,
                    'rua': $rua,
                    'telefone': $telefone,
                })

            }).done(function (data) {
                $('#atualizar-tabela-escolas').click();
                notify("Escola cadastrada com sucesso!", 'success');
                $('#escola').val("");
                $('#estado').val("selecione").selectpicker("refresh");
                $('#cidades').val("selecione").selectpicker("refresh");
                $('#tipoEscola').val("selecione").selectpicker("refresh");
                $('#bairro').val("");
                $('#num').val("");
                $('#email').val("");
                $('#rua').val("");
                $('#telefone').val("");
                $('#modal-add-escola').modal('hide');
            });
        }

    })

    $('.cadastro').click(function () {
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });




})

//TABELA MEMBROS
function criarTabelaEscola() {
    if (($("#tabela-escolas")).length) {


        var tabelaEscolas = $('#tabela-escolas').DataTable({
            "ajax": {

                url: $BASE_URL + 'escolas/',
                type: 'GET',

            },
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }



        });

        tabelaEscolas.on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tabelaEscolas.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        $('#atualizar-tabela-escolas').click(function () {
            tabelaEscolas.ajax.reload();
        })
    }
}

function deletarEscola(id) {

    bootbox.confirm({
        message: "Tem certeza que deseja deletar esta escola?",
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger enviar'
            }
        },
        callback: function (result) {
            if (result == true) {
                $.ajax({
                    url: $BASE_URL + 'escolas/deletarEscola',
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': id,
                    })

                }).done(function (data) {
                    notify("Escola deletada com sucesso!", "success");
                    $('#atualizar-tabela-escolas').click();
                });

            }
        }
    });
}

function editarEscola(id) {
    $('#modal-edit-escola').modal('show');
    $.ajax({
        url: $BASE_URL + 'escolas/retornaEscolaEdit',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': id,
        })

    }).done(function (data) {
        var id_cidade;
        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#escolaEdit').val(o.nome_escola);
            $('#estadoEdit').val(o.id_estado).selectpicker('refresh');
            $('#id_escola').val(o.id_escola);
            id_cidade = o.id_cidade;
            $('#tipoEscolaEdit').val(o.tipo_escola).selectpicker('refresh');
            $('#bairroEdit').val(o.bairro_escola);
            $('#numEdit').val(o.numero_escola);
            $('#emailEdit').val(o.email_escola);
            $('#ruaEdit').val(o.rua_escola);
            $('#telefoneEdit').val(o.telefone_escola);

        });

        var id_estado = $('#estadoEdit').val();
        $.post($BASE_URL + 'escolas/getCidades', {id_estado: id_estado},
                function (data) {
                    $("#cidadesEdit").html(data).selectpicker('refresh');
                    $('#cidadesEdit').val(id_cidade).selectpicker('refresh');
                    $('#cidadesEdit').removeAttr('disabled');
                }
        )
    });
}

function salvarEdicaoEscola() {
    $nomeEscolaEdit = $('#escolaEdit').val();
    $estado = $('#estadoEdit').val();
    $cidade = $('#cidadesEdit').val();
    $tipo = $('#tipoEscolaEdit').val();
    $bairro = $('#bairroEdit').val();
    $numero = $('#numEdit').val();
    $email = $('#emailEdit').val();
    $rua = $('#ruaEdit').val();
    $telefone = $('#telefoneEdit').val();
    $id_escola = $('#id_escola').val();

    if ($nomeEscolaEdit == "" || $estado == "selecione" || $cidade == "selecione" || $tipo == "selecione" || $email == "") {
        notify("Informe todos os dados para continuar!", "danger");
    } else {
        $.ajax({
            url: $BASE_URL + 'escolas/salvarEscolaEdicao',
            type: 'POST',
            dataType: 'html',
            data: ({
                'nomeEscola': $nomeEscolaEdit,
                'estado': $estado,
                'cidade': $cidade,
                'tipo': $tipo,
                'bairro': $bairro,
                'numero': $numero,
                'email': $email,
                'rua': $rua,
                'telefone': $telefone,
                'id_escola': $id_escola
            })

        }).done(function (data) {
            console.log(data);
            $('#atualizar-tabela-escolas').click();
            notify("Escola Alterada com sucesso!", 'success');
            $('#modal-edit-escola').modal('hide');
        });
    }
}

function notify($mensagem, $tipo) {
    $.notify({
        title: "<strong>Atenção: </strong>",
        icon: 'glyphicon glyphicon-warning-sign',
        message: $mensagem,
        position: "top"
    }, {
        type: $tipo,
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
        z_index: 9999,
    });

}
