<?php

/*
 * This file is part of the Studio Fact package.
 *
 * (c) Kulichkin Denis (onEXHovia) <onexhovia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bitrix\Main\Loader;

require_once __DIR__.'/lib/DebugFunctions.php';

if (file_exists(getenv('DOCUMENT_ROOT').'/vendor/autoload.php')) {
    require_once getenv('DOCUMENT_ROOT').'/vendor/autoload.php';
}

Loader::registerAutoLoadClasses('citfact.debugbar', array(
    'Citfact\DebugBar\Debug' => 'lib/Debug.php',
    'Citfact\DebugBar\DebugEvent' => 'lib/DebugEvent.php',
));
