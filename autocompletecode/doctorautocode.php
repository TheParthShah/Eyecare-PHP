<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'wolfvoks');
define('DB_NAME', 'eyecareproj');


if (isset($_GET['term'])){
    $return_arr = array();

		$conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT ClientName FROM clientmaster WHERE ClientName LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));

        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['ClientName'];
        }



    // Toss back results as json encoded array.
    echo json_encode($return_arr);
}

?>
