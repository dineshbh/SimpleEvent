$.fn.ready(function() {

    $(document).ready(function() {

        /**
         *  mask form
         */

        $.mask.definitions['h'] = "[A-Za-z]";

        $(".cpf").mask("999.999.999-99");
        $(".rg").mask("9999999-9");
        $(".data").mask("99/99/9999");
        $("input[name*=Fixo]").mask("+99 (99) 99999999?9");
        $("input[name*=Celular]").mask("+99 (99) 99999999?9");
        $(".cep").mask("99999-999");
        $("input[name*=estado").mask('hh');
        //$(".pass").mask("******");


        $('.inscricaoForm').validate({
            rules: {
                "participante[p_titulacao]": {
                    required: true
                },
                "p_comprovante_matricula": {
                    required: true
                },
                "participante[p_email]": {
                    required: true,
                    email: true
                },
                "p_email2": {
                    required: true,
                    email: true,
                    equalTo: "#participante-p_email"
                },
                "participante[p_nome]": {
                    required: true
                },
                "participante[p_senha]": {
                    required: true,
                    maxLength: 6
                },
                "p_senha2": {
                     required: true, equalTo: "#participante-p_senha", maxLength: 6

                }
            },
            errorPlacement: function(error, element) {

            }
        });

        /*$('#recovery').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: 'http://www.jirs2015.com.br/index.php/recovery',
                data: $('#email_recuperar').val(),
                success: function(e) {
                    $("#resposta_senha .sucesso").show();
                },
                error: function(e) {
                    $("#resposta_senha .erro").show();
                }
            });
        });*/

    });
});