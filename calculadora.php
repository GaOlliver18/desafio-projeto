<?php

function wagner (int $n1, int $n2, string $clock) {


    switch ($clock) {
        case "somar":
            echo "A soma de $n1 + $n2 é: = " . ($n1 + $n2);
            break;

        case "subtrair":
            echo "A subtração de $n1 - $n2 é: = " . ($n1 - $n2);
            break;

        case "multiplicar":
            echo "A multiplicação de $n1 * $n2 é: = " . ($n1 * $n2);
            break;

        case "dividir":
             if ($n2 != 0) {
                echo "A divisão de $n1 / $n2 é: = " . ($n1 / $n2);
            } else {
                echo "Não é possível dividir por 0";
            }
            
            break;
        default:
            return "Mensagem errada, tente novamente!";
}
}


echo "===============================\n";
echo "   Calculadora do Wagner\n";
echo "===============================\n";

$n1 = (int) readline("Digite o primeiro número: ");
$n2 = (int) readline("Digite o segundo número: ");
$opcao = (string) readline("Digite a operação desejada (somar, subtrair, multiplicar, dividir): ");

echo wagner($n1, $n2, $opcao);