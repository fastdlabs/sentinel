<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

namespace FastD\Sentinel;


use FastD\Packet\Json;
use FastD\Swoole\Client;
use FastD\Utils\FileObject;
use swoole_client;

/**
 * Class Subscription
 * @package FastD\Sentinel
 */
class Subscription extends Client
{
    public function __construct()
    {
        parent::__construct(config()->get('registry')['host'], true);
    }

    /**
     * @param swoole_client $client
     * @param string $data
     * @return mixed|void
     * @throws \FastD\Packet\Exceptions\PacketException
     */
    public function onReceive(swoole_client $client, $data)
    {
        $data = Json::decode($data);
        $nodes = json_encode($data['list'], JSON_PRETTY_PRINT);
        $file = new FileObject('/tmp/services/'.$data['service'].'.json', 'rw+');
        $file->fwrite($nodes);
        echo "接收信息: ".$nodes.PHP_EOL;
    }
}