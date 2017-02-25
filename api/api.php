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
	}
	function getName(){
		$name=$_POST['name'];
		$list = array('anana' => 'asdasd','asidjaoisjd'=>135435 );
		$arr=array('name' => $list,'key'=> 25641654654 );
		echo json_encode($arr);
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
		if($connect){
			$sql='INSERT INTO `user` (`userid`,`userkey`) VALUES ('.$id.', '.$key.')';
			$result=mysqli_query($connect,$sql);
			echo var_dump($result);
			// if($result==true){
			// 	echo 'true';
			// }eles if($result==false){
			// 	echo 'false';
			// }
			// if(is_object($ss)){
			// 	echo 'success';
			// }else{
			// 	echo 'fail';
			// }
		}else{
			mysqli_close();
			echo 'connect error';
		}
	}
 ?>