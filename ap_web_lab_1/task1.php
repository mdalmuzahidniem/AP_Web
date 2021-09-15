<?php
class student{
	public $name;
	public $id;
	public $dob;
	public $courses=[];

function showInfo(){
	echo "student name is:" .$this->name."<br>";
	echo "student id is" .$this->id."<br>";
	echo "student dob is" .$this->dob;
}

function addCourse($courseName){
	$course[]= $courseName;
}
function showAllCourse(){
	echo "name:".$this->name."<br>";
	echo "ID:".$this->id;
	echo "course:";
	foreach(this->course as $c){
		echo $c.",";
	}
}
}
$s1=new student();
$s1->name="nayim";
$s1->id="123";
$s1->dob="12-12-1999";
$s1->showInfo();
$s1->addCourse("OOP1");
$s1->addCourse("OOP2");
$s1->addCourse("PHP");
$s1->showAllCourse();
?>