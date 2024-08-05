<?php
ob_start();
session_start();
include "../../model/pdo.php";
include "../../model/sanpham.php";
include "../../model/taikhoan.php";
include "../../model/donhang.php";

if (isset($_SESSION['user'])) {
    $listgh = load_all_giohang($_SESSION['user']['id']);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idsanpham = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $giasp = isset($_POST['giasp']) ? floatval($_POST['giasp']) : 0;
        $soluong = isset($_POST['qtybutton']) ? intval($_POST['qtybutton']) : 1; // Nhận giá trị số lượng từ POST

        if ($idsanpham > 0 && $giasp > 0) {
            $thanhtien = $giasp * $soluong;
            $check = true;

            foreach ($listgh as &$giohang) {
                if ($idsanpham == $giohang['idsanpham']) {
                    $giohang['soluong'] += $soluong;
                    $giohang['thanhtien'] = $giasp * $giohang['soluong'];
                    update_giohang($giohang['soluong'], $giohang['thanhtien'], $giohang['idsanpham']);
                    $check = false;
                    break;
                }
            }
            unset($giohang);

            if ($check) {
                insert_cart($_SESSION['user']['id'], $idsanpham, $soluong, $thanhtien);
            }
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($listgh);
}
?>
