<?php
namespace vAlmaraz\network\request;
use vAlmaraz\network\exception\NetworkException;
use vAlmaraz\network\response\Response;

/**
 * Created by vAlmaraz.
 * Date: 27/01/2017
 * Time: 19:44
 */
class Request {

    const VERB_GET = 'GET';
    const VERB_POST = 'POST';
    const VERB_PUT = 'PUT';
    const VERB_DELETE = 'DELETE';
    const VERBS = [Request::VERB_GET, Request::VERB_POST, Request::VERB_PUT, Request::VERB_DELETE];

    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $verb;
    /**
     * @var int
     */
    private $timeout;
    /**
     * @var array
     */
    private $headers;
    private $body;

    /**
     * NetworkRequest constructor.
     * @param $url
     * @param $verb
     * @throws NetworkException
     */
    public function __construct($url, $verb) {
        if (filter_var($url, FILTER_VALIDATE_URL) === false
            || !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)
        ) {
            throw new NetworkException('Invalid URL');
        }
        $this->url = $url;
        if (!in_array($verb, $this::VERBS)) {
            throw new NetworkException('Unsupported verb. Please use one of this: ' . json_encode($this::VERBS));
        }
        $this->verb = $verb;
    }

    /**
     * @param int $timeout
     * @return $this
     */
    public function setTimeout($timeout) {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function withHeaders($headers) {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param array $formData
     * @return $this
     */
    public function withFormData($formData) {
        $this->body = $formData;
        return $this;
    }

    /**
     * @return Response
     */
    public function execute() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->verb);
        if (!empty($this->headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($s, CURLOPT_MAXREDIRS, $this->_maxRedirects);
        // curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($s, CURLOPT_FOLLOWLOCATION, $this->_followlocation);
        // curl_setopt($s, CURLOPT_COOKIEJAR, $this->_cookieFileLocation);
        // curl_setopt($s, CURLOPT_COOKIEFILE, $this->_cookieFileLocation);
        if ($this->verb == $this::VERB_POST) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->body);
        }
        $response = curl_exec($ch);
        $responseStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize, strlen($response));
        curl_close($ch);
        return new Response($responseStatusCode, $headers, $body);
    }
}