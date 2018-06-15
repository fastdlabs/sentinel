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
        //没有配置跳过
        if (!config()->get('registry')){
            return false;
        }
        $client = new Alive(config()->get('registry.host'));

        $client->register();
    }
}