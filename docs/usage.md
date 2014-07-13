Пример использования
=========

Для добавления отладочной информации
-----------------------------

Через функцию:

``` php
debugbar_log($arResult, 'debug');
```

Через статичный метод:

``` php
\Citfact\DebugBar\Debug::getInstance()->log($arResult, 'info');
```

Как получить DebugBar объект?
-----------------------------

``` php
$debugbar = \Citfact\DebugBar\Debug::getInstance()->getDebugBar();
```

