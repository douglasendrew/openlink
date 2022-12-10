<?php

namespace SimpleWork\Framework\Page;

use SimpleWork\Framework\Page\Site;

class Request
{

    public function POST(
        $route,
        array
        $param_post,
        $headers = null,
        $timeout = 60,
        $has_on_framework = true,
        $has_json = false
    ) {

        if ($has_json) {
            $param_post = json_encode($param_post, true);
        }

        if ($has_on_framework) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => Site::getSiteUrl() . $route,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_TIMEOUT => $timeout,
                CURLOPT_POSTFIELDS => $param_post,
                CURLOPT_HTTPHEADER => $headers
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        } else {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $route,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_TIMEOUT => $timeout,
                CURLOPT_POSTFIELDS => $param_post,
                CURLOPT_HTTPHEADER => $headers
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        }
    }


    public function GET(
        $route,
        array
        $param_post,
        $headers = null,
        $timeout = 60,
        $has_on_framework = true,
        $has_json = false
    ) {

        if ($has_json) {
            $param_post = json_encode($param_post, true);
        }

        if ($has_on_framework) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => Site::getSiteUrl() . $route,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_TIMEOUT => $timeout,
                CURLOPT_POSTFIELDS => $param_post,
                CURLOPT_HTTPHEADER => $headers
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        } else {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $route,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_TIMEOUT => $timeout,
                CURLOPT_POSTFIELDS => $param_post,
                CURLOPT_HTTPHEADER => $headers
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        }
    }
}
