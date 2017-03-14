<?php
	$type=$_POST['type'];
	switch ($type){
		case 'test':
			getName();
		break;
		case 'login':
			login();
		break;
		case 'signIn':
			signIn();
		break;
		case 'getSchedule':
			getSchedule();
		break;
		case 'getFinish':
			getFinish();
		break;
		case 'add':
			addSchedule();
		break;
		case 'finish':
			finishSchedule();
		break;
		case 'delete':
			deleteSchedule();
		break;
		case 'addNote':
			addNote();
		break;
		case 'getNote':
			getNote();
		break;
		case 'getNotePage':
			getNotePage();
		break;
		case 'addComment':
			addComment();
		break;
	}
	function login(){
		include_once('config.php');
		$name=$_POST['name'];
		$psw=$_POST['key'];
		$resultList=array();
		$connect=mysqli_connect($server,$myname,$mypsw,'now');
		if($connect){
			$sql="SELECT * FROM user WHERE userid=$name";
			$result=mysqli_query($connect,$sql);
			$ss=mysqli_fetch_object($result);
			if(is_object($ss)){
				if($ss->userkey==$psw){
					$resultList= array('code' => 0, 'mes'=> 'success');
					setcookie('name',$name);
					setcookie('psw',$psw);
					echo json_encode($resultList);
				}else{
					$resultList= array('code' => 1, 'mes'=> '密码错误！');
					echo json_encode($resultList);
				}	
			}else{
				$resultList= array('code' => 2, 'mes'=> '请先注册！');
				echo json_encode($resultList);
			}
			// mysqli_close();
		}else{
			mysqli_close();
			echo 'connect error';
		}
	}
	function signIn(){
		include_once('config.php');
		$id=$_POST['id'];
		$key=$_POST['key'];
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$major=$_POST['major'];
		$connect=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($connect,'set names "utf8"');
		if($connect){
			$sql='SELECT * FROM `user` WHERE `userid`='.$id;
			$checkResult=mysqli_query($connect,$sql);
			if(is_object(mysqli_fetch_object($checkResult))){
				$mes= array('code' => 1 , 'mes'=> '该账号已经被注册了！');	
				echo json_encode($mes);
			}else{
				$sql1='INSERT INTO `user` (`userid`,`userkey`) VALUES ('.$id.', "'.$key.'")';
				$result=mysqli_query($connect,$sql1);
				if($result==true){
					$sql2='INSERT INTO `userinfo` (`userId`,`userName`,`userPhone`,`userMajor`) VALUES ('.$id.',"'.$name.'",'.$phone.',"'.$major.'")';
					
					$result1=mysqli_query($connect,$sql2);
						if($result1==true){
							$mes= array('code' => 0 , 'mes' => '注册成功！');
					 		echo json_encode($mes);
						}else if($result1==false){
							$mes= array('code' => 2 , 'mes'=> '用户信息有误，请重新填写');
							echo json_encode($mes);
						}
					
				}else if($result==false){
					$mes= array('code' => 3 , 'mes'=> '注册失败，请重新注册');
					echo json_encode($mes);
				}
			}
			
		}else{
			mysqli_close();
			echo 'connect error';
		}
	} 
	function getFinish(){
		include_once('config.php');
		$id=$_POST['userid'];
		$con=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($con,'set names "utf8"');
		if($con){
			$sql='SELECT * FROM `plan` WHERE `userid`="'.$id.'" AND `finish`=1 ORDER BY `time` DESC';
			$result=mysqli_query($con,$sql);
			$row=mysqli_fetch_object($result);
			if(is_object($row)){
				$mess=array();
				$mes=array('code'=>0 );
				$i=0;
				$mess[$i]=$row;
				$i++;
				while($row=mysqli_fetch_object($result)){
					$mess[$i]=$row;
					$i++;
				}
				$mes['mes']=$mess;
				echo json_encode($mes);
				// echo json_encode(mysqli_fetch_object($result));
			}else{
				$mes=array('code'=>1,'mes'=>'查询失败');
				echo json_encode($mes);
			}
		}else{
			mysqli_close();
			echo 'connect fail';
		}
	}
	function getSchedule(){
		include_once('config.php');
		$id=$_POST['userid'];
		$con=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($con,'set names "utf8"');
		if($con){
			$sql='SELECT * FROM `plan` WHERE `userid`="'.$id.'" AND `finish`=0 ORDER BY `time` ASC' ;
			$result=mysqli_query($con,$sql);
			$row=mysqli_fetch_object($result);
			if(is_object($row)){
				$mess=array();
				$mes=array('code'=>0 );
				$i=0;
				$mess[$i]=$row;
				$i++;
				while($row=mysqli_fetch_object($result)){
					$mess[$i]=$row;
					$i++;
				}
				$mes['mes']=$mess;
				echo json_encode($mes);
				// echo json_encode(mysqli_fetch_object($result));
			}else{
				$mes=array('code'=>1,'mes'=>'查询失败');
				echo json_encode($mes);
			}
		}else{
			mysqli_close();
			echo 'connect fail';
		}
	}
	function addSchedule(){
		include_once('config.php');
		$id=$_POST['id'];
		$time=$_POST['time'];
		$content=$_POST['content'];
		$notice=$_POST['notice'];
		$con=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($con,'set names "utf8"');
		if($con){
			$sql='INSERT INTO `plan` (`userid`,`time`,`content`,`notice`) VALUES ("'.$id.'","'.$time.'","'.$content.'","'.$notice.'")';
			$insertResult=mysqli_query($con,$sql);
			if($insertResult==true){
				$mes= array('code' => 0, 'mes'=> '添加成功');
				echo json_encode($mes);
			}else if($insertResult==false){
				$mes=array('code'=>1,'mes'=>'添加失败');
			}
		}else{
			mysqli_close();
			echo 'connect error';
		}
	}
	function finishSchedule(){
		include_once('config.php');
		$id=$_POST['id'];
		$userid=$_POST['userid'];
		// $time=$_POST['time'];
		// $content=$_POST['content'];
		// $notice=$_POST['notice'];
		$con=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($con,'set names "utf8"');
		if($con){
			$sql='UPDATE `plan` SET `finish`=1 WHERE `userid`="'.$userid.'" AND id="'.$id.'"' ;
			$insertResult=mysqli_query($con,$sql);
			if($insertResult==true){
				$mes= array('code' => 0, 'mes'=> '修改成功');
				echo json_encode($mes);
			}else if($insertResult==false){
				$mes=array('code'=>1,'mes'=>'修改失败');
			}
		}else{
			mysqli_close();
			echo 'connect error';
		}
	}
	function deleteSchedule(){
		include_once('config.php');
		$con=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($con,'set names "utf8"');
		if($con){
			$sql='DELETE FROM `plan` WHERE `id`=2';
			$result=mysqli_query($con,$sql);
			if($result==true){
				$mes=array('code'=>0,'mes'=>'删除成功');
				echo json_encode($mes);	
			}else if($result==false){
				$mes=array('code'=>1,'mes'=>'删除失败');
				echo json_encode($mes);
			}
		}else{
			mysqli_close();
			echo 'connect fail';
		}
	}
	function addNote(){
		include_once('config.php');
		$title=$_POST['title'];
		$time=$_POST['time'];
		$content=$_POST['content'];
		$noteType=$_POST['noteType'];
		$noteType=$_POST['noteType'];
		$con=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($con,'set names "utf8"');
		if($con){
			$sql='SELECT * FROM `userinfo` WHERE `userId`=2013051976';
			$selectResult=mysqli_query($con,$sql);
			$row=mysqli_fetch_object($selectResult);
			if(is_object($row)){
				$id=$row->userId;
				$name=$row->userName;
				$sql='INSERT INTO `note` (`posterid`,`postername`,`title`,`time`,`content`,`type`) VALUES ("'.$id.'","'.$name.'","'.$title.'","'.$time.'","'.$content.'","'.$noteType.'")';
				$insertResult=mysqli_query($con,$sql);
				if($insertResult==true){
					$mes= array('code' => 0, 'mes'=> '添加成功');
					echo json_encode($mes);
				}else if($insertResult==false){
					$mes=array('code'=>1,'mes'=>'添加失败');
				}
			}else{
				$mes= array('code' =>1 , 'mes'=>'fail');
				echo json_encode($mes);
			}
		}else{
			mysqli_close();
			echo 'connect error';
		}
	}
	function getNote(){
		include_once('config.php');
		$num=$_POST['num'];
		$con=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($con,'set names "utf8"');
		if($con){
			$sql='SELECT * FROM `note` LIMIT '.$num.',5';
			$result=mysqli_query($con,$sql);
			$row=mysqli_fetch_object($result);
			if(is_object($row)){
				$mess=array();
				$mes=array('code'=>0);
				$i=0;
				$mess[$i]=$row;
				$i++;
				while($row=mysqli_fetch_object($result)){
					$mess[$i]=$row;
					$i++;
				}
				$mes['mes']=$mess;
				echo json_encode($mes);
			}else{
				$mes=array('code'=>1,'mes'=>'查询失败');
				echo json_encode($mes);
			}
		}else{
			mysqli_close();
			echo 'connect fail';
		}
	}
	function getNotePage(){
		include_once('config.php');
		$id=$_POST['noteId'];
		$con=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($con,'set names "utf8"');
		if($con){
			$sql='SELECT * FROM `note` WHERE `id`='.$id;
			$result=mysqli_query($con,$sql);
			$row=mysqli_fetch_object($result);
			if(is_object($row)){
				$mes=array('code'=>0,'mes'=>$row);
				echo json_encode($mes);			
			}else{
				$mes=array('code'=>1,'mes'=>'获取失败');
				echo json_encode($mes);
			}
		}else{
			mysqli_close();
			echo 'connect fail';
		}
	}
	function addComment(){
		include_once('config.php');
		$userId=$_POST['userId'];
		$noteId=$_POST['noteId'];
		$userName=$_POST['userName'];
		$time=$_POST['time'];
		$content=$_POST['content'];
		$con=mysqli_connect($server,$myname,$mypsw,'now');
		mysqli_query($con,'set names "utf8"');
		if($con){
			$sql='INSERT INTO `notecomment` (`noteid`,`answerid`,`answername`,`time`,`content`) VALUES ("'.$noteId.'","'.$userId.'","'.$userName.'","'.$time.'","'.$content.'")';
			$result=mysqli_query($con,$sql);
			if($result==true){
				$mes= array('code' =>0 , 'mes'=>'添加成功');
				echo json_encode($mes);
			}else if($result==false){
				$mes=array('code'=>1,'mes'=>'添加失败');
				echo json_encode($mes);
			}
		}else{
			mysqli_close();
			echo 'connect fail';
		}
	}
 ?>