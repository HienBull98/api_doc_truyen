<?php
function addComment(){
    global $objConn;

    $id_truyen = $_POST['id_truyen'];
    $id_user = $_POST['id_user'];
    $noi_dung = $_POST['noi_dung'];
    $ngay_gio = date('Y-m-d H:i:s');
    if(empty ($id_user) ){
        $dataRes =[
            'status'=>0,
            'msg'=> 'Chưa có id user'
        ];

    }else if(empty ($id_truyen) ){
        $dataRes =[
            'status'=>0,
            'msg'=> 'Chưa có id truyen'
        ];

    }
    else{
        try {

            $stmt =  $objConn->prepare(
                "INSERT INTO tb_binh_luan (id_truyen,id_user,noi_dung,ngay_gio) VALUES (:id_truyen,:id_user,:noi_dung,:ngay_gio);");

            // gán tham số cho câu lệnh
            $stmt->bindParam(":id_truyen", $id_truyen );
            $stmt->bindParam(":id_user",$id_user);
            $stmt->bindParam(":noi_dung", $noi_dung );
            $stmt->bindParam(":ngay_gio", $ngay_gio );

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
    addComment();
}
