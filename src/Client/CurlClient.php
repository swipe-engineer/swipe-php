<?php

namespace Swipe\Client;

class CurlClient extends BaseCurlClient
{
    protected static $instance;

    public static function instance()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function __construct()
    {
        $this->curlHandle = curl_init();
    }

    public function generateMethod()
    {
        switch ($this->method) {

            case parent::METHOD_GET:

                curl_setopt($this->curlHandle, CURLOPT_HTTPGET, 1);

                break;

            case self::METHOD_FILE:

                curl_setopt($this->curlHandle, CURLOPT_POST, 1);

                if (!empty($this->files)) {
                    $this->headers['Content-Type'] = self::MIME_FORM_DATA;
                } elseif (empty($this->headers['Content-Type'])) {
                    $this->headers['Content-Type'] = self::MIME_X_WWW_FORM;
                }

                if ($this->headers['Content-Type'] === self::MIME_JSON) {
                    $data = json_encode($this->post_data);
                } else {
                    $data = http_build_query($this->post_data);
                }

                break;

            case self::METHOD_POST:

                curl_setopt($this->curlHandle, CURLOPT_POST, 1);

                if ($this->headers['Content-Type'] === self::MIME_JSON) {
                    $data = json_encode($this->post_data);
                } else {
                    $data = http_build_query($this->post_data);
                }

                curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $data);

                $this->headers['Content-Length'] = strlen($data);

                break;

            case self::METHOD_PATCH:

                curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, self::METHOD_PATCH);

                break;

            case self::METHOD_PUT:

                curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, self::METHOD_PUT);

                if ($this->headers['Content-Type'] === self::MIME_JSON) {
                    $data = json_encode($this->post_data);
                } else {
                    $data = http_build_query($this->post_data);
                }

                curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $data);

                break;

            case self::METHOD_DELETE:

                curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, self::METHOD_DELETE);

                break;

            default:

                throw new \Exception('Method not set');
        }
    }

    public function generateHeader()
    {
        $data = [];

        foreach ($this->headers as $key => $values) {
            if (is_array($values)) {
                foreach ($values as $value) {
                    $data[] = "$key: $value";
                }
            } else {
                $data[] = "$key: $values";
            }
        }

        curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, $data);
    }

    public function generateCookies()
    {
        $data = [];

        foreach ($this->cookies as $key => $value) {
            $data[] = "$key=$value";
        }

        curl_setopt($this->curlHandle, CURLOPT_COOKIE, implode('; ', $data));
    }

    public function execute()
    {
        $this->generateMethod();

        if (!empty($this->headers)) {
            $this->generateHeader();
        }

        if (!empty($this->cookies)) {
            $this->generateCookies();
        }

        curl_setopt($this->curlHandle, CURLOPT_URL, $this->url);
        curl_setopt($this->curlHandle, CURLOPT_USERAGENT, $this->user_agent);
        curl_setopt($this->curlHandle, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curlHandle, CURLOPT_HEADER, 1);

        $response = curl_exec($this->curlHandle);
        $error    = curl_error($this->curlHandle);
        $errno    = curl_errno($this->curlHandle);

        $header_size = curl_getinfo($this->curlHandle, CURLINFO_HEADER_SIZE);

        curl_close($this->curlHandle);

        if ($response === false) {
            throw new \RuntimeException($error, $errno);
        }

        $content   = substr($response, $header_size);
        $json_data = json_decode($content, true);

        return $json_data;
    }
}
