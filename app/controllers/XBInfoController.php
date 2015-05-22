<?php
class XBInfoController{
	function getSchoolsByPro($f3)
    {
		//这里两句话很重要,第一讲话告诉浏览器返回的数据是xml格式
        header("Content-Type: text/xml;charset=utf-8");
        //告诉浏览器不要缓存数据
        header("Cache-Control: no-cache");
        $pro=$_POST['province'];
        $sql="select middleschool.name as name from middleschool
        	where provinceId=(select id from province where province.name='".$pro."')";
           file_put_contents("D:/mylog.log",$sql."\r\n",FILE_APPEND);
        $f3->set('schoolNames',$f3->get('DB')->exec($sql));
        if (count($f3->get('schoolNames'))==0) {
        	$info="<province></province>";
        }
        else{
        	 $info="<province>";
        foreach ($f3->get('schoolNames') as $key => $value) {
        	 $info=$info."<school>".$value['name']."</school>";
        	}
       
            $info=$info."</province>";
        }
       
        echo $info;
	}
     //通过学习名称获得对应喜报内容
    function getXBConBySchool($f3)
    {
       //这里两句话很重要,第一讲话告诉浏览器返回的数据是xml格式
        header("Content-Type: text/xml;charset=utf-8");
        //告诉浏览器不要缓存数据
        header("Cache-Control: no-cache");
        $sch=$_POST['school'];
        $f3->set('schoolName',$sch,3600);
        //选择近4年数据
       /* $sqlRaceResNum="SELECT DISTINCT count(student.name) as number
        FROM student ,race , raceinformation
        WHERE student.schoolId = (select middleschool.id from 
        middleschool where middleschool.name='".$sch."') AND
        student.studentNumber = raceinformation.studentNumber AND
        race.id = raceinformation.raceId 
        AND (2015-(raceinformation.date+0))<4";

         $tempRes=$f3->get('DB')->exec($sqlRaceResNum);
         foreach ( $tempRes as  $value) 
         {
             $f3->set('raceResNum',$value['number']);
         }
      

         $sqlRewardResNum="SELECT DISTINCT count(student.name) as number
       FROM student ,reward , rewardinformation WHERE student.schoolId = 
      (select middleschool.id from middleschool where middleschool.name='".$sch."') AND
      student.studentNumber = rewardinformation.studentNumber AND reward.number = rewardinformation.rewardId
        AND (2015-(rewardinformation.date+0))<4";

        $tempRes=$f3->get('DB')->exec($sqlRewardResNum);
       foreach ( $tempRes as  $value) 
       {
           $f3->set('rewardResNum',$value['number']);
       }
       //'totalResNum' 总结果条数：包含竞赛和获奖
        $f3->set('totalResNum',$f3->get('raceResNum')+$f3->get('rewardResNum'));*/
       // $f3->set('pageNum',ceil($f3->get('totalResNum')/30));
      //竞赛结果
      $sqlRace="SELECT DISTINCT student.name as stdName,race.name as rName,race.level as rLevel
       FROM student ,race , raceinformation
      WHERE student.schoolId = (select middleschool.id from 
      middleschool where middleschool.name='".$sch."') AND
      student.studentNumber = raceinformation.studentNumber AND
      race.id = raceinformation.raceId 
      AND (2015-(raceinformation.date+0))<4
      ORDER BY stdName ASC ";
        $f3->set('stdsRace',$f3->get('DB')->exec($sqlRace));
        //获奖结果
        $sqlReward="SELECT DISTINCT student.name as stdName,reward.name as rName,reward.level as rLevel
         FROM student ,reward , rewardinformation WHERE student.schoolId = 
        (select middleschool.id from middleschool where middleschool.name='".$sch."') AND
        student.studentNumber = rewardinformation.studentNumber AND reward.number = rewardinformation.rewardId
          AND (2015-(rewardinformation.date+0))<4
          ORDER BY stdName ASC";

        $f3->set('stdsReward',$f3->get('DB')->exec($sqlReward));
        
        //$resultDate为中间变量 设置$f3中resultData
        $resultData=array_merge_recursive($f3->get('stdsRace'),$f3->get('stdsReward'));
        asort($resultData);
        //为下载XBExcel做铺垫
        $f3->set('resultData',$resultData,120);
        
        $res="<school>";
        foreach ($f3->get('resultData') as $key => $value) {
            $res=$res."<studentInfo><stdName>".$value['stdName'].
                        "</stdName><raceName>".$value['rName'].
                        "</raceName><raceLevel>".$value['rLevel'].
                        "</raceLevel></studentInfo>";
        }
        $res=$res."</school>";
       
        echo $res;
    }
    function getJYConBySchool($f3)
    {
       //这里两句话很重要,第一讲话告诉浏览器返回的数据是xml格式
        header("Content-Type: text/xml;charset=utf-8");
        //告诉浏览器不要缓存数据
        header("Cache-Control: no-cache");
        $sch=$_POST['school'];
        $f3->set('schoolName',$sch,3600);
        $sqlJY="SELECT DISTINCT student.name,job.companyName FROM  middleschool ,job ,student WHERE student.schoolId = middleschool.code 
               AND student.studentNumber = job.studentNumber AND middleschool.name = '".$sch.
               "' ORDER BY student.name ASC";
        $f3->set('stdJY',$f3->get('DB')->exec($sqlJY),3600);
        //为下载XBExcel做铺垫
        //file_put_contents("D:/mylog.log",count($f3->get('stdJY'))."\r\n",FILE_APPEND);
        $res="<school>";
        foreach ($f3->get('stdJY') as $key => $value) {
            $res=$res."<studentInfo><stdName>".$value['name'].
                        "</stdName><companyName>".$value['companyName'].
                        "</companyName></studentInfo>";
        }
        $res=$res."</school>";
        echo $res;
    }

}
   