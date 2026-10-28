<?php

const PESO_NOTA1 = 4.0;
const PESO_NOTA2 = 6.0;
const NOTA_MINIMA = 0.0;
const NOTA_MAXIMA = 10.0;
const MEDIA_APROVACAO = 7.0;
const MEDIA_RECUPERACAO = 5.0;
const IDADE_MINIMA = 16;

echo "===============================\n";
echo " Sistema de Notas do Wagner\n";
echo "===============================\n";

$alunos = [];
function verificar($media) {
    if ($media >= MEDIA_APROVACAO) {
        return "Aprovado";
    } elseif ($media >= MEDIA_RECUPERACAO) {
        return "Recuperação";
    } else {
        return "Reprovado";
    }
}

function calcularNotas($nota1, $nota2) {
    $media = (
        $nota1 * PESO_NOTA1 +
        $nota2 * PESO_NOTA2
    ) / (PESO_NOTA1 + PESO_NOTA2);

    return $media;
}

while (true) {
    echo "\n";
    echo "---Menu---\n";
    echo "1. Cadastrar Aluno\n";
    echo "2. Calcular notas\n";
    echo "3. Ver relatório\n";
    echo "4. Sair\n";
    $opcao = readline("Escolha uma opção: ");

    if ($opcao == 1) {
        echo "Cadastro de Aluno\n";

        $nome = (string) readline("Digite seu nome: ");
        $idade = readline("Digite sua idade: ");
        $total_aulas = readline("Digite o total de aulas do semestre: ");

        $frequencia_aulas = $total_aulas * 0.70;

        //verifica se a total de aulas é um número inteiro
        if (!ctype_digit($total_aulas)) {
            echo "Erro: digite somente números inteiros para o total de aulas.\n";
            continue;
        }
        //verifica se a idade é um número inteiro
        if (!ctype_digit($idade)) {
         echo "Erro: digite somente números inteiros para a idade.\n";
        continue;
}

$idade = (int) $idade;

        if ($idade < IDADE_MINIMA) {
            echo "Idade mínima para cadastro é de 16 anos.\n";
            continue;
        }

        $alunos[] = [
            "nome" => $nome,
            "idade" => $idade,
            "nota1" => null,
            "nota2" => null,
            "media" => null,
            "total_aulas" => $total_aulas,
        ];

        echo "Aluno " . $nome . " cadastrado com sucesso!\n";

    

    } elseif ($opcao == 2) {
        echo "Cálculo de Notas\n";

        if (count($alunos) == 0) {
            echo "Nenhum aluno cadastrado. Cadastre um aluno primeiro.\n";
            continue;
        }

        $nota1 = (float) readline("Digite a primeira nota: ");
        $nota2 = (float) readline("Digite a segunda nota: ");

        if (
            $nota1 < NOTA_MINIMA || $nota1 > NOTA_MAXIMA ||
            $nota2 < NOTA_MINIMA || $nota2 > NOTA_MAXIMA
        ) {
            echo "Notas devem estar entre 0 e 10.\n";
            continue;
        }

        $media = calcularNotas($nota1, $nota2);

        if ($media == NOTA_MAXIMA) {
            echo "Nota máxima alcançada.\n";
        } elseif ($media == NOTA_MINIMA) {
            echo "Nota mínima alcançada.\n";
        } elseif ($media >= MEDIA_APROVACAO) {
            echo "Aluno aprovado com média: $media\n";
        } elseif ($media >= MEDIA_RECUPERACAO) {
            echo "Aluno em recuperação com média: $media\n";
        } else {
            echo "Aluno reprovado com média: $media\n";
        }

    } elseif ($opcao == 3) {
        echo "Relatório de Alunos\n";

    } elseif ($opcao == 4) {
        echo "Saindo do sistema...\n";
        exit(0);

    } else {
        echo "Opção inválida. Tente novamente.\n";
    }
}
