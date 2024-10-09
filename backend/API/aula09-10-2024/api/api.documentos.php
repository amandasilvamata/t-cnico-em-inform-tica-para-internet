<?php
// Habilita a exibição de erros para debugging
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Processa a entrada JSON
$data = json_decode(file_get_contents("php://input"));

if (isset($data->document)) {
    $document = $data->document;

    // Lógica de validação do CPF e CNPJ
    $isValid = validarDocumento($document);

    $response = [
        'document' => $document,
        'valid' => $isValid
    ];
} else {
    $response = ['error' => 'Documento não fornecido!'];
}

echo json_encode($response);

function validarDocumento($document) {
    // Remove caracteres não numéricos
    $document = preg_replace('/\D/', '', $document);

    // Verifica se o documento é CNPJ ou CPF
    if (strlen($document) == 14) {
        return validaCNPJ($document);
    } else if (strlen($document) == 11) {
        return validaCPF($document);
    }

    return false;
}

// Função para validar o CNPJ
function validaCNPJ($cnpj) {
    // Verifica se o CNPJ tem de fato 14 dígitos
    if (strlen($cnpj) !== 14) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
        return false;
    }

    // Valida o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 12; $i++) {
        $soma += $cnpj[$i] * (($i < 4) ? 5 - $i : 13 - $i);
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    // Valida o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 13; $i++) {
        $soma += $cnpj[$i] * (($i < 5) ? 6 - $i : 14 - $i);
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    // Retorna verdadeiro se os dígitos verificadores estiverem corretos
    return $cnpj[12] == $digito1 && $cnpj[13] == $digito2;
}

// Função para validar CPF
function validaCPF($cpf) {
    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) !== 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    // Valida o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    // Valida o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += $cpf[$i] * (11 - $i);
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    // Retorna verdadeiro se os dígitos estiverem corretos
    return $cpf[9] == $digito1 && $cpf[10] == $digito2;
}
?>
