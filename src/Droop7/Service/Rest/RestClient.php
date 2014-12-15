<?php

namespace Droop7\Service\Rest;


class RestClient implements HttpVerbs
{
    private $url;

    private $auth;

    private $credentials;

    private $serviceUrl;


    public function __construct($url, $restCredentials = null)
    {
        $this->auth         = CURLAUTH_NTLM;
        $this->url          = $url;
        $this->credentials  = $restCredentials;
    }

    public function setAuth($auth) {
        $this->auth = $auth;
        return $this;
    }

    /**
     * api
     * @param $endPoint
     * @return $this
     */
    public function setEndPoint($endPoint)
    {
        $this->serviceUrl   = $this->url . $endPoint;
        return $this;
    }

    /**
     * get
     * @param array $params
     * @return object
     */
    public function get()
    {
        return $this->execute($this->serviceUrl, $this->createContext('GET'));
    }

    /**
     * post
     * @param array $params
     * @return object
     */
    public function post($params = array())
    {
        $postParams = json_encode($params);
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postParams)
        );

        return $this->execute($this->serviceUrl, $this->createContext('POST', $postParams, $headers));
    }

    /**
     * put
     * @param null $pContent
     * @param array $pGetParams
     * @return object
     */
    public function put($params = array())
    {
        return $this->execute($this->serviceUrl, $this->createContext('PUT', $params));
    }

    /**
     * delete
     * @param null $pContent
     * @param array $pGetParams
     * @return array|bool
     */
    public function delete()
    {
        return $this->execute($this->serviceUrl, $this->createContext('DELETE'));
    }

    private function createContext($verb, $content = null, $headers = array())
    {
        $options = array(
            CURLOPT_SSLVERSION      => 3,
            CURLOPT_SSL_VERIFYHOST  => 2,
            CURLOPT_RETURNTRANSFER  => TRUE,
            CURLOPT_CONNECTTIMEOUT  => 10,
            CURLOPT_TIMEOUT         => 60,
            CURLOPT_SSL_VERIFYPEER  => FALSE,
            CURLOPT_CUSTOMREQUEST   => $verb,
            CURLOPT_HTTPHEADER      => array_merge(array(
                "Accept: application/json;",
                'Expect:',
            ), $headers),
        );

        if (!is_null($this->credentials)) {
            $options[CURLOPT_USERPWD] = $this->credentials;
        }

        $options[CURLOPT_HTTPAUTH] = $this->auth;

        if ($verb == 'POST') {
            $options[CURLOPT_POST]         = true;
            $options[CURLOPT_POSTFIELDS]   = $content;
        }

        return $options;
    }

    private function execute($url, $context)
    {
        $ch                     = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt_array($ch, $context);

        $result     = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpStatus !== 200) {
            throw new \Exception('ERROR connexion webservice - Code erreur ' . $httpStatus, $httpStatus);
        }

        return (object) array('content'   => $result);

    }
}
