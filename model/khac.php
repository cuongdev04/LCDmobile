<?php
function insert_tintuc($image,$ngaydang,$tieude,$noidung,$idtaikhoan){
    $query="INSERT INTO `tintuc`(`image`,`ngaydang`, `tieude`, `noidung`, `idtaikhoan`) VALUES ('$image','$ngaydang','$tieude','$noidung','$idtaikhoan')";
    pdo_execute($query);
}
function load_tintuc_home(){
    $query="SELECT tintuc.id as idtt, tintuc.image, tintuc.ngaydang, tintuc.tieude, tintuc.noidung, tintuc.idtaikhoan ,
    taikhoan.* FROM tintuc INNER JOIN taikhoan ON tintuc.idtaikhoan=taikhoan.id ORDER BY tintuc.id desc limit 0,6";
    return pdo_query($query);
}
function load_tintuc_home2(){
    $query="SELECT tintuc.id as idtt, tintuc.image, tintuc.ngaydang, tintuc.tieude, tintuc.noidung, tintuc.idtaikhoan ,
    taikhoan.* FROM tintuc INNER JOIN taikhoan ON tintuc.idtaikhoan=taikhoan.id ORDER BY tintuc.id desc limit 0,3";
    return pdo_query($query);
}
function load_tintuc($kyw){
    $query="SELECT tintuc.id as idtt, tintuc.image, tintuc.ngaydang, tintuc.tieude, tintuc.noidung, tintuc.idtaikhoan ,
    taikhoan.* FROM tintuc INNER JOIN taikhoan ON tintuc.idtaikhoan=taikhoan.id WHERE 1";
    if($kyw != ''){
        $query .=" AND (taikhoan.tendangnhap LIKE '%" . $kyw . "%' OR tintuc.ngaydang LIKE '%" . $kyw . "%' OR tintuc.tieude LIKE '%" . $kyw . "%')";
    }
    $query .=" ORDER BY tintuc.id desc";
    return pdo_query($query);
}
function load_one_tintuc($id){
    $query="SELECT tintuc.id as idtt, tintuc.image, tintuc.ngaydang, tintuc.tieude, tintuc.noidung, tintuc.idtaikhoan ,
    taikhoan.* FROM tintuc INNER JOIN taikhoan ON tintuc.idtaikhoan=taikhoan.id WHERE tintuc.id='$id'";
    return pdo_query_one($query);
}
function update_tintuc($id,$image,$oldImage,$tieude,$noidung){
    $conn=pdo_get_connection();
    $query="UPDATE `tintuc` SET id=:id, `image`=:image,`tieude`=:tieude,`noidung`=:noidung WHERE `id`=:id";
    $state=$conn->prepare($query);
    $state->execute([
        ':id'=>$id,
        ':image'=>($image?$image:$oldImage),
        ':tieude'=>$tieude,
        ':noidung'=>$noidung
    ]);
}
function delete_tintuc($id){
    $query="DELETE FROM tintuc WHERE id='$id'";
    pdo_execute($query);
}
function load_all_banner($kyw){
    $query="SELECT banner.id as idbanner, banner.idsanpham, banner.image as imagebanner, banner.ngaydang,
    sanpham.* FROM banner INNER JOIN sanpham ON sanpham.id=banner.idsanpham";
    if($kyw != ''){
        $query .=" AND banner.idsanpham LIKE '%" . $kyw . "%'";
    }
    $query .=" ORDER BY banner.id desc";
    return pdo_query($query);
}
function delete_banner($id){
    $query="DELETE FROM banner WHERE id='$id'";
    pdo_execute($query);
}
function insert_banner($idsanpham,$image,$ngaydang){
    $conn=pdo_get_connection();
    $query_check = "SELECT COUNT(*) as count FROM banner WHERE idsanpham = :idsanpham";
    $stmt = $conn->prepare($query_check);
    $stmt->execute([':idsanpham'=> $idsanpham]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['count'] > 0) {
        echo '<script>
                alert("Banner thuộc sản phẩm này đã tồn tại !");
                window.location.href="?act=addbanner";
            </script>';
    } else {
        $query="INSERT INTO `banner`(`idsanpham`, `image`, `ngaydang`) VALUES ('$idsanpham','$image','$ngaydang')";
        pdo_execute($query);
        echo '<script>
                    alert("Bạn đã thêm thành công !");
                    window.location.href="?act=qlbanner";
                </script>';
    }
}
function load_one_banner($id){
    $query="SELECT banner.id as idbanner, banner.idsanpham, banner.image as imagebanner, banner.ngaydang,
    sanpham.* FROM banner INNER JOIN sanpham ON sanpham.id=banner.idsanpham WHERE banner.id='$id'";
    return pdo_query_one($query);
}
function update_banner($id,$image,$oldImage,$idsanpham){
    $conn=pdo_get_connection();
    $query="UPDATE banner SET idsanpham=:idsanpham,image=:image WHERE id=:id";
    $state=$conn->prepare($query);
    $state->execute([
        ':id'=>$id,
        ':idsanpham'=>$idsanpham,
        ':image'=>($image?$image:$oldImage)
    ]);
}
function load_banner_home(){
    $query="SELECT banner.id as idbanner, banner.idsanpham, banner.image as imagebanner, banner.ngaydang,
    sanpham.* FROM banner INNER JOIN sanpham ON sanpham.id=banner.idsanpham ORDER BY banner.id desc limit 0,4";
    return pdo_query($query);
}
function insert_lienhe($hovatenlh,$emaillh,$sodienthoailh,$noidunglh,$ngaygui){
    $query="INSERT INTO `lienhe`( `hovaten`, `email`, `sodienthoai`, `noidung`, `ngaygui`) VALUES ('$hovatenlh','$emaillh','$sodienthoailh','$noidunglh','$ngaygui')";
    pdo_execute($query);
}
?>