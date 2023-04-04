<?php
//error_reporting(0);
function updateUser($id){
    global $objConn;

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    if(empty ($username) ){
        $dataRes =[
            'status'=>0,
            'msg'=> 'Chưa nhập Username'
        ];

    }else{
        // đã nhập username rồi ==> lưu vào CSDL
        try {

            $stmt =  $objConn->prepare(
                "UPDATE tb_user SET (username=:username,passwd=:passwd,email=:email,fullname=:fullname) WHERE id =$id");

            // gán tham số cho câu lệnh
            $stmt->bindParam(":username", $username );
            $stmt->bindParam(":passwd", $passwd );
            $stmt->bindParam(":email", $email );
            $stmt->bindParam(":fullname", $fullname );

            // thực thi
            $stmt->execute();

            $dataRes =[
                'status'=>1,
                'msg'=>  'Đã sửa thành công'
            ];

        } catch (PDOException $e) {

            $dataRes =[
                'status'=>0,
                'msg'=> 'Lỗi '. $e->getMessage()
            ];
        }
    }

    die(json_encode ($dataRes ));
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "PUT"){
    if (isset($_GET['id'])){
        updateUser($_GET['id']);
    }
}
