<?php 
	/**
	* 中学库的增删改查
	*/
	class MiddleSchoolController
	{
		/**
		 * 显示中学信息页面
		 * @param  [type] $f3 [description]
		 * @return [type]     [description]
		 */
		function showMiddleSchool($f3)
		{
			$db = $f3->get('DB');
    		$province = new DB\SQL\Mapper($db,'province');
    		$proname = $province->select('*');
    		$f3->set('proname',$proname);
			echo Template::instance()->render('showMiddleSchool.html');

			//分頁
			



							// 
				// 			$middleschool = new DB\SQL\Mapper($db,'middleschool');
				//     		$proid = 13;
				//     		$result = $middleschool->find(array('provinceId=?',$proid));
				//     		$num = $middleschool->count(array('provinceId=?',$proid));
				//     		for($i=0;$i<$num;$i++) {
				// 			    			$city = new DB\SQL\Mapper($db,'city');
				//     			$cityname = $city->select('name',array('code=?',$result[$i]['cityCode']));
				// echo $cityname[0]['name'];
				// var_dump($cityname);
    			// echo $result[$i]['cityCode'];
    			// echo "<br>";

			    			// $proname = $province->select('name',array('id=?',13));
			    			// echo $proname[0]['name'];
				// 				$db = $f3->get('DB');

		  		//   		$middleschool = new DB\SQL\Mapper($db,'middleschool');

				// $result = $middleschool->find(array('provinceId=?',11));
				// $result[83]['proname'] = "ddfd";
				// // foreach ($result as $res1) {
				// 	// foreach ($res1 as $res2) {
				// 			var_dump($result[83]['proname']);
				// 	// }
				// // }
				// 
		}

		/**
		 * Ajax数据回调
		 * @param  [type] $f3 [description]
		 * @return [type]     [description]
		 */
		function getMiddleSchool($f3){
			$db = $f3->get('DB');
    		$middleschool = new DB\SQL\Mapper($db,'middleschool');
    		$proid = $_POST['province'];
    		$result = $middleschool->find(array('provinceId=?',$proid),array('limit'=>"10"));
    		// $num = $middleschool->count(array('provinceId=?',$proid));
    		for($i=1;$i<10;$i++) {
    			$betterschool = new DB\SQL\Mapper($db,'bettermiddleschool');
    			//中学性质
    			$property = $betterschool->find(array('middleSchoolCode=?',$result[$i]['code']),array('limit'=>"10"));
    			if(!$property){
    				$result[10+$i]['property'] = "普通高中"; 
    			}else{
    				$result[10+$i]['property'] = "示范高中"; 
    			}

    			//所在省份
    			$province = new DB\SQL\Mapper($db,'province');
    			$proname = $province->select('name',array('id=?',$proid),array('limit'=>"10"));
    			$result[10+$i]['proname'] = $proname[0]['name'];

    			//所在城市
    			$city = new DB\SQL\Mapper($db,'city');
    			$cityname = $city->select('name',array('code=?',$result[$i]['cityCode']),array('limit'=>"10"));
    			$result[10+$i]['cityname'] = $cityname[0]['name'];
    		}

    		$data = "";
    		for($i=1;$i<10;$i++) {
    			$str =  "<tr><td>".$result[10+$i]['proname']."</td><td>"
    					.$result[10+$i]['cityname']."</td><td>"
    					.$result[10+$i]['property']."</td><td>"
    					.$result[$i]['code']."</td><td>"
    					.$result[$i]['name']."</td><td>"
    					.$result[$i]['zipCode']."</td><td>"
    					.$result[$i]['address']."</td><td>详情</td></tr>";

    			$data = $data.$str;
    		}
    	
    		echo $data;
		}

	}

 ?>