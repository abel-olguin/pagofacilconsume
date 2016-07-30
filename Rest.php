<?php
namespace pagofacilconsume;
/**
 * Created by Vendetta.
 * User: abelolguinchavez
 * Date: 29/07/16
 * Time: 12:27
 */
class Rest
{
    public static function call($method, $url, $data = false)
    {
        $curl = curl_init();

        switch (strtoupper($method))
        {
            case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);

                    if ($data) {
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    }
                break;
            case "PUT":
                    curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return json_decode($result,true);
    }

}