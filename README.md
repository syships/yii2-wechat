This is a personal plugin for study.
It is strongly recomended thant you not use it. 
This plugin is unstable.
It is the wechat plugin for yii2
======================

Installation
------------

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist syships/yii2-wechat "*"
```

or add

```
"syships/yii2-wechat": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Before using the extension,you can add the _ide_helper.php under your application folder.

Once the extension is installed, simply use it in your code by  :

config：

    'components' => [
        'wechat' => [
            'class' => 'syships\wechat\application',
            'app_id' => 'wxe138031c9ec0a441',//appid
            'secret' => '3becb42c9c13a9db50c066e633ffd872',//secret
        ],
    ],

access_token：

Yii::$app->wechat->getAccessToken();

Yii::$app->wechat->getStableAccessToken();
