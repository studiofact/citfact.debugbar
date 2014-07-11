<?php

/*
 * This file is part of the Studio Fact package.
 *
 * (c) Kulichkin Denis (onEXHovia) <onexhovia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Citfact\DebugBar;

use DebugBar\StandardDebugBar as BaseDebugBar;

class Debug
{
    /**
     * @var \DebugBar\StandardDebugBar
     */
    protected static $debugBar;

    /**
     * @var Debug
     */
    protected static $instance = null;

    /**
     * Construct object
     */
    public function __construct()
    {
        self::$debugBar = new BaseDebugBar();
    }

    /**
     * Returns current instance of the Debug.
     *
     * @return Debug
     */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @return BaseDebugBar
     */
    public function getDebugBar()
    {
        return self::$debugBar;
    }

    /**
     * @param string $message
     * @param string $type
     */
    public function log($message, $type = 'debug')
    {
        self::$debugBar['messages']->addMessage($message, $type);
    }
}