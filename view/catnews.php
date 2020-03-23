<?php
//вывод новостей по категориям 
ob_start();
?>
<h1>UUdised (kategoorii)</h1>
<br>

<?php
ViewNews::NewsByCategory($arr);
$content = ob_get_clean();
include_once 'view/layout.php';

?>