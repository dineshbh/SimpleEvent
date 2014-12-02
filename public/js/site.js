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
                            url: BASE_URL + "/inscricao/recuperar-senha/",
                            dataType: "json",
                            data: {
                                type: "post",
                                email: email_recuperar.val(),
                                idioma: idioma.val(),
                                datatype: 'json'
                            },
                            success: function(data) {
                                //$("#resposta_senha").addClass(data.class).addClass('msg').html(data.resposta);
                                
                                $("#resposta_senha").find("div.active").hide().removeClass('active');
                                $("#resposta_senha").find("div."+data.class).show().addClass('active');
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