<?php

// NameSpace
namespace DuugWork\Helper;

// Inicia a classe SendCurl
class SendCurl
{
    // Variaveis
    private $header;


    /**
     * Método responsável por criar a array de conteudo header
     * que será envia nas solicitações.
     * -------------------------------------------------------------
     * @param $campo
     * @param $valor
     */
    public function setHeader($campo, $valor)
    {
        // Verifica se possui conteudo
        if(!empty($this->header))
        {
            // Adiciona o item ao array
            array_push($this->header, "{$campo}: {$valor}");
        }
        else
        {
            // Adiciona o primeiro item no array
            $this->header = ["{$campo}: {$valor}"];
        }

    } // End >> fun::setHeader()


    /**
     * Método responsável por realizar requisições para a api de integração
     * com o melhor envio envio.
     * ----------------------------------------------------------------------------
     * @param $url
     * @param array $conteudo
     * @param string $metodo
     * ----------------------------------------------------------------------------
     * @return array $response
     */
    public function resquest($url, $conteudo, $metodo = "POST", $jsonDecode = false)
    {
        // Inicia o curl
        $curl = curl_init();

        // Configura o envio
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $metodo,
            CURLOPT_POSTFIELDS => $conteudo,
            CURLOPT_HTTPHEADER => $this->header,
        ));

        // Execulta a solicitação
        $response = curl_exec($curl);

        // Fecha a solicitação
        curl_close($curl);

        // Verifica se é para decodificar
        if($jsonDecode == true)
        {
            // Decodifica
            $response = json_decode($jsonDecode);
        }

        // Retorna o resultado
        return $response;

    } // End >> fun::resquest()

} // End >> Class::SendCurl()