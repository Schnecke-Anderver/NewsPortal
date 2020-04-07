<?php
class modelAdminNews{

	public static function getNewsList() {
		$query = "SELECT news.*, category.name, users.name  as username from news, category, users WHERE news.category_id=category.id AND news.user_id=users.id ORDER BY `news`.`id` DESC";
		$db = new Database();
		$arr = $db->getAll($query);
		return $arr;
	}

//----------------Add
	public static function getNewsAdd() {
		$test=false;
		if(isset($_POST['save'])) {
			if(isset($_POST['title']) && isset($_POST['text']) && isset($_POST['idCategory']) ) {

				$title=$_POST['title'];
				$text=$_POST['text'];
				$idCategory=$_POST['idCategory'];
			//--------images type blob
				$image=addslashes (file_get_contents($_FILES['picture'] ['tmp_name']));
			//---------------------------
				$sql="INSERT INTO `news` (`id`, `title`, `text`, `picture`, `category_id`, `user_id`) VALUES (NULL, '$title', '$text', '$image', '$idCategory', '1')";
				  	 $db = new Database();
				   	$item = $db->executeRun($sql);
					if($item==true) {
						$test=true;
					}
			}
		}
		return $test;
	}
	/////////--------------news detail id
	public static function getNewsDetail($id){
		$query = "SELECT news.*, category.name, users.name as username from news, category, users
		WHERE news.category_id=category.id AND news.user_id=user.id and news.id=".$id;
		$db = new Database();
		$arr = $db->getOne($query);
		return $arr;
	}
	//---------------news edit
	public static function getNewsEdit($id) {
		$test=false;
		if(isset($_POST['save'])){
			if(isset($_POST['title']) && isset($_POST['text']) && isset($_POST['idCategory']) ){
				$title=$_POST['title'];
				$text=$_POST['text'];
				$idCategory=$_POST['idCategory'];
//-----------------images type blob
			$image=$_FILES['picture']['name'];
			if($image!=""){
				$image=addslashes(file_get_contents($_FILES['picture']['tmp_name']));
		/*	//------images type text
				$uploaddir = '../image/';
				$uploadfile = $uploaddir . basename($_FILES['picture']['name']);
				copy($_FILES['picture']['tmp_name'], $uploadfile); */


/*//---в учебных материалах лежит такой вариант: 

//----------------------images
	$image = $_FILES['picture']['name']; //
		if($image!=""){
		$uploaddir = '../images/';
		$uploadfile = $uploaddir . basename($_FILES['picture']['name']);
		copy($_FILES['picture']['tmp_name'], $uploadfile);
	}
		else{
			$image ="newsphoto.png";
	}

*/

			}//if($image!="")
	//-----------------------------------------------------------
			if($image==""){
				$sql="UPDATE `news` SET`title` = '$title', `text` = '$text', `category_id` = '$idCategory' WHERE `news`.`id` = ".$id;
			}//if($image=="")
			else{
				$sql="UPDATE `news` SET `title` = '$title', `text` = '$text', `picture` = '$image', `category_id` = '$idCategory' WHERE `news`.`id` = ".$id;
			}
					$db = new Database();
					$item = $db->executeRun($sql);
				if($item==true){
					$test=true;
				}

			}//if
		}//if
		return $test;
	}//funct  

//------------------------news delete
	public static function getNewsDelete($id) {
		$test=false;
		if(isset($_POST['save'])){

			$sql="DELETE FROM `news`WHERE `news`.`id` = ".$id;
			$db = new Database();
					$item = $db->executeRun($sql);
				if($item==true){
					$test=true;
				}
		}
		return $test;
	}//func

}//class