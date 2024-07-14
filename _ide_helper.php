<?php

use wechat\Wechat;

class Yii
{
    /**
     * @var MyApplication
     */
    public static $app;
}

/**
 * @property-read Wechat $wechat The wechat component.
 */
class MyApplication extends \yii\web\Application
{

}

