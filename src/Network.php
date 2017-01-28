<?php
namespace vAlmaraz\network;
use vAlmaraz\network\request\Request;

/**
 * Created by vAlmaraz.
 * Date: 27/01/2017
 * Time: 19:44
 */
class Network {

    /**
     * @param $url
     * @return Request
     */
    public static function get($url) {
        return new Request($url, Request::VERB_GET);
    }

    public static function post($url) {
        return new Request($url, Request::VERB_POST);
    }

    public static function put($url) {
        return new Request($url, Request::VERB_PUT);
    }

    public static function delete($url) {
        return new Request($url, Request::VERB_DELETE);
    }
}