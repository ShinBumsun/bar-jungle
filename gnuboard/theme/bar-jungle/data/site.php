<?php
/**
 * BAR JUNGLE 기본 정보
 * 주소·영업시간·SNS 주소는 여기만 고치면 전체에 반영됩니다.
 * 영어·일본어 문구는 js/i18n.js 에서 관리합니다.
 */
if (!defined('_GNUBOARD_')) exit;

return array(
	'name'       => 'BAR JUNGLE',
	'name_ko'    => '바 정글',
	'instagram'  => 'https://www.instagram.com/jungle_seoul/',
	'insta_id'   => '@jungle_seoul',
	'addr_ko'    => '서울시 종로구 삼일대로 30길 46 2층 정글',
	'addr_en'    => '2nd floor, 46 Samil-daero 30-gil, Jongno-gu, Seoul',
	'map_query'  => '서울시 종로구 삼일대로 30길 46 2층 정글',
	'hours'      => array(
		array('label' => '월 – 목', 'i18n' => 'visit.hours1', 'time' => '19:00 – 03:00'),
		array('label' => '금 – 토', 'i18n' => 'visit.hours2', 'time' => '19:00 – 04:00'),
		array('label' => '일',      'i18n' => 'visit.hours3', 'time' => '20:00 – 03:00'),
	),
);
