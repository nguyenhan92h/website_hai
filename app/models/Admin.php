<?php
use \DB;

class Admin extends BaseModel
{
	public static function changeCol($tbl, $col, $val, $where){
		$data = DB::table($tbl)->where($where)->update(array("$col" => $val));
		return $data;
	}
}