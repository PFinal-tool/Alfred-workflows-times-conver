<?php

class Time{
	public function getTime($string){
		$iconPngUrl = 'icon.png';
		if(empty($string)){
			$query = time();
			$date = date('Y-m-d', $query);
			$time = date('Y-m-d H:i:s', $query);
			$outputs = [
				'items' => [
					[
						'arg' => $query, 
                		'title' => $query, 
						'subtitle' => 'Timestamp - 时间戳', 
						'icon' => [
							'path' => $iconPngUrl
						], 
						'valid' => true,
					], 
					[
						'arg' => $date, 
						'title' => $date, 
						'subtitle' => 'Date - 日期', 
						'icon' => [
							'path' => $iconPngUrl
						], 
						'valid' => true,
					], 
					[
						'arg' => $time, 
						'title' => $time, 
						'subtitle' => 'Date/time - 日期时间', 
						'icon' => [
							'path' => $iconPngUrl
						], 
						'valid' => true,
					]
				]
			];
			echo json_encode($outputs);
    		exit;
		}
		$query = str_replace(array('年', '月', '日', '时', '分', '秒'), array('-', '-', ' ', ':', ':', ':'), $string);
		$query = trim($query);

		// 非时间格式
		if(in_array($query, array('n', 'now'))) {
			$query = time();
		}
		if(!strtotime($query) && strlen(intval($query)) != 10) {
			$outputs = [
				'items' => [
					[
						'uid' => '时间格式输入有误', 
						'arg' => '', 
						'title' => '请输入时间戳或日期格式', 
						'subtitle' => '日期/时间字符串 - Power by PHP strtotime Date/Time 函数.', 
						'icon' => [
							'path' => $iconPngUrl
						], 
						'valid' => false
					]
				]
			];

			echo json_encode($outputs);
			exit;
		}

		$query = preg_match('/^\d{10}$/', $query) ? $query : strtotime($query);
		$date = date('Y-m-d', $query);
		$time = date('Y-m-d H:i:s', $query);

		$outputs = [
			'items' => [
				[
					'arg' => $query, 
					'title' => $query, 
					'subtitle' => 'Timestamp - 时间戳', 
					'icon' => [
						'path' => $iconPngUrl
					], 
					'valid' => true,
				], 
				[
					'arg' => $date, 
					'title' => $date, 
					'subtitle' => 'Date - 日期', 
					'icon' => [
						'path' => $iconPngUrl
					], 
					'valid' => true,
				], 
				[
					'arg' => $time, 
					'title' => $time, 
					'subtitle' => 'Date/time - 日期时间', 
					'icon' => [
						'path' => $iconPngUrl
					], 
					'valid' => true,
				]
			]
		];
		echo json_encode($outputs);
		exit;
	}
}






