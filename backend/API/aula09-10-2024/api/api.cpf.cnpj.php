<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API CPF ou CNPJ</title>
</head>
<body>
    <form id="api-cpf-cnpj" onsubmit="event.preventDefault(); validaDocumento()">
        <label for="cpf-cnpj">CPF/CNPJ</label>
        <input type="text" id="cpf-cnpj" name="cpf-cnpj" minlength="11" maxlength="14" required>

        <button type="submit">Validar</button>
    </form>
    <div id="msg-alert"></div>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        async function validaDocumento() {
            // remover a máscara antes de enviar
            const documento = document.getElementById('cpf-cnpj').value.replace(/\D/g, '');

            try {
                const response = await fetch('api.documentos.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ document: documento })
                });

                if (!response.ok) {
                    throw new Error(`Erro na resposta: ${response.status}`);
                }

                const result = await response.json();
                console.log(result);

                const resultDiv = document.getElementById('msg-alert');
                resultDiv.innerHTML = `Documento: ${result.document}, válido: ${result.valid}.`;

                // redefinir o campo após a validação
                resetarCampo();

            } catch (error) {
                console.log('ERRO: ', error);
                document.getElementById('msg-alert').innerHTML = 'Erro ao validar o documento. Tente novamente.';
            }
        }

        // Função para resetar o campo
        function resetarCampo() {
            $('#cpf-cnpj').unmask();
            $('#cpf-cnpj').mask('000.000.000-00#', {
                onKeyPress: function (cpf, ev, el, op) {
                    var maskCpfCnpj = ['000.000.000-000', '00.000.000/0000-00'];
                    $('#cpf-cnpj').mask((cpf.length > 14) ? maskCpfCnpj[1] : maskCpfCnpj[0], op);
                }
            });
        }

        $(document).ready(function () {
            $('#cpf-cnpj').mask('000.000.000-00#', {
                onKeyPress: function (cpf, ev, el, op) {
                    var maskCpfCnpj = ['000.000.000-000', '00.000.000/0000-00'];
                    $('#cpf-cnpj').mask((cpf.length > 14) ? maskCpfCnpj[1] : maskCpfCnpj[0], op);
                }
            });
        });
    </script>
</body>
</html>
