<?php

use Bitrix\Main\ModuleManager;

class alkor_users extends CModule
{
    public function __construct()
    {
        include __DIR__ . '/../version.php';

        $this->MODULE_ID = 'alkor.users';
        $this->MODULE_NAME = 'Компонент списка пользователей';
        $this->MODULE_DESCRIPTION = 'Комплексный компонент пользователей';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
    }

    public function DoInstall(){
        CopyDirFiles(
            __DIR__ . '/components',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components',
            true,
            true
        );
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function DoUninstall(){
        DeleteDirFilesEx('/local/components/alkor/users');
        DeleteDirFilesEx('/local/components/alkor/users.list');
        DeleteDirFilesEx('/local/components/alkor/users.detail');
        ModuleManager::unRegisterModule('alkor.users');
    }
}