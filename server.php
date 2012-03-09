//to do step 1:
    - fisrt number in text field can not be detected
    - sometimes some atomic operations ignored, althought we have a condition in client file 67:22 which suppose to wait for response...
    - textfield dose not return + and * signs!! How to Solve it?



<?php
//deceting sent operation
switch ($_REQUEST['op']) {

    case "+" :
       $content = file('result.txt'); //get the rsult form the previous operation from the file
       $arg1=$content[0];
       $result=floatval($arg1)+floatval($_REQUEST['arg2']); //dose the operation with the second argument
       $file ="result.txt";
       $openedfile = fopen($file, "w"); // openning the file to write the result
       fwrite($openedfile,$result); //writing the new result in the file
       $op="+";
       break;

    case "*" :
       $content = file('result.txt');
       $arg1=$content[0];
       $result=floatval($arg1)*floatval($_REQUEST['arg2']);
       $file = "result.txt";
       $openedfile = fopen($file, "w");
       fwrite($openedfile,$result);
       $op="*";
       break;

   case "-" :
        $content = file('result.txt');
        $arg1=$content[0];
        $result=floatval($arg1)-floatval($_REQUEST['arg2']);
        $file = "result.txt";
        $openedfile = fopen($file, "w");
        fwrite($openedfile,$result);
        $op="-";
        break;

   case "/" :
       $content = file('result.txt');
       $arg1=$content[0];
       $result=floatval($arg1)/floatval($_REQUEST['arg2']);
       $file = "result.txt";
       $openedfile = fopen($file, "w");
       fwrite($openedfile,$result);
       if($result == 0)
       {
         echo "Invalid Input!";
       }
       $op="/";
       break;

   default :
   echo "The value is not match"; //in case op can not be detected!
   break;

   }
    //try to keep track of the all the operations in the histroy.txt file
   $thefile = "history.txt";
   $output=$arg1 .$_REQUEST['op'] .$_REQUEST['arg2'] .'='.$result;
   $space = "\r\n";
   $openedfile = fopen($thefile, "a");

   fwrite($openedfile, $output.$space);
   $history = file_get_contents($thefile);

   //send history to client to display
  foreach (file($thefile) as $name) {
       echo('<p>'.$name.'</p>');
   }

?>