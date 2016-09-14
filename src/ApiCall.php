<?php

namespace ns1\ops;

/**
 * Api calls leveraging ops-api endpoints
 * Class ApiCall
 * @package ns1\ops
 */
class ApiCall implements iApiCall
{
    /**
     * API request return body JSON
     * @var string JSON return
     */
    protected $body;

    /**
     * @param $arg_array
     * @return mixed
     */
    protected function baseCurl($arg_array)
    {
        $ch = \curl_init();
        \curl_setopt($ch, \CURLOPT_URL, self::BASEURL . $arg_array['arg']);
        if (isset($arg_array['opt'])) {
            \curl_setopt($ch, \CURLOPT_POST, true);
            \curl_setopt($ch, \CURLOPT_SAFE_UPLOAD, false);
            \curl_setopt($ch, \CURLOPT_POSTFIELDS, $arg_array['opt']);
            \curl_setopt($ch, \CURLOPT_HEADER, false);
            \curl_setopt($ch, \CURLOPT_FOLLOWLOCATION, true);
            \curl_setopt($ch, \CURLOPT_SSL_VERIFYPEER, false);
        }
        if (isset($arg_array['del'])) {
            \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, "DELETE");
        }
        if (isset($arg_array['put'])) {
            \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, "PUT");
        }
        if (isset($arg_array['post'])) {
            \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, "POST");
        }
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        $this->body = \json_decode(\curl_exec($ch));
        \curl_close($ch);
        return $this->body;
    }
}