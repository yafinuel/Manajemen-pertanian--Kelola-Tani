<?php

class ShowData{
    private $query;
    
    function __construct($conn, $sessionUser){
        $this->conn = $conn;
        $this->sessionUser = $sessionUser;
    }

    function showDataFarmer(){
        $query = "SELECT * FROM farmers where id_user = $this->sessionUser";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)){
                $id = $row['id_farmer'];
                $delText = "Yakin ingin menghapus data ini?";
                echo "<tr>
                        <td>".$no++."</td>
                        <td>
                            <div class='d-flex align-items-center'>
                                <div class='ms-2'>
                                    <div>".$row['name_farmer']."</div>
                                </div>
                            </div>
                        </td>
                        <td><span class='badge bg-secondary'>".$row['birthday_farmer']."</span></td>
                        <td><span class='badge bg-info text-dark'>".$row['role_farmer']."</span></td>
                        <td class='text-success'> Rp".$row['wage_farmer']."</td>
                        <td>
                            <a href='editFarmer.php?id=$id'>
                                <button class='btn btn-warning btn-sm'>Edit</button>
                            </a>
                            <a href='delFarmer.php?id=$id'>
                                <button class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus data ".$row['name_farmer']."?')\">Delete</button>
                            </a>
                        </td>
                    </tr>";
            }
        } else {
            echo "
                <tr>
                    <td colspan='6' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
    }

    function showDataFarms(){
        $query = "SELECT * FROM farms where id_user = $this->sessionUser";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0){
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)){
                $id = $row['id_farm'];
                echo "
                <div class='list-group-item d-flex align-items-center p-3'>
                    <div class='me-3'>
                        <span class='badge bg-secondary'>".$no++."</span>
                    </div>
                    <div class='flex-grow-1'>
                        <h6 class='mb-1'>".$row['name_farm']."</h6>
                        <small class='text-muted'>".$row['type_farm']."</small> • <small class='text-muted'>".$row['area_farm']." m<sup>2</sup></small>
                    </div>
                    <div class='me-4'>
                        <h6 class='mb-1'>Action</h6>
                        <small class='text-muted'><a href='editFarm.php?id=$id' class='text-primary'>Edit</a> • <a href='delFarm.php?id=$id' class='text-danger' onclick=\"return confirm('Yakin ingin menghapus data ".$row['name_farm']."?')\">Delete</a></small>
                    </div>
                </div>
                ";
            }
        } else {
            echo "
                <div class='list-group-item d-flex align-items-center p-3 justify-content-center'>
                    <p class='text-center'>Tidak ada data</p>
                </div>
            ";
        }
    }

    function showDataWerehouse(){
        $query = "SELECT s.id_storage, c.name_crop, s.volume_storage
                FROM storages s, crops c
                WHERE s.id_crop = c.id_crop and s.id_user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->sessionUser);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0 ){
            $no = 1;
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id_storage'];
                echo "
                <div class='row border rounded p-3 mb-2'>
                <div class='col-1 text-center'>
                    <span class='badge bg-secondary'>".$no++."</span>
                </div>
                <div class='col-4'>
                    <h6 class='mb-0'>".$row['name_crop']."</h6>
                </div>
                <div class='col-3 text-center'>
                    <p>".$row['volume_storage']." Kg</p>
                </div>
                <div class='col-4 text-center'>
                    <a href='editItem.php?id=$id' class='text-primary me-2'>edit</a> • 
                    <a href='delItem.php?id=$id' class='text-danger ms-2' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">delete</a>
                </div>
            </div>
                ";
            }
        }
    }
    function showActiveFarmers(){
        $query = "SELECT id_aw, date_aw, name_farm, name_farmer, role_farmer
                    FROM aw_view";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0 ){
            $no = 1;
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id_aw'];
                echo "
                <tr>
                    <th scope='row'>".$no++."</th>
                    <td>".$row['date_aw']."</td>
                    <td>".$row['name_farm']."</td>
                    <td>".$row['name_farmer']."</td>
                    <td>".$row['role_farmer']."</td>
                    <td><a href='editAw.php?id=$id' class='text-primary'>Edit</a> | <a href='delAw.php?id=$id' class='text-danger' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Delete</a></td>
                </tr>";
            }
        } else {
            echo "
                <tr>
                    <td colspan='6' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
    }

    function showDataWorkingNow(){
        $query = "SELECT id_planting, date_planting, name_farm, name_crop, id_user, total_workers 
                FROM fp_view
                WHERE id_user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s",$this->sessionUser);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0 ){
            $no = 1;
            while($row = mysqli_fetch_assoc($result)){
                echo "
                <tr>
                <th scope='row'>".$no++."</th>
                <td>".$row['date_planting']."</td>
                <td>".$row['name_farm']."</td>
                <td>".$row['name_crop']."</td>
                <td class='text-center'><a href=''>".$row['total_workers']."</a></td>
                <td><a href='selesaiWn.php?id=".$row['id_planting']."' class='text-primary'>Selesai</a> | <a href='delWn.php?id=".$row['id_planting']."' class='text-danger'>Hapus</a></td>
                </tr>
                ";
            }
        } else {
            echo "
                <tr>
                    <td colspan='6' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
    }

    function showDataPlanting(){
        $query = "SELECT fp.id_planting, fp.date_planting, f.name_farm, c.name_crop
                FROM farm_planting fp, farms f, crops c
                WHERE fp.id_user = ? and fp.id_farm = f.id_farm and fp.id_crop = c.id_crop";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i",$this->sessionUser);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0 ){
            $no = 1;
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id_planting'];
                echo "
                <tr>
                <th scope='row'>".$no++."</th>
                <td>".$row['date_planting']."</td>
                <td>".$row['name_farm']."</td>
                <td>".$row['name_crop']."</td>
                <td><a href='editFp.php?id=$id' class='text-primary'>Edit</a> | <a href='delFp.php?id=$id' class='text-danger' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Delete</a></td>
                </tr>
                ";
            }
        } else {
            echo "
                <tr>
                    <td colspan='6' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
    }

    function showDataStock(){
        $query = "SELECT f.id_flow, f.date_flow, c.name_crop, f.in_flow, f.out_flow, f.id_user
                FROM storage_flows f, crops c
                WHERE f.id_crop = c.id_crop and f.id_user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->sessionUser);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0 ){
            $no = 1;
            while($row = mysqli_fetch_assoc($result)){
                echo
                "<tr>
                    <th scope='row'>".$no++."</th>
                    <td>".$row['date_flow']."</td>
                    <td>".$row['name_crop']."</td>
                    <td>".$row['in_flow']." Kg</td>
                    <td>".$row['out_flow']." Kg</td>
                    <td><a href='editStock.php?id=".$row['id_flow']."' class='text-primary'>edit</a> | <a href='delStock.php?id=".$row['id_flow']."' class='text-danger'>delete</a></td>
                </tr>";
            }
        } else {
            echo "
                <tr>
                    <td colspan='6' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
    }

    function showDataCrops(){
        $query = "SELECT id_crop, name_crop
                FROM crops
                WHERE id_user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->sessionUser);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0 ){
            $no = 1;
            while($row = mysqli_fetch_assoc($result)){
                echo
                "
                <tr>
                    <td class='col-no'>".$no++."</td>
                    <td>".$row['name_crop']."</td>
                    <td class='col-no pe-5'><a href='editTanaman.php?id=".$row['id_crop']."' class='text-primary'>edit</a> | <a href='delTanaman.php?id=".$row['id_crop']."' class='text-danger'>delete</a></td>
                </tr>
                ";
            }
        } else {
            echo "
                <tr>
                    <td colspan='3' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
    }
}

?>