<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class UsersComponent extends CBitrixComponent
{
    // выполняет основной код компонента, аналог конструктора (метод подключается автоматически)
    public function executeComponent()
    {
        $componentPage = $this->sefMode();
 
        $this->IncludeComponentTemplate($componentPage);
    }
    // метод обработки режима ЧПУ
    protected function sefMode()
    {
        /**
         * Значение масок для шаблонов по умолчанию. - маски без корневого раздела,
         * который указывается в $arParams["SEF_FOLDER_URL"]
         */
        $urlTemplates = [
            "detail" => "#ID#/",
            "list" => "/",
        ];
 
        // Переменные, которые можем получить из URL
        $componentVariables = ['ID'];
        $variables = [];
 
        $engine = new CComponentEngine($this);

        $this->arComponentVariables = ['ID'];

        // Определяем страницу компонента
        $componentPage = $engine->guessComponentPath(
            $this->arParams['SEF_FOLDER_URL'],
            $urlTemplates,
            $variables,
        );

        // Если ничего не совпало — это список
        if (!$componentPage) {
            $componentPage = 'list';
        }

        // Инициализация переменных
        \CComponentEngine::initComponentVariables(
            $componentPage,
            $componentVariables,
            [],
            $variables
        );

        $this->arResult = [
            'PAGE'      => $componentPage,
            'VARIABLES' => $variables,
        ];

        return $componentPage;
    }
}