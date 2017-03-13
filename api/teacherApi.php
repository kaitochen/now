<?php 
$type=$_POST['type'];
switch ($type) {
	case 'login':
		login();
		break;
	case 'signIn':
		signIn();
		break;
	case 'addProject':
		addProject();
	break;
}
function signIn(){
	include_once('config.php');
	$id=$_POST['id'];
	$key=$_POST['key'];
	$name=$_POST['name'];
	$phone=$_POST['phone'];
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
				$sql2='INSERT INTO `teacherinfo` (`teacherid`,`teachername`,`teacherphone`) VALUES ('.$id.',"'.$name.'",'.$phone.')';
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
function addProject(){
	include_once('config.php');
	$id=$_POST['teacherId'];
	$project=$_POST['project'];
	$con=mysqli_connect($server,$myname,$mypsw,'now');
	mysqli_query($con,'set names "utf8"');
	if($con){
		$sql='INSERT INTO `project` (`teacherid`,`projectname`) VALUES ('.$id.',"'.$project.'")';
		$result=mysqli_query($con,$sql);
		if($result==true){
			$mes=array('code'=>0,'mes'=>'增加成功');
			echo json_encode($mes);
		}else if($result==false){
			$mes=array('code'=>1,'mes'=>'增加失败');
			echo json_encode($mes);
		}
	}else{
		mysqli_close();
		echo 'connect fail';
	}
}
function addNotice(){
	$teacherid=$_POST['teacherid'];
	
}	