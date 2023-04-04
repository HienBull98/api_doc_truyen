<?php
function addUser(){
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
                "INSERT INTO tb_user (username,passwd,email,fullname) VALUES (:username,:passwd,:email,:fullname);");

            // gán tham số cho câu lệnh
            $stmt->bindParam(":username", $username );
            $stmt->bindParam(":passwd", $passwd );
            $stmt->bindParam(":email", $email );
            $stmt->bindParam(":fullname", $fullname );

            // thực thi
            $stmt->execute();

            $dataRes =[
                'status'=>1,
                'msg'=>  'Đã thêm thành công'
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
if ($method == "POST"){
    addUser();
}
