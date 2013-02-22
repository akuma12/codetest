<?php
function sanitize_name($name) {
	$name = trim($name);
	$name = preg_replace('/[^a-zA-Z\s]/', "", $name);
	//$name = preg_replace('/[\s+]/', " ", $name);
	return ucwords(strtolower($name));
}

function age_of($name) {
	try {
	  $conn = new PDO('mysql:host=localhost;dbname=company', "bob", "likes_kittens");
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
	  return $e;
	}
	
	$stmt = $conn->prepare("SELECT age FROM person WHERE name = :name");
	$stmt->bindParam(':name', $name);
	$stmt->execute();
	$obj = $stmt->fetchObject();
	if(count($obj) > 0) {
		return $obj->age;
	} else {
		return false;
	}
}

echo sanitize_name("  i   &%$   am  #1   name");

?>