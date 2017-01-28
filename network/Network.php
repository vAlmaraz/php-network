<?php
namespace network;
use network\entities\NetworkRequest;

/**
 * Created by vAlmaraz.
 * Date: 27/01/2017
 * Time: 19:44
 */
class Network {

    /**
     * @param $url
     * @return NetworkRequest
     */
    public static function get($url) {
        return new NetworkRequest($url, NetworkRequest::VERB_GET);
    }

    public static function post($url) {
        return new NetworkRequest($url, NetworkRequest::VERB_POST);
    }

    public static function put($url) {
        return new NetworkRequest($url, NetworkRequest::VERB_PUT);
    }

    public static function delete($url) {
        return new NetworkRequest($url, NetworkRequest::VERB_DELETE);
    }
}