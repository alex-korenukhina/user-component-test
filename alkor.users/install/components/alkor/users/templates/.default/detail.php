<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponent $component */

$APPLICATION->IncludeComponent(
'alkor:users.detail',
'.default',
array(
        "CACHE_TIME" => $arParams['CACHE_TIME'],
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],
		"PAGE_TITLE" => $arParams['PAGE_TITLE'],
		"USER_ID" => $arResult['VARIABLES']['ID']
),
$component,
array('HIDE_ICONS' => 'Y')
);