<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

namespace ServiceProvider\Sentinel\Process;


use FastD\Process\AbstractProcess;
use RuntimeException;
use ServiceProvider\Sentinel\Client\Alive;
use swoole_process;

/**
 * Class SentinelProcess
 * @package ServiceProvider\Sentinel\Process
 */
class SentinelProcess extends AbstractProcess
{
    /**
     * @param swoole_process $swoole_process
     * @return callable|void
     */
    public function handle(swoole_process $swoole_process)
    {
        if (!config()->has('registry')){
            throw new RuntimeException(sprintf('register address url cannot be setting.'));
        }

        $client = new Alive(config()->get('registry'));

        $client->start();
    }
}