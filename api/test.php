<?php
	$type=$_POST['type'];
	if($type=='test'){
		getName();
	}else{
		echo '333';
	}
	function getName(){
		$name=$_POST['name'];
		$list = array('anana' => 'asdasd','asidjaoisjd'=>135435 );
		$arr=array('name' => $list,'key'=> 25641654654 );
		echo json_encode($arr);
	}
 ?>