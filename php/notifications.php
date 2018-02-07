<?php 
include 'dbconnection.php';
session_start();
if(!isset($_SESSION['mainuid']))
{
    echo('returntoindex');
    return;
}
$mid =  $_SESSION['mainuid'];
	$sql = "SELECT * FROM `notification` WHERE `userid` = '$mid' AND `status` = 0";
	$result = $connection->query($sql);
	$table ='';
    while ($row = $result->fetch_assoc()) {
        $type = $row["type"];
$content=$row["content"];
$id=$row["notificationid"];
        if($type=="friend"){
$table.='<div id="'.$id.'" class="flag note note--info" onclick="location.href=\'../php/requests.php\'">
           <div class="flag__image note__icon">
             <i class="fa fa-info"></i>
           </div>
           <div class="flag__body note__text">
             <p>'.$content.'</p>
           </div>
           <a  id="closer" href="javascript:close(this,'.$id.')" class="note__close" onclick="close(this,'.$id.')">
             <i class="fa fa-times"></i>
             <p class="noti-id" hidden>'.$id.'</p>
           </a>
         </div>';
        }
        else{
$table .= '<div  id="'.$id.'" class="flag note">
             <div class="flag__image note__icon">
               <i class="fa fa-heart"></i>
             </div>
             <div class="flag__body note__text">'
              .$content.'
             </div>
             <a id="closer" href="javascript:close(this,'.$id.')" class="note__close" onclick="close(this,"'.$id.'")">
               <i class="fa fa-times"></i>
                      <p class="noti-id" hidden>'.$id.'</p>
             </a>
           </div>';

        }

    }
echo $table;
?>