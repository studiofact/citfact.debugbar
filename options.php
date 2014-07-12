<?php

/*
 * This file is part of the Studio Fact package.
 *
 * (c) Kulichkin Denis (onEXHovia) <onexhovia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\Config;

Loc::loadMessages(__FILE__);

$app = Application::getInstance();
$request = $app->getContext()->getRequest();
$moduleId = 'citfact.debugbar';

$allOptions = array(
    array('ACTIVE', Loc::getMessage('DEBUGBAR_ACTIVE'), 'Y', array('checkbox', 'Y')),
    array('GRANTED', Loc::getMessage('DEBUGBAR_GRANTED'), 'Y', array('checkbox', 'Y')),
);

$controlTabs = array(array(
    'DIV' => 'tab-settings',
    'TAB' => Loc::getMessage('DEBUGBAR_TAB'),
    'TITLE' => Loc::getMessage('DEBUGBAR_TAB_TITLE'),
));

if ($request->isPost() && $request->getPost('RESTORE_DEFAULTS')) {
    Config\Option::delete($moduleId);
}

if ($request->isPost() && $request->getPost('UPDATE')) {
    foreach ($allOptions as $option) {
        $value = $request->getPost($option[0]);
        $value = ($option[3][0] == 'checkbox' && $value != 'Y') ? 'N' : $value;
        Config\Option::set($moduleId, $option[0], $value);
    }
}

$tabControl = new CAdminTabControl('control', $controlTabs);
$tabControl->Begin();
?>
<form method="post" action="<?= $GLOBALS['APPLICATION']->GetCurPage() ?>">
    <input type="hidden" name="mid" value="<?= $moduleId ?>">
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
    <? $tabControl->BeginNextTab(); ?>
    <? foreach ($allOptions as $option): ?>
        <?
        $value = Config\Option::get($moduleId, $option[0], $option[2]);
        $type = $option[3];
        ?>
        <tr>
            <td width="40%" nowrap <?= ($type[0] == 'textarea') ? 'class="adm-detail-valign-top"' : '' ?>>
                <label for="<?= htmlspecialcharsbx($option[0]) ?>"><?= $option[1] ?>:</label>
            <td width="60%">
                <? if ($type[0] == 'checkbox'): ?>
                    <input type="checkbox" id="<?= htmlspecialcharsbx($option[0]) ?>"
                           name="<?= htmlspecialcharsbx($option[0]) ?>"
                           value="Y" <?= ($value == 'Y') ? 'checked' : '' ?>>
                <? elseif ($type[0] == 'text'): ?>
                    <input type="text" size="<?= $type[1] ?>" maxlength="255"
                           value="<?= htmlspecialcharsbx($value) ?>"
                           name="<?= htmlspecialcharsbx($option[0]) ?>">
                <?
                elseif ($type[0] == 'textarea'): ?>
                    <textarea rows="<?= $type[1] ?>" cols="<?= $type[2] ?>"
                              name="<? echo htmlspecialcharsbx($option[0]) ?>"><?= htmlspecialcharsbx($value) ?></textarea>
                <?endif ?>
            </td>
        </tr>
    <? endforeach; ?>
    <? $tabControl->Buttons(); ?>
    <input type="submit" name="UPDATE" class="adm-btn-save" value="<?= Loc::getMessage('BTN_SAVE') ?>">
    <input type="submit" name="RESTORE_DEFAULTS" value="<?= Loc::getMessage("BTN_RESTORE") ?>">
    <? $tabControl->End(); ?>
</form>