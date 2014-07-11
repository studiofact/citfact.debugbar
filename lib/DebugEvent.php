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

use Bitrix\Main\Loader;

class DebugEvent
{
    /**
     * @return void
     */
    public static function includeModule()
    {
        Loader::includeModule('citfact.debugbar');
    }

    /**
     * @return void
     */
    public static function renderAssets()
    {
        $debugBar = Debug::getInstance();
        $workPath = getcwd();

        list($cssAssets, $jsAssets) = $debugBar->getDebugBar()
            ->getJavascriptRenderer()
            ->getAssets();

        // Sets the CSS style for the page
        foreach ($cssAssets as $cssAsset) {
            $GLOBALS['APPLICATION']->SetAdditionalCSS(substr($cssAsset, strlen($workPath)));
        }

        // Sets the js file for the page
        foreach ($jsAssets as $jsAsset) {
            $GLOBALS['APPLICATION']->AddHeadScript(substr($jsAsset, strlen($workPath)));
        }
    }

    /**
     * @param string $buffer
     * @return string
     */
    public static function render(&$buffer)
    {
        $debugBar = Debug::getInstance();

        ob_start();
        echo $debugBar->getDebugBar()->getJavascriptRenderer()->render();
        $bufferDebugBar = ob_get_contents();
        ob_clean();

        $buffer = preg_replace('#(<\/body[^>]*>)#', $bufferDebugBar.'$1', $buffer);

        return $buffer;
    }
}