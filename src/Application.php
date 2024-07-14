<?php
namespace syships\wechat;

use yii\base\Component;
use yii\base\InvalidConfigException;
use Yii;

/**
 * Application is the base class for all web application classes.
 *
 * For more details and usage information on Application, see the [guide article on applications](guide:structure-applications).
 *
 *
 * @since 2.0
 */
class Application extends Component
{
    public $base_url = "https://api.weixin.qq.com/";

    public $app_id;

    public $secret;

    private $_access_token = false;

    public static $httpStatuses = [
        -1 => 'system error',
        0 => 'ok',
        40001 => 'ok',
        40002 => 'invalid grant_type',
        40013 => 'invalid appid',
        40125 => 'invalid appsecret',
        40164 => 'invalid ip  not in whitelist',
        40243 => 'AppSecret已被冻结，请登录小程序平台解冻后再次调用。',
        41002 => 'appid missing',
        41004 => 'require POST method',
        45009 => 'reach max api daily quota limit',
        45011 => 'api minute-quota reach limit  mustslower  retry next minute	API',
        50004 => '禁止使用 token 接口',
        50007 => '账号已冻结',
        61024 => '第三方平台 API 需要使用第三方平台专用 token',
        89503 => '此次调用需要管理员确认，请耐心等候',
        89506 => '该IP调用求请求已被公众号管理员拒绝，请24小时后再试，建议调用前与管理员沟通确认',
        89507 => '该IP调用求请求已被公众号管理员拒绝，请1小时后再试，建议调用前与管理员沟通确认',
    ];

    public function init()
    {
        parent::init();

        if ($this->app_id === null) {
            throw new InvalidConfigException('Wechat::app_id must be set.');
        }
        if ($this->secret === null) {
            throw new InvalidConfigException('Wechat::secret must be set.');
        }

    }

    /**
     * @return null|mixed
     * @throws \yii\httpclient\Exception
     * https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET
     */
    public function getAccessToken(){
        if ($this->_access_token === false) {
            if (true) {
                try {
                    $this->_access_token = null;
                    $this->token();
                } catch (\Exception $e) {
                    $this->_access_token = false;
                    throw $e;
                } catch (\Throwable $e) {
                    $this->_access_token = false;
                    throw $e;
                }
            } else {
                return null;
            }
        }

        return $this->_access_token;
    }

    /**
     * @return void
     * @throws \yii\httpclient\Exception
     */
    private function token()
    {
        $params = [
            'grant_type' => 'client_credential',
            'appid' => $this->app_id,
            'secret' => $this->secret,
        ];
        $httpClient = WechatHttpclient::send($this->base_url."cgi-bin/token",$params);

        $this->_access_token = $httpClient->getData();
    }

    /**
     * @return null|mixed
     * @throws \yii\httpclient\Exception
     * https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET
     */
    public function getStableAccessToken($forceRefresh=false){
        if ($this->_access_token === false) {
            if (true) {
                try {
                    $this->_access_token = null;
                    $this->stableAccessToken($forceRefresh);
                } catch (\Exception $e) {
                    $this->_access_token = false;
                    throw $e;
                } catch (\Throwable $e) {
                    $this->_access_token = false;
                    throw $e;
                }
            } else {
                return null;
            }
        }

        return $this->_access_token;
    }

    /**
     * @return void
     * @throws \yii\httpclient\Exception
     */
    private function stableAccessToken($forceRefresh=false)
    {
        $params = [
            "grant_type" => 'client_credential',
            "appid" => $this->app_id,
            "secret" => $this->secret,
            "force_refresh" => $forceRefresh,
        ];

        $httpClient = WechatHttpclient::send($this->base_url."cgi-bin/stable_token",$params,'post');


        $this->_access_token = $httpClient->getData();
    }
}