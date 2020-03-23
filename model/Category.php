<?php
//class запрос к базе данных и получения массива данных - список категорий

class Category{
	public static function getAllCategory() {
		$query = "SELECT * FROM category" ;
		$db = new Database();
		$arr = $db->getAll($query);
		return $arr;
	}
}