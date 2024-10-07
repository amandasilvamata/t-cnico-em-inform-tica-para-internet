
$(document).ready(function () {
    // o $ estou trabalhando com um objeto JQuery
    const $cep = $('#cep');
    // o reverse faz com que o cursor se mova da direita para a esquerda que é útil para campos númericos
    $cep.mask('00000-000', { reverse: true });
})

// Função consultar a API pelo CEP
function consultaCEP() {

    //var cep = document.getElementById('cep').value;
    var cep = $('#cep').val() // em Jquery

    // Expressão regular para validar numeros
    if (!cep.match(/^[-0-9]+$/)) {
        alert("O CEP deve conter apenas números!");
        return;
    }

    // Consulta CEP na API - 'ViaCEP'
    // 'https://viacep.com.br/ws/05051000/json'    -- como o dado é enviado
    $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function (data) {

        if (!data.erro) {
            // o que a API deve retornar
            //document.getElementById('logradouro').value = data.logradouro;
            $('#logradouro').val(data.logradouro); // em Jquery
            document.getElementById('bairro').value = data.bairro;
            document.getElementById('cidade').value = data.localidade;
            document.getElementById('uf').value = data.uf;
            // Enviar o foco no numero do endereço
            $('#nlogradouro').focus();
        } else {
            alert('CEP não encontrado!');
        }

    });
}
