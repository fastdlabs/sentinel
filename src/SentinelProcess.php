<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

namespace ServiceProvider\Sentinel;


use FastD\Process\AbstractProcess;
use swoole_process;

class SentinelProcess extends AbstractProcess
{
    public function handle(swoole_process $swoole_process)
    {
        $this->register();
    }

    protected function timeAfter()
    {
        timer_after(config()->get('server.registry.retry_interval'), function () {
            $this->register();
        });
    }

    protected function register()
    {
        $client = new Alive(config()->get('server.registry.host'),SWOOLE_SOCK_TCP);

        $client->on("connect", function($client) {
            $client->send(json_encode((new RegistryConfig())->get()));
        });

        $client->on("receive", function($cli, $data){
            echo "接收信息: ".$data.PHP_EOL;
        });

        $client->on("error", function($client){
            echo '连接失败'.PHP_EOL;
            //服务注册失败稍后再试
            $this->timeAfter();
        });

        $client->on("close", function($client){
            echo '连接断开'.PHP_EOL;
            //服务注册断开稍后再试
            $this->timeAfter();
        });

        $client->start();
    }
}