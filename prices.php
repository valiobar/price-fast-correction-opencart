<?php
session_start();
//$db = new mysqli('localhost', 'root', '', 'vimaxgrc_soslocksmith_eshop');
//$db->set_charset("utf8");
//if ($db->connect_errno) {
//    die('Cannot connect to database');
//}




if(isset($_GET['username'])&& isset($_GET['password'])){
   $username = $_GET['username'];
    $password = $_GET['password'];
    $database =  $_GET['database'];
    $_SESSION['username'] = $username;
    $_SESSION['password'] =  $password;
    $_SESSION['database'] =  $database;
    $db = new mysqli('localhost', $username, $password , $database);
    $db->set_charset("utf8");
    $categoryQuery = "SELECT category_id,`name` from oc_category_description where language_id =2
                      order by `name`";
    $languageQuery ="SELECT l.language_id,l.name,l.code from oc_language as l";
    if ($db->connect_errno) {
        $response_array['status'] = 'Connection error';
        echo json_encode($response_array);
    }else {


        $languages = $db->query($languageQuery);
        $langArr = [];
        while ($language = $languages->fetch_assoc()) {

           if ($language[name] =="Български"){
               $langArr['bg'] = $language[language_id];
           }
           else if ($language[name] =="English"){
                $langArr['en'] = $language[language_id];
            }
             else{
                 $langArr[$language[code]]= $language[language_id];
             }
        }

        if(array_key_exists('bg', $langArr)){
            $langId = $langArr['bg'];
        } else if (array_key_exists('en', $langArr)){
            $langId = $langArr['en'];
        } else{
            $langId = array_shift($langArr);
        }
        $categoryQuery = "SELECT category_id,`name` from oc_category_description where language_id =".$langId."
                      order by `name`";


        $result = $db->query($categoryQuery);

        while ($row = $result->fetch_assoc()) {

            $data[$row[name]]= $row[category_id];


        }

        header('Content-type: application/json');
        echo json_encode($data);
    }
}



if(isset($_GET['category'])){

    $db=new mysqli('localhost',  $_SESSION['username'] , $_SESSION['password'], $_SESSION['database']);
    $db->set_charset("utf8");
    $category = $_GET['category'];
    $query = "SElect p.product_id, pc.category_id , pd.name,pd.description ,p.image,p.price from oc_product as p
join oc_product_to_category   as pc
on pc.product_id = p.product_id
join oc_product_description as pd
on pd.product_id = p.product_id
where p.status =1 
and pc.category_id = ".$category;

    $siteUrlQuery = "SELECT o.store_url from oc_order as o
order by o.order_id desc
limit 1";
    $siteUrl = '';
    $siteUrlArr = $db->query($siteUrlQuery);
    $siteUrl = $siteUrlArr->fetch_assoc();

    $data = array();
    $result = $db->query($query);

       while ($row = $result->fetch_assoc()) {

           $image = $siteUrl[store_url]."image/".$row[image];


         $data[$row[product_id]]=array ($row[category_id],$row[name],htmlspecialchars_decode($row[description]),$image,$row[price]);


       }
    echo json_encode($data);

}
if(isset($_GET['id'])&&isset($_GET['newPrice'])){
    $id = $_GET['id'];
    $newPrice = $_GET['newPrice'];

    updateDB($id,$newPrice);

}
if(isset($_GET['delItemId'])){
    $db=new mysqli('localhost',  $_SESSION['username'] , $_SESSION['password'], $_SESSION['database']);
    $db->set_charset("utf8");
    $delItemId = $_GET['delItemId'];
    $deleteQuery = "DELETE FROM oc_product WHERE product_id = ".$delItemId;
    if ($db->query($deleteQuery) === TRUE) {
        $response_array['status'] = "Record deleted successfully";
        echo json_encode($response_array);

    } else {
        $response_array['status'] = "Error deleting record: " . $db->error;
        echo json_encode($response_array);

    }

}

function updateDB($id,$newPrice){
    $db=new mysqli('localhost',  $_SESSION['username'] , $_SESSION['password'], $_SESSION['database']);
    $db->set_charset("utf8");
    $query = "UPDATE `oc_product` set `price`=".$newPrice." WHERE `product_id` =".$id;
    var_dump($query);
  $db->query($query);
   echo $db->affected_rows;
}
function Connect($username,$password){
    $db = new mysqli('localhost', 'root', '', 'vimaxgrc_soslocksmith_eshop');
    $db->set_charset("utf8");
    if ($db->connect_errno) {
        die('Cannot connect to database');
    }else{
        return $db;
    }

}