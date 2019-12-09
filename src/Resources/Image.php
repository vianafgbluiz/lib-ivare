<?php


namespace vianafgluiz\Recognition\Resources;


use vianafgluiz\Recognition\Url;

/**
 * @class: Classe responsável pelo Gerenciamento de Images na API
 * @author: luiz@ivare.com.br
 */
class Image
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

    public function imageByID(int $id) {
        /* Datas */
        $headers = array(
            "Content-type: application/x-www-form-urlencoded",
            "Authorization: Token " . $this->token
        );

        /* Abro a conexão CURL */
        $ch = curl_init();

        /* Seto a URL, o header, a quantidade e quais estou enviado */
        curl_setopt($ch, CURLOPT_URL, Url::IMAGES . $id . "/");
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
     * @define: Retornar todas as images baseada no usuario que possui o token enviado
     * @return Image
     * @author: luiz@ivare.com.br
     */
    public function allImages() {
        /* Datas */
        $headers = array(
            "Content-type: application/x-www-form-urlencoded",
            "Authorization: Token " . $this->token
        );

        /* Abro a conexão CURL */
        $ch = curl_init();

        /* Seto a URL, o header, a quantidade e quais estou enviado */
        curl_setopt($ch, CURLOPT_URL, Url::IMAGES);
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
     * @define: Envia uma imagem
     * @return JSON contendo a imagem criada
     * @author: luiz@ivare.com.br
     */
    public function send($collectionId, $image64) {
        /* Datas */
        $headers = array(
            "Content-type: application/x-www-form-urlencoded",
            "Authorization: Token " . $this->token
        );

        $datas = array(
            'collection_id' => $collectionId,
            'file' => $image64
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

        if($statusCode == 201)
            return $response;

        return $statusCode;
    }
}