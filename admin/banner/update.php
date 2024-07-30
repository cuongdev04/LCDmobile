<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập nhật banner</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="?act=updatebanner" method="post" enctype="multipart/form-data" class="form">
                <input type="hidden" name="idbanner" value="<?= $idbanner ?>">
                <input type="hidden" name="oldImage" value="<?= $oldImage ?>">
                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh :</label>
                    <input type="file" name="image" id="image" class="form-control-file border">
                    <p class="Err mt-1"><?= $imageErr ?></p>
                    <img src="../uploads/banner/<?= $oldImage ?>" alt="" height="100px">
                </div>
                <div class="mb-3">
                    <label for="sel1">Sản phẩm</label>
                    <select class="form-control" id="sel1" name="idsanpham">
                        <?php
                        foreach ($listsp as $sp) {
                            extract($sp);
                            echo '<option ' . ($idsanpham ? ($idsanpham == $id ? 'selected' : '') : '') . ' value="' . $id . '">' . $id . ' - ' . $tensp . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                    <a href="?act=qlbanner"><button type="button" class="btn btn-success">Quay lại</button></a>
                </div>
            </form>
        </div>
    </div>

</div>