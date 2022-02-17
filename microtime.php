<?php

class Time{
	public function getTime($string){
        $iconPngUrl = 'icon.png';
		if(empty($string)){
		    $title = $this->getMsecTime();
		    $sub_title = $this->getMsecToMescdate($title);
		    $outputs = [
				'items' => [
					[
						'arg' => $title, 
                		'title' => $title, 
						'subtitle' => 'Timestamp - 时间戳毫秒', 
						'icon' => [
							'path' => $iconPngUrl
						], 
						'valid' => true,
					],
					[
						'arg' => $sub_title,
						'title' => $sub_title, 
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
        $query = str_replace(array('年', '月', '日', '时', '分', '秒','毫秒'), array('-', '-', ' ', ':', ':', ':','.'), $string);
		$query = trim($query);

		// 非时间格式
		if(in_array($query, array('n', 'now'))) {
			$query = $this->getMsecTime();
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
        $query = preg_match('/^\d{13}$/', $query) ? $query : $this->getDateToMesc($query);
		$date = $this->getMsecToMescdate($query);
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

	/**
     * 获取毫秒级别的时间戳
     */
    public function getMsecTime()
    {
        list($msec, $sec) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }
 
    /**
     * 毫秒转日期
     */
    public function getMsecToMescdate($msectime)
    {
        $msectime = $msectime * 0.001;
        if(strstr($msectime,'.')){
            list($usec, $sec) = explode(".",$msectime);
            $sec = str_pad($sec,3,"0",STR_PAD_RIGHT);
        }else{
            $usec = $msectime;
            $sec = "000";
        }
        $date = date("Y-m-d H:i:s.x",$usec);
        return str_replace('x', $sec, $date);
    }
 
    /**
     * 日期转毫秒
     */
    public function getDateToMesc($mescdate)
    {
        list($usec, $sec) = explode(".", $mescdate);
        $date = strtotime($usec);
        return str_pad($date.$sec,13,"0",STR_PAD_RIGHT);
    }
}






