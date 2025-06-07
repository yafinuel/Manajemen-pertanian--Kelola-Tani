<?php

class ShowData{
    private $query;
    
    function __construct($conn, $session){
        $this->conn = $conn;
        $this->session = $session;
    }

    function showDataFarmer(){
        $query = "SELECT * FROM farmers where id_user = $this->session";
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
        $query = "SELECT * FROM farms where id_user = $this->session";
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
                        <small class='text-muted'><a href='editFarm.php?id=$id'>edit</a> • <a href='delFarm.php?id=$id' class='text-danger' onclick=\"return confirm('Yakin ingin menghapus data ".$row['name_farm']."?')\">delete</a></small>
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
        $query = "SELECT s.id_storage, c.name_commodity, s.volume_storage
                FROM storages AS s, commodities AS c
                WHERE s.id_commodity = c.id_commodity";
        $stmt = $this->conn->prepare($query);
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
                    <h6 class='mb-0'>".$row['name_commodity']."</h6>
                </div>
                <div class='col-3 text-center'>
                    <p>".$row['volume_storage']." Kg</p>
                </div>
                <div class='col-4 text-center'>
                    <a href='editWH.php?id=$id' class='text-primary me-2'>edit</a> • 
                    <a href='delWH.php?id=$id' class='text-danger ms-2' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">delete</a>
                </div>
            </div>
                ";
            }
        }
    }
    function showActiveFarmers(){
        $query = "SELECT aw.id_aw, aw.date_aw, f.name_farm, w.name_farmer, w.role_farmer 
                    FROM active_workers aw, farms f, farmers w
                    WHERE aw.delegate_aw = f.id_farm and w.id_farmer = aw.name_aw";
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
                    <td><a href='#' class='text-primary'>edit</a> | <a href='#' class='text-danger' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">delete</a></td>
                </tr>";
            }
        }
    }
}

?>