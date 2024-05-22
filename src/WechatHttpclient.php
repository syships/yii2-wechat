<?php
namespace wechat;

use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\httpclient\Response;

class WechatHttpclient
{
    /**
     * Sends this request.
     * @return Response response instance.
     * @throws Exception
     */
    public function send($url,$params=[],$method='GET',$headers=[]){
        $client = new Client([
//            'transport' => 'yii\httpclient\CurlTransport', // only cURL supports the options we need
//            'responseConfig' => [
//                'format' => Client::FORMAT_JSON
//            ],
        ]);

        if(in_array($method,['get','GET'])){
            $response = $client->createRequest()
                ->setMethod($method)
                ->setUrl($url)
                ->addData($params)
                ->setOptions([
                    CURLOPT_CONNECTTIMEOUT => 50, // connection timeout
                    CURLOPT_TIMEOUT => 100, // data receiving timeout
                    CURLOPT_SSL_VERIFYPEER => false//不安全，在php.ini里面添加证书地址
                ])
                ->addHeaders($headers)
                ->send();

            return $response;
        }
        if(in_array($method,['post','POST'])){
            $response = $client->createRequest()
                ->setMethod($method)
                ->setUrl($url)
                ->setContent(json_encode($params))
                ->setOptions([
                    CURLOPT_CONNECTTIMEOUT => 50, // connection timeout
                    CURLOPT_TIMEOUT => 100, // data receiving timeout
                    CURLOPT_SSL_VERIFYPEER => false//不安全，在php.ini里面添加证书地址
                ])
                ->addHeaders($headers)
                ->send();

            return $response;
        }


    }
}