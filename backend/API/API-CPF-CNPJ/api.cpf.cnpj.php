<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API CPF ou CNPJ</title>
</head>
<body>
    <form id="api-cpf-cnpj">
        <label for="cpf-cnpj">CPF/CNPJ</label>
        <input type="text" id="cpf-cnpj" name="cpf-cnpj" minlength="13" maxlength="14">


        <!-- para celular -->
         <label for="celular-telefone">Celular ou Telefone</label>
         <input type="text" id="celular-telefone" name="celular-telefone" minlength="14" maxlength="18">
    </form>


     <!-- scripts -->
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        // conforme o usuário for digitando já vai sendo verificadp
        var optLength = {
            onKeyPress: function (cpf, ev, el, op){
                var maskCpfCnpj = ['000.000.000-000', '00.000.000/0000-00'];
                $('#cpf-cnpj').mask((cpf.length > 14)? maskCpfCnpj[1]: maskCpfCnpj[0], op);

            }
        }
        $('#cpf-cnpj').length > 11 ? $('#cpf-cnpj').mask('00.000.000/0000-00', optLength) : $('#cpf-cnpj').mask('000.000.000-00#', optLength);

        /*
        var telLength = {
            onKeyPress: function (cel, ev, el, op){
                var maskCelTel = ['(99)99999-9999', '(99)9999-9999'];
                $('#celular-telefone').mask((cel.length > 13)? maskCelTel[0]: maskCelTel[1], op);

            }
        }
        $('#celular-telefone').length > 13 ? $('#celular-telefone').mask('(99)99999-9999', telLength) : $('#cpf-cnpj').mask('(99)9999-9999#', telLength);
        */
        var telLength = {
    onKeyPress: function (cel, ev, el, op) {
        var maskCelTel = ['(99)99999-9999', '(99)9999-9999'];
        $(el).mask((cel.length > 13) ? maskCelTel[0] : maskCelTel[1], op);
    }
};

// Aplicação da máscara inicial ao campo de telefone
$('#celular-telefone').mask('(99)9999-9999', telLength); // A máscara inicial pode ser de 9 ou 10 dígitos


    </script>
</body>
</html>
