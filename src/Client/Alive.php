<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

namespace ServiceProvider\Sentinel\Client;


use FastD\Packet\Json;
use FastD\Swoole\Client;
use swoole_client;
use ServiceProvider\Sentinel\ServerStatus;

/**
 * Class Alive
 * @package ServiceProvider\Sentinel
 */
class Alive extends Client
{
    /**
     * @var array
     */
    protected $config = [];

    protected $data_packet = [];

    /**
     * Alive constructor.
     * @param array $config
     */
    public function __construct(array $config, $async = true, $keep_alive = false)
    {
        parent::__construct($config['host'], $async, $keep_alive);
    }

    protected function timeAfter()
    {

    }

    public function onConnect(swoole_client $client)
    {
        $packet = Json::encode([
            'method' => 'POST',
            'path' => '/v1/services',
            'args' => ServerStatus::make()->getArrayCopy()
        ]);

        $client->send($packet);
    }

    public function onReceive(swoole_client $client, $data)
    {
        $data = Json::decode($data);
        $data = json_encode($data, JSON_PRETTY_PRINT);
        echo "接收信息: ".$data.PHP_EOL;
    }

    public function onError(swoole_client $client)
    {
        echo '连接失败'.PHP_EOL;
        //服务注册失败稍后再试
        $this->timeAfter();
    }

    public function onClose(swoole_client $client)
    {
        echo '连接断开'.PHP_EOL;
        //服务注册断开稍后再试
        $this->timeAfter();
    }
}