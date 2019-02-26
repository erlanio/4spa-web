$BASE_URL = "http://localhost/App_tabeliao/";

$(document).ready(function () {

    if (($("#tabela-categorias")).length) {


        var tabelaCategorias = $('#tabela-categorias').DataTable({
            "ajax": {

                url: $BASE_URL + 'Categorias/getcategorias',
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

        tabelaCategorias.on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tabelaCategorias.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#atualizar-tabela-categorias').click(function () {
            tabelaCategorias.ajax.reload();
        })





        $('#img-categoria').on('change', function () {

            var fr = new FileReader;

            fr.onload = function () {
                var img = new Image;

                img.onload = function () {

                    if (img.width != 250 && this.height != 250) {
                        $('#retorno-imagem-categoria').addClass("alert alert-danger");
                        $('#retorno-imagem-categoria').html("Ops! A imagem deve conter as seguintes dimensões: <br> Largura: 250px<br>Altura: 250px;");
                    } else {
                        $('#btn-salvar-categoria').removeAttr('disabled');

                    }
                };

                img.src = fr.result;
            };

            fr.readAsDataURL(this.files[0]);

        });



        $('#btn-salvar-categoria').click(function () {



            $nome_categoria = $('#nome-categoria').val();
            $desc_categoria = $('#desc-categoria').val();

            if ($nome_categoria == null || $desc_categoria == "") {
                $('#retorno-salvar-categoria').addClass("alert alert-danger");
                $('#retorno-salvar-categoria').html("Ops! Preencha todos os dados para continuar!");
            } else {
                $('#form-categoria').ajaxForm({
                    target: '#retorno-salvar-categoria' // o callback serÃ¡ no elemento com o id #visualizar
                }).submit();
                $('#atualizar-tabela-categorias').click();
                $('#nome-categoria').val("");
                $('#desc-categoria').val("");
                $('#img-categoria').val("");

                notify("Salvo com sucesso!", "success");
            }

        })

    }


});


function alterarCategoria($id) {
    $.ajax({
        url: $BASE_URL + 'Categorias/buscarCategoria',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': $id,
        })

    }).done(function (data) {
        console.log(data);
        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#nome-categoria-edit').val(o.nome_categoria);
            $('#desc-categoria-edit').val(o.desc_categoria);
            $('#id-categoria-edit').val(o.id_categoria);
            $imagem = $BASE_URL + "assets/img/categorias/" + o.img_categoria;
            $('#img-edit').attr('src', $imagem);


        });

    });
}

function excluirCategoria($id, $img) {

    bootbox.confirm({
        message: "Tem certeza que deseja deletar esta categoria?",
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
                    url: $BASE_URL + "Categorias/deletar",
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': $id,
                        'img': $img
                    })

                }).done(function (data) {
                    notify("Excluido com sucesso!", "danger");
                    $('#atualizar-tabela-categorias').click();
                });
            }
        }
    });

}


function salvarAlteracoesCategoria() {
    $('#form-categoria-update').ajaxForm({
        target: '#retorno-edit-categorias' // o callback serÃ¡ no elemento com o id #visualizar
    }).submit();
    notify("Dados alterados com sucesso!", "info");
    $('#atualizar-tabela-categorias').click();
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