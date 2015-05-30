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
            $f3->set('template','showMiddleSchool.html');
			echo Template::instance()->render('layout.htm');


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

    		// $flag = $_POST['flag'];
    		$result = $middleschool->find(array('provinceId=?',$proid));

    		$itemsPerPage = 10;
    		$total = count($result);
    		$pages = ceil($total/$itemsPerPage);

    		for($i=1;$i<$total;$i++) {
    			$betterschool = new DB\SQL\Mapper($db,'bettermiddleschool');
    			//中学性质
    			$property = $betterschool->find(array('middleSchoolCode=?',$result[$i]['code']),array('limit'=>"10"));
    			if(!$property){
    				$result[$total+$i]['property'] = "普通高中"; 
    			}else{
    				$result[$total+$i]['property'] = "示范高中"; 
    			}

    			//所在省份
    			$province = new DB\SQL\Mapper($db,'province');
    			$proname = $province->select('name',array('id=?',$proid),array('limit'=>"10"));
    			$result[$total+$i]['proname'] = $proname[0]['name'];

    			//所在城市
    			$city = new DB\SQL\Mapper($db,'city');
    			$cityname = $city->select('name',array('code=?',$result[$i]['cityCode']),array('limit'=>"10"));
    			$result[$total+$i]['cityname'] = $cityname[0]['name'];
    		}

    		$data[0] = "";
    		for($i=1;$i<$itemsPerPage;$i++) {
    			$str =  "<tr><td>".$result[$total+$i]['proname']."</td><td>"
    					.$result[$total+$i]['cityname']."</td><td>"
    					.$result[$total+$i]['property']."</td><td>"
    					.$result[$i]['code']."</td><td>"
    					.$result[$i]['name']."</td><td>"
    					.$result[$i]['zipCode']."</td><td>"
    					.$result[$i]['address']."</td><td><a href='schoolDetail?code=".$result[$i]['code']."'>详情</a></td></tr>";

    			$data[0] = $data[0].$str;
    		}
    		$data[1] = $pages;
    		$data[2] = $proid;
    		echo json_encode($data);
		}

        //分页获取数据
		function getpage($f3){
    		$db = $f3->get('DB');
    		$middleschool = new DB\SQL\Mapper($db,'middleschool');
    		$proid = $_GET['province'];

    		$num = $_GET['num'];
    		$result = $middleschool->find(array('provinceId=?',$proid));

    		$itemsPerPage = 10;
    		$total = count($result);
    		$pages = ceil($total/$itemsPerPage);

    		for($i=1;$i<$total;$i++) {
    			$betterschool = new DB\SQL\Mapper($db,'bettermiddleschool');
    			//中学性质
    			$property = $betterschool->find(array('middleSchoolCode=?',$result[$i]['code']),array('limit'=>"10"));
    			if(!$property){
    				$result[$total+$i]['property'] = "普通高中"; 
    			}else{
    				$result[$total+$i]['property'] = "示范高中"; 
    			}

    			//所在省份
    			$province = new DB\SQL\Mapper($db,'province');
    			$proname = $province->select('name',array('id=?',$proid),array('limit'=>"10"));
    			$result[$total+$i]['proname'] = $proname[0]['name'];

    			//所在城市
    			$city = new DB\SQL\Mapper($db,'city');
    			$cityname = $city->select('name',array('code=?',$result[$i]['cityCode']),array('limit'=>"10"));
    			$result[$total+$i]['cityname'] = $cityname[0]['name'];
    		}

    		$data[0] = "";
  			$begin = $itemsPerPage*($num-1)+1;
  			$end = $begin+10;
  			if($end>$total){
  				$end = $total;
  			}
    		for($i=$begin;$i<$end;$i++) {
    			$str =  "<tr><td>".$result[$total+$i]['proname']."</td><td>"
    					.$result[$total+$i]['cityname']."</td><td>"
    					.$result[$total+$i]['property']."</td><td>"
    					.$result[$i]['code']."</td><td>"
    					.$result[$i]['name']."</td><td>"
    					.$result[$i]['zipCode']."</td><td>"
    					.$result[$i]['address']."</td><td><a href='schoolDetail?code=".$result[$i]['code']."'>详情</a></td></tr>";

    			$data[0] = $data[0].$str;
    		}
    		$data[1] = $num;
    		// $data[0] = $_POST['province'];

    		// $data[1] = $_POST['flag'];
    		echo json_encode($data);

		}

        //学校详情页
        function schoolDetail($f3){
            $code = $f3->get('GET.code');
            $db = $f3->get('DB');
            $middleschool = new DB\SQL\Mapper($db,'middleschool');
            $worker = new DB\SQL\Mapper($db,'middleschoolworker');
            $betterschool = new DB\SQL\Mapper($db,'bettermiddleschool');
            $province = new DB\SQL\Mapper($db,'province');
            $city = new DB\SQL\Mapper($db,'city');

            $middle = $middleschool->find(array('code=?',$code));
            $pro = $province->find(array('id=?',$middle[0]['provinceId']));
            $wor = $worker->find(array('middleSchoolCode=?',$code));
            if(!$wor){
                $wor[0]['position']="";
                $wor[0]['tel']="";
            }
            $better = $betterschool->find(array('middleSchoolCode=?',$code));
            $ci = $city->find(array('code=?',$middle[0]['cityCode']));
            if(!$better){
                $property = "普通高中";
            }else{
                $property = "重点高中";
            }
            $f3->set('middle',$middle);
            $f3->set('pro',$pro);
            $f3->set('wor',$wor);
            $f3->set('property',$property);
            $f3->set('ci',$ci); 
            echo Template::instance()->render('school-detail.html');
        }

        //编辑中学联系人信息
        function editSchool($f3){
             $code = $f3->get('GET.code');
             $f3->set('code',$code);
             $f3->set('position',$_GET['position']);
             $f3->set('tel',$_GET['tel']);
             echo Template::instance()->render('edit-detail.html');
        }

        //保存中学联系人信息
        function saveEditMiddleWor($f3){
            $code = $f3->get('POST.middlecode');
            $tel = $f3->get('POST.tel');
            $db = $f3->get('DB');
            $worker = new DB\SQL\Mapper($db,'middleschoolworker');
            $worker->load(array());
            $worker->middleSchoolCode = $code;
            $worker->tel = $tel;
            $worker->update();
            echo "修改成功";

        }

	}

 ?>