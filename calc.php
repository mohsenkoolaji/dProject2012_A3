<?php

## if our broser does not support sessions, we cannot calculta
## and keep the results in the paper. I guess artifcial session
## identifier could do the trick. Let's see.

session_start();

if ($_GET['rst'] == "1") {
	## we want to reset the paper
	$_SESSION['paper'] = "";
}

switch ($_GET['op']) {
    case "*":
        $result = $_GET['arg1']*$_GET['arg2']; 
        break;
    case "/":
        $result = $_GET['arg1']/$_GET['arg2'];
        break;
    case "+":
        $result = $_GET['arg1']+$_GET['arg2'];
        break;
    case "-":
        $result = $_GET['arg1']-$_GET['arg2'];
        break;
    default:
	$result = "NanNanNaa";
}

$result_line =  "" . $_GET['arg1'] . " " . $_GET['op'] . " " . $_GET['arg2'] . " = " . $result;
$_SESSION['paper']=$_SESSION['paper'] . $result_line . "\r\n";

?>
<?php
if ($_GET['noform'] == "1") {
	## we just dump the calculations
	## last is lates as in paper it would
	echo $_SESSION['paper'];
	exit(1);
} 
?>
<html><head><title>Mighty Calculatron in Form Mode</title></head><body>

<?php
echo '<pre>';
echo $_SESSION['paper'];
echo '</pre>';

?>


<form action="" method="get">
 <p>mighty arg1<input type="text" name="arg1" value="<?php echo $_GET['arg1']; ?>"/></p>
 <p>mighty arg2<input type="text" name="arg2" value="<?php echo $_GET['arg2']; ?>"/></p>
 <p>mighty   op
<select name="op">
  <option value="+" <?php if ($_GET['op'] == "+") { echo 'selected="true"'; } ?>>+</option>
  <option value="-" <?php if ($_GET['op'] == "-") { echo 'selected="true"'; } ?>>-</option>
  <option value="*" <?php if ($_GET['op'] == "*") { echo 'selected="true"'; } ?>>*</option>
  <option value="/" <?php if ($_GET['op'] == "/") { echo 'selected="true"'; } ?>>/</option>
</select>
</p>
 <p><input type="submit" value="I DARE YOU"/></p>
</form>

</body><html>
