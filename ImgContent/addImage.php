<?php
function addImage(){
    global $objConn;

    $link_anh = $_POST['link_anh'];
    $id_truyen = $_POST['id_truyen'];

    if(empty ($link_anh) ){
        $dataRes =[
            'status'=>0,
            'msg'=> 'Chưa nhập link anh'
        ];

    }else{
        try {

            $stmt =  $objConn->prepare(
                "INSERT INTO tb_img_content (link_anh,id_truyen) VALUES (:link_anh,:id_truyen);");

            // gán tham số cho câu lệnh
            $stmt->bindParam(":link_anh", $link_anh );
            $stmt->bindParam(":id_truyen", $id_truyen );


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
    addImage();
}
