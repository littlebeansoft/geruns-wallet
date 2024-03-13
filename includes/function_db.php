<?php	class control_db{
	public $conn;
	function __construct(){
		$db_type="mysql";
		$hostname='localhost';
		$dbname='ndec_51';
		$user='root';
		$password='@nfeadmin123';
		$option=array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		);
		try {
			$con = new PDO("$db_type:host=$hostname;dbname=$dbname", $user, $password,$option);
			// set the PDO error mode to exception
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn=$con;
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
		
	}
	/*	
		//วิธีเรียกใช้งาน
		$tb='tbname'; ระบุ tbname
		$data= array(); ระบุข้อมูลที่ต้องการนำเข้า อยู่ในรูป array โดย key ต้องตรงกับชื่อ field ใน tbname
		$query=new control_db(); >> เรียกใช้งาน
		$re=$query->insert_data($tb,$data); เพิ่มข้อมูล
	*/	
	public function insert_data($table,$data){
		$sq="insert into $table (";
		$co=count($data);
		$i=1;
		$va="";
		while(list($key, $value) = each($data)) {
			$sq .= $key;
			$va .= ":".$key;
			if($i<$co){ $sq .= ',';$va .=",";}
			$i++;
			$a[':'.$key]=$value;
		}
		$sq .=") values(".$va.")";
		$sql=$sq;
		$query=$this->conn->prepare($sql);
		try{
			$query->execute($a);
			$re='0';
			}catch(PDOException $er){
			$re=$er->getMessage();
		}
		$this->conn=null;
		return $re;
	}
	/*	
		//วิธีเรียกใช้งาน
		$tb='tbname';
		$data= array();
		$query=new control_db();
		$re=$query->replace_data($tb,$data);
	*/
	
	public function replace_data($table,$data){
		$sq="replace into $table (";
		$co=count($data);
		$i=1;
		$va="";
		while(list($key, $value) = each($data)) {
			$sq .= $key;
			$va .= ":".$key;
			if($i<$co){ $sq .= ',';$va .=",";}
			$i++;
			$a[':'.$key]=$value;
		}
		$sq .=") values(".$va.")";
		$sql=$sq;
		$query=$this->conn->prepare($sql);
		try{
			$query->execute($a);
			$re='0';
			}catch(PDOException $er){
			$re=$er->getMessage();
		}
		$this->conn=null;
		return $re;
	}
	
	public function update_data($table,$data,$condi){
		/*	
			//วิธีเรียกใช้งาน
			$tb='tbname';
			$data= array();
			$condition="string condition for edit data"		
			$query=new control_db();
			$re=$query->update_data($tb,$data,$condition);
		*/
		
		$sq="update $table set ";
		$co=count($data);
		$i=1;
		while(list($key,$value)=each($data)){
			$sq .= "$key=:$key";
			$a[':'.$key]=$value;
			if($i<$co){$sq.=",";}
			$i++;
		}
		$sq .=" where $condi";
		$sql=$sq;
		$query=$this->conn->prepare($sql);
		try{
			$query->execute($a);
			$re='0';
			}catch(PDOException $er){
			$re=$sql.' '.$er->getMessage();
		}
		$this->conn=null;
		return $re;
	}
	public function delete_data($table,$condi){
		/*	
			//วิธีเรียกใช้งาน
			$tb='tbname';
			use varible from connect.php -> $conn
			$condition="string condition for edit data"		
			$query=new control_db();
			$re=$query->edit_data($tb,$condition);
		*/
		$sql= "delete from $table where $condi";
		$query=$this->conn->prepare($sql);
		try{
			$query->execute();
			$re='0';
			}catch(PDOException $er){
			$re=$er->getMessage();
		}
		$this->conn=null;
		return $re;
	}
}
/* ตัวอย่างการเรียกใช้ function
	$query= new control_db();
	$a['plan_budget']='2565';
	$a['plan_title']='งบลงทุน 2';
	$a['schoolid']='1276010001';
	$tbname='egp_plan';
	$condi=" plan_id='10'";
	echo $query->delete_data($tbname,$condi);
*/
function set_date($date,$op){
	$da=explode('-',$date);
	if($op=='en'){
		$re=($da['2']-543).'-'.$da[1].'-'.$da[0];
		}else{
		$re=$da[2].'-'.$da[1].'-'.($da[0]+543);
	}
	return $re;
}

?>