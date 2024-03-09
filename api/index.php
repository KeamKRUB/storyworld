<?php
require_once("_system/_config.php");
$connect = new mysqli('https://storyworldxyz.000webhostapp.com/', 'id21970520_root', '5rXf>_W0aat4Nfv|', 'id21970520_storyworld');

// Check if the connection is successful
if ($connect->connect_errno) {
    die("Failed to connect to MySQL: " . $connect->connect_error);
}

$sql_draw = 'SELECT * FROM draw';
$query_draw = $connect->query($sql_draw);

// Check if the query executed successfully
if (!$query_draw) {
    die("Error executing query: " . $connect->error);
}
if(isset($_SERVER["HTTP_ORIGIN"]))
{
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
}
else
{
    header("Access-Control-Allow-Origin: *");
}
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 600");
if($_SERVER["REQUEST_METHOD"] == "OPTIONS")
{
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}
if(isset($_POST['submit'])){
    $delete = "DELETE FROM `draw`";
    $stmt = $connect->prepare($delete);
    if ($stmt->execute()) {
        echo "data deleted successfully";
    } else {
        echo "error delete data" . $stmt->error;
    }
    $stmt->close();
    $save = "INSERT INTO `draw` (`ip`, `vector`, `width`, `color`) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($save);
    $stmt->bind_param("ssis", $ip, $vector, $width, $color);
    $ip = "sddsds";
    $vector = $_POST['vector'];
    $width = $_POST['width'];
    $color = $_POST['color'];
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
    $stmt->close();
}
// $image = new Imagick('image/output.jpg');
if ($query_draw->num_rows > 0) {
    while ($drawR = mysqli_fetch_assoc($query_draw)){
        echo $drawR['id'];
    } }
// $vectors = explode(' ', $drawR['vector']);
// $draw = new ImagickDraw();
// $draw->setStrokeColor($drawR['color']);
// $draw->setStrokeWidth($drawR['width']);
// $draw->setFillColor('none');
// $draw->pathStart();
// for ($i = 0; $i < count($vectors) - 3; $i += 2) {
// $control_x = ($vectors[$i] + $vectors[$i + 2]) / 2;
// $control_y = ($vectors[$i + 1] + $vectors[$i + 3]) / 2;
// $draw->pathLineToAbsolute($control_x, $control_y);
// }
// $image->drawImage($draw);
//     }
// } else {
//     echo "No rows found in the draw table.";
// }
// $imageFilePath = "image/output.jpg";
// $image->writeImage($imageFilePath);
// $image->clear();
// $image->destroy();

$connect->close();
?>