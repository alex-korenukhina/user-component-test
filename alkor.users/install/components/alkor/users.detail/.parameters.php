<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    // основной массив с параметрами
    "PARAMETERS" => [
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
		"SEF_FOLDER_URL" => array(
			"NAME" => GetMessage("AKU_SEF_FOLDER_URL"), 
			"TYPE" => 'STRING',
			"DEFAULT" => '/user_lists/',
        ),
		"USER_ID" => array(
			"NAME" => GetMessage("AKU_USER_ID"), 
			"TYPE" => "STRING",
		),
    ]
];