
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

        $nome = (string) readline("Digite o nome do aluno: ");
        $idade = readline("Digite a idade do aluno: ");
        $total_aulas = readline("Digite o total de aulas do semestre: ");

        if (!ctype_digit($total_aulas) || $total_aulas == 0) {
            echo "Erro: digite um total de aulas inteiro maior que zero.\n";
            continue;
        }

        if (!ctype_digit($idade)) {
            echo "Erro: digite somente números inteiros para a idade.\n";
            continue;
        }

        $idade = (int) $idade;
        $total_aulas = (int) $total_aulas;

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
            "presencas" => null,
            "frequencia" => null
        ];

        echo "Aluno " . $nome . " cadastrado com sucesso!\n";

    } elseif ($opcao == 2) {
        echo "Cálculo de Notas\n";

        if (count($alunos) == 0) {
            echo "Nenhum aluno cadastrado. Cadastre um aluno primeiro.\n";
            continue;
        }

        foreach ($alunos as $indice => $aluno) {
            echo ($indice + 1) . ". " . $aluno["nome"] . "\n";
        }

        $escolha = readline("Digite o número do aluno: ");

        if (!ctype_digit($escolha) || $escolha < 1 || $escolha > count($alunos)) {
            echo "Aluno inválido.\n";
            continue;
        }

        $indice = (int) $escolha - 1;

        $nota1 = (float) readline("Digite a primeira nota do aluno: ");
        $nota2 = (float) readline("Digite a segunda nota do aluno: ");

        if (
            $nota1 < NOTA_MINIMA || $nota1 > NOTA_MAXIMA ||
            $nota2 < NOTA_MINIMA || $nota2 > NOTA_MAXIMA
        ) {
            echo "Notas devem estar entre 0 e 10.\n";
            continue;
        }

        $total_aulas = $alunos[$indice]["total_aulas"];

        $presencas = readline("Quantas aulas o aluno frequentou? ");

        if (!ctype_digit($presencas) || $presencas > $total_aulas) {
            echo "Quantidade de presenças inválida.\n";
            continue;
        }

        $presencas = (int) $presencas;
        $frequencia = ($presencas / $total_aulas) * 100;
        $media = calcularNotas($nota1, $nota2);

        $alunos[$indice]["nota1"] = $nota1;
        $alunos[$indice]["nota2"] = $nota2;
        $alunos[$indice]["media"] = $media;
        $alunos[$indice]["presencas"] = $presencas;
        $alunos[$indice]["frequencia"] = $frequencia;

        if ($frequencia < 70) {
            echo "Aluno reprovado por falta.\n";
        } elseif ($media == NOTA_MAXIMA) {
            echo "Nota máxima alcançada.\n";
        } elseif ($media == NOTA_MINIMA) {
            echo "Nota mínima.\n";
        } elseif ($media >= MEDIA_APROVACAO) {
            echo "Aluno está aprovado com média: $media\n";
        } elseif ($media >= MEDIA_RECUPERACAO) {
            echo "Aluno está em recuperação com média: $media\n";
        } else {
            echo "Aluno reprovado com média: $media\n";
        }

        echo "Frequência: " . number_format($frequencia, 2, ',', '.') . "%\n";

    } elseif ($opcao == 3) {
        echo "Relatório de Alunos\n";

        if (count($alunos) == 0) {
            echo "Nenhum aluno cadastrado.\n";
            continue;
        }

        foreach ($alunos as $aluno) {
            echo "\n-------------------------\n";
            echo "Nome: " . $aluno["nome"] . "\n";
            echo "Idade: " . $aluno["idade"] . "\n";
            echo "Total de aulas: " . $aluno["total_aulas"] . "\n";

            if ($aluno["media"] === null) {
                echo "Notas ainda não calculadas.\n";
            } else {
                echo "Nota 1: " . $aluno["nota1"] . "\n";
                echo "Nota 2: " . $aluno["nota2"] . "\n";
                echo "Média: " . number_format($aluno["media"], 2, ',', '.') . "\n";
                echo "Presenças: " . $aluno["presencas"] . "\n";
                echo "Frequência: " . number_format($aluno["frequencia"], 2, ',', '.') . "%\n";

                if ($aluno["frequencia"] < 70) {
                    echo "Situação: Reprovado por falta\n";
                } else {
                    echo "Situação: " . verificar($aluno["media"]) . "\n";
                }
            }
        }

        echo "-------------------------\n";

    } elseif ($opcao == 4) {
        echo "Saindo do sistema...\n";
        exit(0);

    } else {
        echo "Opção inválida. Tente novamente.\n";
    }
}
