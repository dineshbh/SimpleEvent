$.fn.ready(function() {

    $(document).ready(function() {

        /**
         *  mask form
         */

        $(".cpf").mask("999.999.999-99");
        $(".rg").mask("9999999-9");
        $(".data").mask("99/99/9999");
        //$(".fone_int").mask("+99 (99) 9999-9999");
        $(".cep").mask("99999-999");
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

    });
});