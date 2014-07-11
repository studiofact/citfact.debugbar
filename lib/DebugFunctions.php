<?php

/*
 * This file is part of the Studio Fact package.
 *
 * (c) Kulichkin Denis (onEXHovia) <onexhovia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @param string $message
 * @param string $type
 */
function debugbar_log($message, $type = 'debug')
{
    \Citfact\DebugBar\Debug::getInstance()->log($message, $type);
}