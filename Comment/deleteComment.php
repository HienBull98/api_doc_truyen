<?php
function deleteComment($id){
    global $objConn;

    try {
        $sql_str = "DELETE FROM `tb_binh_luan` WHERE id=$id";

        $stmt = $objConn->prepare(  $sql_str );

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        $danh_sach = $stmt->fetchAll();

        $dataRes = [
            'status'=> 1,
            'msg'=> 'Xóa thành công',
            // 'data'=> $danh_sach
        ];

        die(   json_encode($dataRes) );

    } catch (Exception $e) {
        die( 'Lỗi thực hiện truy vấn CSLD ' . $e->getMessage()  );
    }
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "DELETE"){
    if (isset($_GET['id'])){
        deleteComment($_GET['id']);
    }
}