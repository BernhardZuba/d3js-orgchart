function db() {
   // TODO: Replace these variables
   $dsn = 'mysql:host=localhost;dbname=ORGANIGRAMM';
   $username = 'ORGANIGRAMM_USER';
   $password = 'PLEASE_FILL_ME_IN';
   $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
   );
   return new PDO($dsn, $username, $password, $options);
}

function getChilds($dbconn, $id) {
   $stmt = $dbconn->prepare("SELECT `id`, `desc` FROM `position` WHERE `parent_id`=?");
   $stmt->execute(array($id));
   return $stmt;
}

$dbconn = db();

$id = filter_input(INPUT_GET,"id", FILTER_VALIDATE_INT);
$stmt = getChilds($dbconn, $id);

if($id == 0) {
   // Initial load: Get the first children too
   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   $stmt2 = getChilds($dbconn, $row['id']);
   $i_j = 0;
   $childs = array();
   while($childrow = $stmt2->fetch(PDO::FETCH_ASSOC)) {
      $stmt3 = getChilds($dbconn, $childrow['id']);
      $hasChildRow = $stmt3->rowCount();
      if($hasChildRow > 0) {
         $hasChild = true;
      } else {         
         $hasChild = false;
      }
      
      $childs[$i_j] = array("id" => $childrow['id'], "desc" => $childrow['desc'], "hasChild" => $hasChild);
      $i_j++;
   }

   echo json_encode(array("id" => $row['id'], "desc" => $row['desc'], "children" => $childs));
} else {
   // Just check if there are children
   $i_i = 0;
   $childs = array();
   
   while($childrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $stmt3 = getChilds($dbconn, $childrow['id']);
      $hasChildRow = $stmt3->rowCount();
      if($hasChildRow > 0) {
         $hasChild = true;
      } else {
         $hasChild = false;
      }
      
      $childs[$i_i] = array("id" => $childrow['id'], "desc" => $childrow['desc'], "hasChild" => $hasChild);
      $i_i++;     
   }
   
   echo json_encode(array("result" => $childs));
}