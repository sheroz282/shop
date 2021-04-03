<?php

include_once __DIR__ ."/../../../common/src/Model/Rating.php";
include_once __DIR__ ."/../../../common/src/Service/DBConnector.php";

$reserveFields = ['id'];

$objReflection = new ReflectionClass('Rating');
$properties = $objReflection->getProperties();

$queryTemplate = "create table %s (
	id int not null auto_increment,
	%s,
	primary key (id)
	)engine = innoDB default charset \"utf8\"";

$arFields[];
foreach($properties as $property){
	if(isset($property->name) && !in_array($property->name, $reserveFields)){
		$arFields[] = $property->name. 'varchar(255)';
	}
}

$query = sprintf($queryTemplate, $objReflection->getName(), implode(',', $arFields));
$conn = DBConnector::getInstance()->connect();

mysqli_query($conn, $query);

if(!empty(mysqli_error($conn))) {
	print_r(mysqli_error($conn));
}

die("Table was create");

?>














