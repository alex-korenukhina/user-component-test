<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());

if (isset($arResult['ERROR'])) {
    echo "<p>{$arResult['ERROR']}</p>";
} else {
?>
    <h2><?=implode(' ', [$arResult['NAME'], $arResult['SECOND_NAME'], $arResult['LAST_NAME']])?></h2>
    <div class="info">
        <p><span>ID пользователя:</span><?=$arResult['ID']?></p>
        <p><span>Номер телефона:</span><?=$arResult['PERSONAL_PHONE']?></p>
        <p><span>Электронная почта:</span><?=$arResult['EMAIL']?></p>
    </div>
    <div class="groups">
        <p><span>Группы пользователя:</span></p>
        <?
        foreach ($arResult['GROUPS'] as $group) {
            echo "<p>{$group}</p>";
        }
        ?>
    </div>
<?
}
?>

<a href="<?=str_replace($arResult['ID'].'/', '', $uri->getPath())?>">К списку пользователей</a>