<?php
namespace network\entities;

/**
 * Created by vAlmaraz.
 * Date: 27/01/2017
 * Time: 19:44
 */
class NetworkResponse {

    /**
     * @var int
     */
    private $statusCode;
    /**
     * @var array
     */
    private $headers;
    /**
     * @var string
     */
    private $body;

    public function __construct($statusCode, $headers, $body) {
        $this->statusCode = intval($statusCode);
        $this->parseHeaders($headers);
        $this->body = trim($body);
    }

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function getBody() {
        return $this->body;
    }

    private function parseHeaders($headers) {
        $headersAsArray = explode("\r\n", $headers);
        foreach ($headersAsArray as $header) {
            $header = trim($header);
            if (!empty($header)) {
                $dotsPosition = strpos($header, ':');
                if ($dotsPosition !== false) {
                    $this->headers[substr($header, 0, $dotsPosition)] = trim(substr($header, $dotsPosition + 1, strlen($header)));
                } else {
                    $this->headers[] = $header;
                }
            }
        }
    }
}