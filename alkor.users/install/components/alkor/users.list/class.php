<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\UserTable;
use Bitrix\Main\UserGroupTable;
use \Bitrix\Main\GroupTable;

class UsersListComponent extends CBitrixComponent
{
    // выполняет основной код компонента, аналог конструктора (метод подключается автоматически)
    public function executeComponent()
    {
        // начало кеширования, если кеш уже существует - startResultCache() возвращает false, заполняет $arResult, выводит верстку
        if ($this->startResultCache($this->arParams['CACHE_TIME'])) {
            // Получаем все возможные группы пользователей, чтобы не искать их для каждого пользователя в цикле
            $userGroups = [];
            $result = GroupTable::getList(array(
                'select'  => array('NAME','ID'), 
            ));
            while ($arGroup = $result->fetch()) {
                $userGroups[$arGroup['ID']] = $arGroup;
            }
            $users = UserTable::getList([
                'select' => ['ID', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'EMAIL', 'DATE_REGISTER'], // Поля, которые необходимо получить
            ])->fetchAll();

            foreach ($users as $user) {
                $this->arResult[$user['ID']] = $user;
                $groups = UserGroupTable::getList([
                    'filter' => ['USER_ID' => $user['ID']],
                ])->fetchAll();
                if ($groups) {
                    foreach ($groups as $group) {
                        $this->arResult[$user['ID']]['GROUPS'][] = $userGroups[$group['GROUP_ID']]['NAME'];
                    }
                }
            }
            // подключаем темплейт
            $this->IncludeComponentTemplate();
        }
        if (!empty($this->arParams['PAGE_TITLE'])) {
            global $APPLICATION;
            $APPLICATION->SetTitle($this->arParams['PAGE_TITLE']);
        }
    }
}