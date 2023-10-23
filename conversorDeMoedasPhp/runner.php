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
            function request(string $urlApi)
            {

                //Iniciando a sessão curl
                $curlSession = curl_init($urlApi);

                //Definindo os parâmetros
                curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);


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


            $data = request($urlApi);


            $dados = json_decode($data, true);



            if ($dados && isset($dados['value']) && !empty($dados['value'])) {

                $cotacaoCompra = $dados['value'][0];

                echo "Cotação de Compra: " . $cotacaoCompra['cotacaoCompra'] . "<br>";


                $valor = $_POST["valor"] ?? "sem_numero";
                switch ($_POST["moeda"]) {
                    case "USD":

                        $USD = numfmt_create("us", NumberFormatter::CURRENCY);
                        $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
                        $resultado = $valor / $cotacaoCompra['cotacaoCompra'];

                        echo "Resultado: Seus  " . numfmt_format_currency($padrao, $valor, "BRL") . " equivalem a " . numfmt_format_currency($USD, $resultado, "USD");
                        break;
                    case "EUR":
                        $EUR = numfmt_create("de_DE", NumberFormatter::CURRENCY);
                        $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                        $resultado = $valor / $cotacaoCompra['cotacaoCompra'];
                        echo "Resultado: Seus  " . numfmt_format_currency($padrao, $valor, "BRL") . " equivalem a " . numfmt_format_currency($EUR, $resultado, "EUR");
                        break;
                    case "JPY":
                        $JPY = numfmt_create("ja_JP", NumberFormatter::CURRENCY);
                        $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                        $resultado = $valor / $cotacaoCompra['cotacaoCompra'];
                        echo "Resultado: Seus  " . numfmt_format_currency($padrao, $valor, "BRL") . " equivalem a " . numfmt_format_currency($JPY, $resultado, "JPY");
                        break;

                    default:
                        echo "Nenhuma moeda selecionada";
                        break;
                }
            } else {
                echo "Nenhum valor digitado";
            }
        } else {
            echo "Dados de cotação não localizados neste momento.";
        }




        ?>
        <button onclick="javascript:history.go(-1)">&#x2B05; Voltar</button>

    </section>
</body>

</html>