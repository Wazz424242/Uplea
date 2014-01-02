<?php

require_once 'Tools.class.php';

class Uplea {

  /**
   * User username 
   *
   * @var string
   */
  protected $username;

  /**
   * User password 
   *
   * @var string
   */
  protected $password;

  /**
   * The api key received in exchange for a valid auth request.
   *
   * @var string
   */
  protected $api_key;

  /**
   * Indicates if authentified 
   *
   * @var boolean
   */
  protected $guest = true;


  /**
   * Initialize a Uplea Application.
   *
   * The configuration:
   * - username: the user username
   * - password: the user password
   *
   * @param array $config The application configuration
   */
  public function __construct($config = null) {
    if (!session_id()) {
      session_start();
    }
    if ($config && $this->checkConfig($config)) {
      $this->initSession($config);
    }
  }

  /**
   * Set the Username.
   *
   * @param string $username The username
   */
  protected function setUsername($username) {
    $this->username = $username;
  }

  /**
   * Set the Password.
   *
   * @param string $password The password
   */
  protected function setPassword($password) {
    $this->username = $username;
  }

  /**
   * Set the Api Key.
   *
   * @param string $api_key The API Key
   */
  protected function setApiKey($api_key) {
    $this->api_key = $api_key;
  }

  /**
   * Get the Username.
   *
   * @return string The username
   */
  protected function getUsername() {
    return $this->username;
  }

  /**
   * Get the Password.
   *
   * @return string The password
   */
  protected function getPassword() {
    return $this->password;
  }

  /**
   * Get the Api Key.
   *
   * @return string The API Key
   */
  protected function getApiKey() {
    return $this->api_key;
  }

  /**
   * Check config parameters.
   *
   * @param array $config The application configuration
   *
   * @return boolean
   */
  private function checkConfig($config) {
    if (!isset($config['username']) || empty($config['username']))
      ;//Exception
    if (!isset($config['password']) || empty($config['password']))
      ;//Exception
  }

  /**
   * Initialize dial parameters.
   *
   * @param array $config The application configuration
   */
  private function initSession($config) {
    $this->username = $config['username'];
    $this->password = $config['password'];
    if ($this->getMyApiKey()) {
      $this->guest = false;
    }
  }

  /**
   * Get and store the user Api Key.
   *
   * @return boolean
   */
  public function getMyApiKey() {
    $data = array("username" => $this->getUsername(), "password" => $this->getPassword());
    $res = Tools::apiRequest("get-my-api-key", $data);
    if (isset($res['status']) && $res['status'] === true) {
      $this->setApiKey($res['result']['api_key']);
      return true;
    }
    return false;
  }

  /**
   * Get a slot on upload node with token.
   *
   * @return mixed The name (url for upload) and the token, of false if there is an API error.
   */
  public function getBestNode() {
    $res = Tools::apiRequest("get-best-node");
    if (isset($res['status']) && $res['status'] === true)
      return $res['result'];
    return false;
  }

}