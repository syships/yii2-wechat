# yii2-wechat
配置：

    'components' => [
        'wechat' => [
            'class' => 'wechat\Wechat',
            'app_id' => 'wxe138031c9ec0a441',//appid
            'secret' => '3becb42c9c13a9db50c066e633ffd872',//secret
        ],
    ],

获取access_token：

Yii::$app->wechat->getAccessToken();

Yii::$app->wechat->getStableAccessToken();
