<?php
$upload_type=".txt";

$itemname=$_GET['name'];
$uid=$_GET['uid'];

if($_FILES['userfile']['error']>0){
    echo"上传失败：";
    switch($_FILES['userfile']['error']){
    case 1: echo"上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";break;
    case 2: echo"上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";break;
    case 3: echo"文件只有部分被上传";break;
    case 4: echo"没有文件被上传";break;
    }
}
$uploaddir="userpro/$uid/$itemname/";

$uploadfile=$uploaddir.basename($_FILES['userfile']['name']);
if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
    if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile)){
        echo '上传成功 <a href="item.php?name='.$itemname.'&uid='.$uid.'"></a>';
        //echo "<a href='http://localhost/".$uploadfile."'>".basename($_FILES['userfile']['name'])."</a>";
    }
    else{
        echo "error\n";
    }
}
//print_r($_FILES);
function check_type($upload_type){
    $file_name=$_FILES['form']['name'];
    $findtype=strtolower(strrchr($file_name,"."));
    $allow=strpos($upload_type,$findtype);
    if($allow===false){
        return false;
    }else{return true;}
}
?>