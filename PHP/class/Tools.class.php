<?php

class Tools {
  
  /**
   * Return page POST content.
   *
   * @param string $url The url to get
   * @param array $data POST parameters
   *
   * @return string Json encoded content
   */
  public static function httpPost($url, $data) {
    $data_url = http_build_query($data);
    $data_len = strlen($data_url);
    return file_get_contents($url, false, stream_context_create(array('http' => array('method' => 'POST', 'header' => "Connection: close\r\nContent-Length: $data_len\r\n", 'content' => $data_url))));
  }

  /**
   * Return page GET content.
   *
   * @param string $url The url to get.
   *
   * @return string Json encoded content
   */
  public static function httpGet($url) {
    return file_get_contents($url);
  }

  /**
   * Make an API request.
   *
   * @param string $action The API action
   * @param array $data POST parameters (optional)
   *
   * @return array The request result.
   */
  public static function apiRequest($action, $data = null) {
    $url = "http://api.uplea.com/".$action;
    if ($data)
      return json_decode(Tools::httpPost($url, array('json' => json_encode($data))), true);
    return json_decode(Tools::httpPost($url), true);
  }

}