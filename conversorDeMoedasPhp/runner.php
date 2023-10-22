<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .number-container {
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h1>
            Resultado
        </h1>
    </header>
    <section>

        <?php

        if (isset($_POST["valor"])) {

            //declaração da function Request
            function request(string $urlApi, string $cookie)
            {

                //Iniciando a sessão curl
                $curlSession = curl_init($urlApi);

                //Definindo os parâmetros
                curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curlSession, CURLOPT_HTTPHEADER, [
                    'Cookie: ' . $cookie,
                ]);

                $data = curl_exec($curlSession);

                if (curl_errno($curlSession)) {
                    echo 'Erro ao buscar informações' . curl_error($curlSession);
                }

                curl_close($curlSession);

                if ($data !== false) {
                    // The response is stored in the $response variable
                    return $data;
                } else {
                    echo 'Request failed.';
                }
            }


            //Montando um array com todos os parâmetros da consulta (por ser uma url dinâmica, validei que poderia dar algum erro ao disparar a consulta, portanto optei por realizar um tratamento e garantir a formação correta do endpoint de consulta).
            $moeda = $_POST["moeda"];
            $dataInicial = date('m-d-Y');
            $dataFinalCotacao = date('m-d-Y');

            $urlApi = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda='" . $moeda . "'&@dataInicial='" . $dataInicial . "'&@dataFinalCotacao='" . $dataFinalCotacao . "'&\$top=100&\$format=json&\$select=cotacaoCompra";


            define('cookie', 'TS01d9825e=012e4f88b356293b527c485f6879dccc579681ebbf114839d3297ad3e10c7d28b1830a47bf5be11442ffe8b9b8626e8f377063db76; dtCookie=26613C5AA100EBB4475AEEA5D1AF00C4|cHRheHwx; BIGipServer~was_p_as3~was_p~pool_was_443_p=4275048876.47873.0000; JSESSIONID=0000UGPUFrMf7vvUgDRnR7P1e9v:1dof85j5r; TS013694c2=012e4f88b3b796ad01ec3fb120e5f2921beb20f20ea272db276e54671d54f421701524c08b3c77402754631af866057a7139fd1e56');


            $data = request($urlApi, cookie);


            $dados = json_decode($data, true);

            var_dump($dados);
            
            if ($dados && isset($dados['value']) && !empty($dados['value'])) {
                $primeiroItem = $dados['value'][0];

                echo "Cotação de Compra: " . $primeiroItem['cotacaoCompra'] . "<br>";
            } else {
                echo "Dados não recuperados corretamente.";
            }


            $valor = $_POST["valor"] ?? "sem_numero";
            switch ($_POST["moeda"]) {
                case "USD":

                    $USD = numfmt_create("us", NumberFormatter::CURRENCY);
                    $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
                    $resultado = $valor / 5.06;

                    echo "Resultado: Seus  " . numfmt_format_currency($padrao, $valor, "BRL") . " equivalem a " . numfmt_format_currency($USD, $resultado, "USD");
                    break;
                case "EUR":
                    $EUR = numfmt_create("de_DE", NumberFormatter::CURRENCY);
                    $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                    $resultado = $valor / 5.33;
                    echo "Resultado: Seus  " . numfmt_format_currency($padrao, $valor, "BRL") . " equivalem a " . numfmt_format_currency($EUR, $resultado, "EUR");
                    break;
                case "YEN":
                    $YEN = numfmt_create("ja_JP", NumberFormatter::CURRENCY);
                    $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                    $resultado = $valor / 0.034;
                    echo "Resultado: Seus  " . numfmt_format_currency($padrao, $valor, "BRL") . " equivalem a " . numfmt_format_currency($YEN, $resultado, "JPY");
                    break;

                default:
                    echo "Nenhuma moeda selecionada";
                    break;
            }
        } else {
            echo "Nenhum valor digitado";
        }


        ?>
        <button onclick="javascript:history.go(-1)">&#x2B05; Voltar</button>

    </section>
</body>

</html>