<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

namespace ServiceProvider\Sentinel;


use FastD\Swoole\Client;
use swoole_client;

class Alive extends Client
{
    public function __construct($uri = null, $async = true, $keep = false)
    {
        parent::__construct($uri, $async, $keep);
    }


    protected function timeAfter()
    {
        timer_after(config()->get('registry.retry_interval'), function () {
            $this->register();
        });
    }

    public function register()
    {
        $this->on("connect", function($client) {
            $client->send(json_encode((new RegistryConfig())->get()));
        });

        $this->on("receive", function($cli, $data){
            echo "接收信息: ".$data.PHP_EOL;
        });

        $this->on("error", function($client){
            echo '连接失败'.PHP_EOL;
            //服务注册失败稍后再试
            $this->timeAfter();
        });

        $this->on("close", function($client){
            echo '连接断开'.PHP_EOL;
            //服务注册断开稍后再试
            $this->timeAfter();
        });

        $this->start();
    }
}