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
            // Получаем все возможные группы пользователей
            $userGroups = [];
            $result = GroupTable::getList(array(
                'select'  => array('NAME','ID'), 
            ));
            while ($arGroup = $result->fetch()) {
                $userGroups[$arGroup['ID']] = $arGroup;
            }
            $users = UserTable::getList([
                'select' => ['ID', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'EMAIL', 'PERSONAL_PHONE'], // Поля, которые необходимо получить
                'filter' => ['ID' => $this->arParams['USER_ID']]
            ])->fetchAll();

            if (count($users) === 0) {
                $this->arResult['ERROR'] = GetMessage("AKU_NO_USER");
            } else {
                foreach ($users as $user) {
                    $this->arResult = $user;
                    $groups = UserGroupTable::getList([
                        'filter' => ['USER_ID' => $user['ID']],
                    ])->fetchAll();
                    if ($groups) {
                        foreach ($groups as $group) {
                            $this->arResult['GROUPS'][] = $userGroups[$group['GROUP_ID']]['NAME'];
                        }
                    }
                }
            }

            // подключаем темплейт
            $this->IncludeComponentTemplate();
        }
    }
}