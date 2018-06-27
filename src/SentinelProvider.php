<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

namespace ServiceProvider\Sentinel;


use FastD\Container\Container;
use FastD\Container\ServiceProviderInterface;
use ServiceProvider\Sentinel\Console\SentinelCommand;

/**
 * Class Sentinel
 * @package ServiceProvider\Sentinel
 */
class SentinelProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     * @return mixed
     */
    public function register(Container $container)
    {
        config()->merge([
            'consoles' => [
                SentinelCommand::class,
            ],
        ]);
    }
}