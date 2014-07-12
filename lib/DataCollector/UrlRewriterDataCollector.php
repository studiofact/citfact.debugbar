<?php

/*
 * This file is part of the Studio Fact package.
 *
 * (c) Kulichkin Denis (onEXHovia) <onexhovia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Citfact\DebugBar\DataCollector;

use Bitrix\Main\UrlRewriter;
use DebugBar\DataCollector\Renderable;
use DebugBar\DataCollector\DataCollector as BaseDataCollector;

class UrlRewriterDataCollector extends BaseDataCollector implements Renderable
{
    public function collect()
    {
        $urlRewriterRules = UrlRewriter::getList(SITE_ID);
        foreach ($urlRewriterRules as $key => $rule) {
            $urlRewriterRules[$key] = $this->getDataFormatter()->formatVar($rule);
        }

        return $urlRewriterRules;
    }

    public function getName()
    {
        return 'urlrewriter';
    }

    public function getWidgets()
    {
        return array(
            "urlrewriter" => array(
                "icon" => "tags",
                "widget" => "PhpDebugBar.Widgets.VariableListWidget",
                "map" => "urlrewriter",
                "default" => "{}"
            )
        );
    }
}
