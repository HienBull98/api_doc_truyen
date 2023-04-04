<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET"){
    if (empty($_GET['id'])){
        global $objConn;
        try {
            $sql_str = "SELECT * FROM `tb_img_content`";

            $stmt = $objConn->prepare(  $sql_str );

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);


            $danh_sach = $stmt->fetchAll();

            $dataRes = [
                'status'=> 1,
                'msg'=> 'Thành công',
                'data'=> $danh_sach
            ];

            die(   json_encode($dataRes) );

        } catch (Exception $e) {
            die( 'Lỗi thực hiện truy vấn CSLD ' . $e->getMessage()  );
        }

    }
}
