<?php


namespace vianafgluiz\Recognition\Resources;

use vianafgluiz\Recognition\Url;

/**
 * @class: Classe responsável pelo Gerenciamento de Comparasions na API
 * @author: luiz@ivare.com.br
 */
class Compare
{
    private $token;

    /**
     * @construct: Construtor recebe como parâmetro $token retornado na autenticação
     * @author: luiz@ivare.com.br
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function compareByID(int $id) {
        /* Datas */
        $headers = array(
            "Content-type: application/x-www-form-urlencoded",
            "Authorization: Token " . $this->token
        );

        /* Abro a conexão CURL */
        $ch = curl_init();

        /* Seto a URL, o header, a quantidade e quais estou enviado */
        curl_setopt($ch, CURLOPT_URL, Url::COMPARE . $id . "/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        /* Executo a requisição */
        $response = curl_exec($ch);
        $statusCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

        /* Fecho a conexão CURL */
        curl_close($ch);

        if($statusCode == 200)
            return $response;

        return $statusCode;
    }

    /**
     * @define: Retornar todas as comparações baseada no usuario que possui o token enviado
     * @return
     * @author: luiz@ivare.com.br
     */
    public function allComparisions() {
        /* Datas */
        $headers = array(
            "Content-type: application/x-www-form-urlencoded",
            "Authorization: Token " . $this->token
        );

        /* Abro a conexão CURL */
        $ch = curl_init();

        /* Seto a URL, o header, a quantidade e quais estou enviado */
        curl_setopt($ch, CURLOPT_URL, Url::COMPARE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        /* Executo a requisição */
        $response = curl_exec($ch);
        $statusCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

        /* Fecho a conexão CURL */
        curl_close($ch);

        if($statusCode == 200)
            return $response;

        return $statusCode;
    }

    public function compareImages($sourceImage, $targetImage, $confidence = 0.6) {
        $headers = array(
            "Content-type: application/x-www-form-urlencoded",
            "Authorization: Token " . $this->token
        );

        $datas = array(
            'sourceImage' => $sourceImage,
            'targetImage' => $targetImage,
            'confidence' => $confidence
        );

        /* Abro a conexão CURL */
        $ch = curl_init();

        /* Seto a URL, o header, a quantidade e quais estou enviado */
        curl_setopt($ch, CURLOPT_URL, Url::IMAGES);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch,CURLOPT_POST, count($datas));
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($datas));

        /* Executo a requisição */
        $response = curl_exec($ch);
        $statusCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

        /* Fecho a conexão CURL */
        curl_close($ch);

        if($statusCode == 200)
            return $response;

        return $statusCode;
    }

}