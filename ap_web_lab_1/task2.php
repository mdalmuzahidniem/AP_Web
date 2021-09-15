<?php
class car{
	public $EnginNo;
	public $Model;
	public $Owner;
	
	function __construct(...$a){
		$this->EnginNo= $a[0];
		$this->Model= $a[1];
		$this->Owner= $a[2];
	}
	function showInfo(){
		echo "EnginNo:". $this->EnginNo."<br>";
		echo "model:". $this->Model."<br>";
		echo "Owner:". $this->Owner."<br>";
	}
}
$car1=new car("1122","Honda","Nayim");
$car1->showInfo();
?>