<?php 

require_once __DIR__.'/conn.php';

// $name = $_POST['name'];
extract($_POST);




if(isset($_POST['readRecords'])){
    $tbl = '<table class="table table-bordered table-striped">
    <tr> 
    <th>SNO</th>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Update</th>
    <th>Delete</th>
    </tr>
    ';


    $sql_query = "SELECT * FROM staff";


 $res = mysqli_query($conn,$sql_query);

    if(mysqli_num_rows($res)>0){

   
$sno=1;
 
 while ($row = mysqli_fetch_assoc($res)) {
    
$tbl .= '<tr>
<td> '.$sno++.'</td>
<td>'.$row['id'].'</td>
<td>'.$row['name'].'</td>
<td>'.$row['email'].'</td>
<td><button onclick="getUserDetails('.$row['id'].')" class="btn btn-warning">Edit_Data</button></td>
<td><button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete_data</button></td></tr>';

 }
 $tbl .= '</table>';
 echo $tbl;
    }
   
}





if(isset($_POST['id'])){
    $userid = $_POST['id'];

    $delete = "DELETE FROM staff where id = '{$userid}'";


    mysqli_query($conn,$delete);
}



if (isset($_POST['name']) && isset($_POST['email'])) {
    
    $query = "INSERT INTO staff(`name`,email) values('$name','$email')";

    $res = mysqli_query($conn,$query);
}


// update code for 

if (isset($_POST['eid']) && isset($_POST['eid']) != "") {
    
    $editid = $_POST['eid'];

    $query = "SELECT * FROM staff where id = {$editid}";

    if (!$result = mysqli_query($conn,$query)) {
        exit();

    }
    $response = array();

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
        $response = $row;
    }
}

else{
    $response['status'] = 200;
    $response['Message'] = "Data not found";
}
echo json_encode($response);
}
else{
    $response['status'] = 200;
    $response['Message'] = "Invalid request";

}

// update table record code 


if(isset($_POST['hidden_id'])){

    $eid = $_POST['hidden_id'];
    $edit_name = $_POST['edit_name'];
    $edit_email = $_POST['edit_email'];

    $query = "UPDATE staff set `name` = '{$edit_name}', `email` = '{$edit_email}' where id =  {$eid}"; 
    mysqli_query($conn,$query);
}


?>