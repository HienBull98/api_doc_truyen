<?php
function addComic(){
    global $objConn;

    $ten_truyen = $_POST['ten_truyen'];
    $tac_gia = $_POST['tac_gia'];
    $nam_xb = $_POST['nam_xb'];
    $anh_bia = $_POST['anh_bia'];
    if(empty ($ten_truyen) ){
        $dataRes =[
            'status'=>0,
            'msg'=> 'Chưa nhập ten truyen'
        ];

    }else{

        try {

            $stmt =  $objConn->prepare(
                "INSERT INTO tb_truyen (ten_truyen,tac_gia,nam_xb,anh_bia) VALUES (:ten_truyen,:tac_gia,:nam_xb,:anh_bia);");

            // gán tham số cho câu lệnh
            $stmt->bindParam(":ten_truyen", $ten_truyen );
            $stmt->bindParam(":tac_gia", $tac_gia );
            $stmt->bindParam(":nam_xb", $nam_xb );
            $stmt->bindParam(":anh_bia", $anh_bia );

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
    addComic();
}

