<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * CallApi is the model to be used for calling APIs
 */
class CallApi extends Model
{
    public static function request($type, $url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $type,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
