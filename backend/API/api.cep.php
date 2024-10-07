<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API CEP</title>
</head>
<body>
    <h1> Consulta de Endereço por CEP</h1>

    <form id="consulta-cep">
    <label for="cep">CEP</label><br>
    <input type="text" id="cep" name="cep" maxlength="9" placeholder="00000-000"><br>
    <!-- <input type="text" id="cep" name="cep" maxlength="9" placeholder="00000-000" onblur="consultaCEP()"><br> -->
     <button type="button" onclick="consultaCEP()">Consultar CEP</button><br>

    <label for=logradouro">Logradouro</label><br>
    <input type="text" id="logradouro" name="logradouro" readonly disabled><br>
    
    <label for=nlogradouro">Nº</label><br>
    <input type="text" id="nlogradouro" name="nlogradouro"><br>
    
    <label for=clogradouro">Complemento</label><br>
    <input type="text" id="clogradouro" name="clogradouro"><br>
    
    <label for="bairro">Bairro</label><br>
    <input type="text" id="bairro" name="bairro" readonly disabled><br>
    
    <label for="cidade">Cidade</label><br>
    <input type="text" id="cidade" name="cidade" readonly disabled><br>
    
    <label for="uf">Estado</label><br>
    <input type="text" id="uf" name="uf" readonly disabled><br>

    </form>


    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="api.cep.js"></script>
</body>
</html>
