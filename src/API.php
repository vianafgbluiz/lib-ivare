<?php

namespace vianafgluiz\Recognition;

/**
 * @class: Classe responsável pela Autenticação na API
 * @author: luiz@ivare.com.br
 */
class API
{
    private $username;
    private $password;

    /**
     * @construct: Construtor recebe como parâmetro $username e $password para autenticar
     * @author: luiz@ivare.com.br
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @define: Autenticação do usuário, retornando assim um token
     * @return $this->connect() que contém o token
     * @author: luiz@ivare.com.br
     */
    public function auth() : string {
        return $this->connect();
    }

    /**
     * @define: Função responsável pela autenticação e retorno do Token
     * @author: luiz@ivare.com.br
     */
    private function connect() {
        /* Datas */
        $headers = array("Content-type: application/x-www-form-urlencoded");
        $datas = array('username' => $this->username, 'password' => $this->password);

        /* Abro a conexão CURL */
        $ch = curl_init();

        /* Seto a URL, o header, a quantidade e quais estou enviado */
        curl_setopt($ch, CURLOPT_URL, URL::TOKEN);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch,CURLOPT_POST, count($datas));
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($datas));

        /* Executo a requisição */
        $response = curl_exec($ch);
        $statusCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

        /* Fecho a conexão CURL */
        curl_close($ch);

        /* Transformo em Objeto */
        $result = json_decode($response);

        if($statusCode == 200)
            return $result->token;

        return $response;
    }

}