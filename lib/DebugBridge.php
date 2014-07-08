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

class DebugBridge
{
    protected static $debugBar;

    public function __construct()
    {
        self::$debugBar = new BaseDebugBar();
    }

    public static function renderAssets()
    {
        list($cssAssets, $jsAssets) = self::$debugBar->getJavascriptRenderer()->getAssets();
        $workPath = getcwd();

        // Sets the CSS style for the page
        foreach ($cssAssets as $cssAsset) {
            $GLOBALS['APPLICATION']->setAdditionalCSS(substr($cssAsset, strlen($workPath)));
        }

        // Sets the js file for the page
        foreach ($jsAssets as $jsAssets) {
            $GLOBALS['APPLICATION']->addHeadScript(substr($jsAssets, strlen($workPath)));
        }
    }

    public static function render($buffer)
    {
        ob_start();
        echo self::$debugBar->getJavascriptRenderer()->render();
        $bufferDebugBar = ob_get_contents();
        ob_clean();

        return preg_replace('/(<\/body[^>]>)/', $bufferDebugBar.'$1', $buffer);
    }
}