<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET"){
    if (empty($_GET['id'])){
        global $objConn;
        try {
            $sql_str = "SELECT * FROM `tb_truyen`";
            // tạo đối tượng prepare chuẩn bị cho cú pháp thực thi truy vấn
            $stmt = $objConn->prepare(  $sql_str );
            // thực thi câu lệnh
            $stmt->execute();
            //thiết lập chế độ lấy dữ liệu
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // lấy dữ liệu:
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
