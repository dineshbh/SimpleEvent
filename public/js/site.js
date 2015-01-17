$.fn.ready(function() {

    $(document).ready(function() {
        //alert("teste");


        $("#participante-instituicao").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: BASE_URL + "/inscricao/instituicao/",
                    dataType: "json",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        nome: request.term
                    },
                    success: function(data) {
                        if (data.instituicao.length > 0) {
                            response($.map(data.instituicao, function(item) {
                                return {
                                    label: item.nome,
                                    id: item.id,
                                    value: item.nome
                                }
                            }));
                        }
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $("#participante-p_instituicao").val(ui.item.id);
            },
            open: function() {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function() {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
                //$(this).val("");
            }
        });

        var email_recuperar = $("#email_recuperar");
        var idioma = $("#idioma_site");
        $("#dialog_lembrar_senha").dialog({
            modal: true,
            autoOpen: false,
            width: 450,
            buttons: [
                {
                    text: ENVIAR,
                    click: function() {
                        $.ajax({
                            type: "POST",
                            url: 'http://www.jirs2015.com.br/index.php/recovery/',
                            data: $('#recovery').serializeArray(),
                            success: function(e) {
                                console.log(e);
                                $("#resposta_senha .sucesso").show();
                            },
                            error: function(e) {
                                console.log(e);
                                console.log($('#recovery').serializeArray())
                                $("#resposta_senha .erro").show();
                            }
                        });
                    }
                },
                {
                    text: FECHAR,
                    click: function() {
                        $("#resposta_senha").find("div.active").hide().removeClass('active');
                        $(this).dialog("close");
                    }

                }
            ],
            close: function() {
                $("#resposta_senha").find("div.active").hide().removeClass('active');
            }
        });
        $("#lembrar_senha").click(function() {

            $("#dialog_lembrar_senha").dialog("open");

            return false;
        });




    });
})