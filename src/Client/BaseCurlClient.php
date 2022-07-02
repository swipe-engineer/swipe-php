<?php

namespace Swipe\Client;

class BaseCurlClient
{
    protected $url;
    protected $curlHandle;
    protected $timeout    = 30;
    protected $user_agent = null;
    protected $method     = self::METHOD_GET;
    protected $get_data   = [];
    protected $post_data  = [];
    protected $cookies    = [];
    protected $headers    = [];
    protected $files      = [];

    const METHOD_POST   = 'POST';
    const METHOD_PUT    = 'PUT';
    const METHOD_GET    = 'GET';
    const METHOD_PATCH  = 'PATCH';
    const METHOD_FILE   = 'FILE';
    const METHOD_DELETE = 'DELETE';

    const MIME_X_WWW_FORM = 'application/x-www-form-urlencoded';
    const MIME_FORM_DATA  = 'multipart/form-data';
    const MIME_JSON       = 'application/json';

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setUserAgent($user_agent)
    {
        $this->user_agent = $user_agent;
        return $this;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function setPostParams($data)
    {
        $this->post_data = array_merge($this->post_data, $data);
        return $this;
    }

    public function setGetParams($data)
    {
        $this->get_data = array_merge($this->get_data, $data);
        return $this;
    }

    public function setHeaders($data)
    {
        foreach ($data as $key => $val) {
            $this->headers[self::fixStringCase($key)] = $val;
        }

        return $this;
    }

    public function setCookies($data)
    {
        $this->cookies = array_merge($this->cookies, $data);
        return $this;
    }

    public function setCookieFile($filename)
    {
        curl_setopt($this->curlHandle, CURLOPT_COOKIEJAR, $filename);
        curl_setopt($this->curlHandle, CURLOPT_COOKIEFILE, $filename);

        return $this;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    protected static function fixStringCase($str)
    {
        $str = explode('-', $str);

        foreach ($str as &$word) {
            $word = ucfirst($word);
        }

        return implode('-', $str);
    }
}
