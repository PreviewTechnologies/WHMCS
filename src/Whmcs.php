<?php

namespace Previewtechs\WHMCS;

/**
 * Class Whmcs
 * @package Lib
 */
class Whmcs
{
    /**
     * @var mixed
     */
    protected $adminUserName;

    /**
     * @var mixed
     */
    protected $adminUserPassword;

    /**
     * @var mixed
     */
    protected $apiUrl;

    /**
     * @var
     */
    protected $response;

    /**
     * @var string
     */
    protected $responseType = 'json';

    /**
     * Whmcs constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        if (array_key_exists('admin_username', $options)) {
            $this->adminUserName = $options['admin_username'];
        }

        if (array_key_exists('admin_password', $options)) {
            $this->adminUserPassword = $options['admin_password'];
        }

        if (array_key_exists('api_url', $options)) {
            $this->apiUrl = $options['api_url'];
        }
    }

    /**
     * @return mixed
     */
    public function getAdminUserName()
    {
        return $this->adminUserName;
    }

    /**
     * @param mixed $adminUserName
     */
    public function setAdminUserName($adminUserName)
    {
        $this->adminUserName = $adminUserName;
    }

    /**
     * @return mixed
     */
    public function getAdminUserPassword()
    {
        return $this->adminUserPassword;
    }

    /**
     * @param mixed $adminUserPassword
     */
    public function setAdminUserPassword($adminUserPassword)
    {
        $this->adminUserPassword = $adminUserPassword;
    }

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param mixed $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getResponseType()
    {
        return $this->responseType;
    }

    /**
     * @param string $responseType
     */
    public function setResponseType($responseType)
    {
        $this->responseType = $responseType;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function request($params)
    {
        $params = array_merge([
            'username' => $this->adminUserName,
            'password' => md5($this->adminUserPassword),
            'responsetype' => $this->responseType,
        ], $params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        return $this->response = curl_exec($ch);
    }
}
