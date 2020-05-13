<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use PDO;

class Reg extends Model
{
	private $conn;
	private $time;

    /**
     * Reg constructor.
     */
    public function __construct()
	{
		$conn = connect();
		$this->conn = $conn;
		startTime();
		$this->time = date('Y:m:d H:i:s');
	}
	//開始
	public function register($action, $data, $ip = '')
	{
		$at = $data['account'];
		$tf = $this->checkAt($at);
		if($tf) {
			if ($action == 'reg') {
				return $this->reg($data);
			} else {
				return $this->cm($data, $ip);
			}
		} else {
			return 'repeat';
		}		
	}
	//一般註冊
	private function reg($data)
	{
		$id = $this->inst($data);
		return $id;
	}
	//訪客轉會員
	private function cm($data, $ip)
	{
		$id = $this->inst($data);
		$tf = $this->changedata($ip, $data['account']);
		if($tf)
			return $id;
		else
			return 'error';
	}
	//判斷帳號
	private function checkAt($at)
	{
		$query = '
			SELECT id
			FROM userdata
			WHERE account = ?
		';
		$result = $this->conn->prepare($query);
		$result->execute(array($at));
		$row = $result->fetch(PDO::FETCH_ASSOC);
		if(empty($row)) {
			return true;
		} else {
			return false;
		}
	}
	//新增
	private function inst($data)
	{
		$query = '
			INSERT INTO userdata (name, account, password, identity, register_time)
			VALUES (?,?,?,?,?)
		';
		$result = $this->conn->prepare($query);
		$result->execute(array($data['name'],$data['account'],$data['pwd'],'general',$this->time));
		if($result->rowCount() == 1) {
			return $this->getId($data['account']);
		} else {
			return 'error';
		}
	}
	//取得ID
	private function getId($at)
	{
		$query = '
			SELECT id
			FROM userdata
			WHERE account = ?
		';
		$result = $this->conn->prepare($query);
		$result->execute(array($at));
		$row = $result->fetch(PDO::FETCH_ASSOC);
		$id = $row['id'];
		return $id;
	}
	//轉換欄位
	private function changedata($ip, $at)
	{
		$data = array(
			'address'
			, 'student_data'
		);
		$count = count($data);
		for ($i=0; $i < $count; $i++) { 
			$query = '
				UPDATE '.$data[$i].'
				SET userid = ?, v_ip = ?
				WHERE v_ip = ?
			';
			$result = $this->conn->prepare($query);
			$result->execute(array($at,null,$ip));
		}
		$query = '
			DELETE FROM visitors
			WHERE ip = ?
		';
		$result = $this->conn->prepare($query);
		$result->execute(array($ip));
		return true;
	}
}
