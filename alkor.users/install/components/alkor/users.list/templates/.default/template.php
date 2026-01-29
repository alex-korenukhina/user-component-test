<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Type\DateTime;

if (count($arResult) > 0) {
?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Дата регистрации</th>
            <th>Email</th>
            <th>ФИО</th>
            <th>Группы</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?
        foreach ($arResult as $user) {
            $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
            $uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());
            ?>
            <tr>
                <td><?=$user['ID']?></td>
                <td><?=$user['DATE_REGISTER']->format('d.m.Y')?></td>
                <td><?=$user['EMAIL']?></td>
                <td><?=implode(' ', [$user['NAME'], $user['SECOND_NAME'], $user['LAST_NAME']])?></td>
                <td><?=implode('<br>', $user['GROUPS'])?></td>
                <td><a href="<?=$uri->getPath().$user['ID']?>/">профиль</a></td>
            </tr>
            <?
        }
    ?>
    </tbody>
</table>
<?
}