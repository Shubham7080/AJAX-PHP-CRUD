<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <div class="container">
        <div class="head  py-5">
            <h1 class="text-primary text-center ">Crud Operation With PHP</h1>
        </div>


        <div class="container d-flex ">
            <div class="row col-sm-8 justify-content-left fw-bold text-danger">
                <h1 class="text-danger">Record Table</h1>
            </div>
            <div class=" row container col-sm-4  justify-content-right">
                <button type="button" class="btn btn-warning text-dark " data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Insert Record
                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Insert Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                                </div>



                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" onclick="addRecord()" class="btn btn-success">Save changes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- update modal start here  -->

        <div class="modal fade" id="update_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- modal body  -->
                        <div class="modal-body">
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Upadte Name</label>
                                    <input type="text" class="form-control" id="update_name" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Update Email address</label>
                                    <input type="email" class="form-control" id="update_email" aria-describedby="emailHelp">
                                </div>



                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="update_record()" class="btn btn-success">Update changes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <input type="hidden" name="" id="hidden_id">
                        </div>
                    </div>
                </div>
            </div>

        <!-- update modal  end here-->
    </div>

<div class="container py-5">

<div id="tbl_records" >

</div>
</div>

</body>

<script src="jq/jquery.js"></script>

<script>
$(document).ready(function(){

        readRecords();
})

    function readRecords(){
        var readRecords = "readRecords";

        $.ajax({
            url:"backend.php",
            type:"POST",
            data:{readRecords:readRecords},
            success:function(data,status){
                $("#tbl_records").html(data);
            }
        })
    }

    function addRecord() {
        var name = $("#name").val();
        var email = $("#email").val();
        $.ajax({
            url: "backend.php",
            type: "POST",
            data: {
                name: name,
                email: email
            },
            success: function(data, status) {
                var name = $("#name").val("");
                var email = $("#email").val("");
                $("#exampleModal").modal("hide");
                readRecords();

            }
        })
    }
    function DeleteUser(id){
        var conf = confirm("are you sure");

        if(conf==true){
            $.ajax({
                url:"backend.php",
                type:"POST",
                data:{id:id},
                success:function(data,status){
                    readRecords();

                }
            })
        }
    }

    function getUserDetails(eid){

            $("#hidden_id").val();
            $.post("backend.php",{
                eid:eid}
            ,function(data,status){
                    var user = JSON.parse(data);
                    $("#update_name").val(user.name);
                    $("#hidden_id").val(user.id);
                    $("#update_email").val(user.email);
            });
            $("#update_user_modal").modal("show");
    }

function update_record(){
    var edit_name = $("#update_name").val();
    var edit_email = $("#update_email").val();
    var hidden_id = $("#hidden_id").val();


    $.post("backend.php",{
        hidden_id:hidden_id,
        edit_name:edit_name,
        edit_email:edit_email
    },
    function(data,status){
        $("#update_user_modal").modal("hide")
        readRecords();
    });
}
</script>

<script src="js/bootstrap.js"></script>

</html>