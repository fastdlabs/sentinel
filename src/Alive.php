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

class Alive extends Client
{
    public function __construct($uri = null, $async = false, $keep = false)
    {
        parent::__construct($uri, $async, $keep);
    }
}