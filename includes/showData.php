<?php

class ShowData{
    private $query;
    
    function __construct($conn, $sessionUser){
        $this->conn = $conn;
        $this->sessionUser = $sessionUser;
        $this->limit = 5;
        $this->page1 = isset($_GET['page1']) ? (int)$_GET['page1'] : 1;
        $this->page2 = isset($_GET['page2']) ? (int)$_GET['page2'] : 1;
        $this->offset1 = ($this->page1 - 1) * $this->limit;
        $this->offset2 = ($this->page2 - 1) * $this->limit;
    }

    function showDataFarmer($search){
        $searchQuery = '';
        if (!empty($search)){
            $safeSearch = $this->conn->real_escape_string($search);
            $searchQuery = "AND (name_farmer LIKE '%$search%' OR role_farmer LIKE '%$search%')";
        }
        $countQuery = "SELECT COUNT(*) as total FROM farmers WHERE id_user = $this->sessionUser $searchQuery";
        $countResult = mysqli_query($this->conn, $countQuery);
        $totalData = mysqli_fetch_assoc($countResult)['total']; 
        $totalPages = ceil($totalData / $this->limit); 

        $query = "SELECT * FROM farmers WHERE id_user = $this->sessionUser $searchQuery ORDER BY id_farmer DESC LIMIT $this->limit OFFSET $this->offset1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $text = "";
        if($result->num_rows > 0) {
            $no =  ($this->page1 - 1) * $this->limit + 1;
            while ($row = mysqli_fetch_assoc($result)){
                $id = $row['id_farmer'];
                $delText = "Yakin ingin menghapus data ini?";
                $text .= "<tr>
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
            $text .=  "
                <tr>
                    <td colspan='6' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }

        return [
            'totalPages' => $totalPages,
            'currentPage' => $this->page1,
            'textHTML' => $text,
        ];
    }
    
    function showActiveFarmers($search){
        $searchQuery = '';
        if (!empty($search)){
            $safeSearch = $this->conn->real_escape_string($search);
            $searchQuery = "AND (date_aw LIKE '%$search%' OR name_farmer LIKE '%$search%' OR role_farmer LIKE '%$search%' OR name_farm like'%$search%')";
        }
        $countQuery = "SELECT COUNT(*) as total FROM aw_view WHERE id_user = $this->sessionUser $searchQuery";
        $countResult = mysqli_query($this->conn, $countQuery);
        $totalData = mysqli_fetch_assoc($countResult)['total']; 
        $totalPages = ceil($totalData / $this->limit); 

        $query = "SELECT id_aw, date_aw, name_farm, name_farmer, role_farmer
                    FROM aw_view 
                    WHERE id_user = $this->sessionUser $searchQuery
                    ORDER BY id_aw DESC LIMIT $this->limit OFFSET $this->offset2";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $text = "";

        if ($result->num_rows > 0 ){
            $no = ($this->page2 - 1) * $this->limit + 1;
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id_aw'];
                $text .= "
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
             $text .=  "
                <tr>
                    <td colspan='6' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
        return [
            'totalPages' => $totalPages,
            'currentPage' => $this->page2,
            'textHTML' => $text,
        ];
    }

    function showDataFarms($search){
        $searchQuery = '';
        if (!empty($search)){
            $safeSearch = $this->conn->real_escape_string($search);
            $searchQuery = "AND (name_farm LIKE '%$search%')";
        }
        $countQuery = "SELECT COUNT(*) as total FROM farms WHERE id_user = $this->sessionUser $searchQuery";
        $countResult = mysqli_query($this->conn, $countQuery);
        $totalData = mysqli_fetch_assoc($countResult)['total']; 
        $totalPages = ceil($totalData / $this->limit); 

        $query = "SELECT * FROM farms WHERE id_user = $this->sessionUser $searchQuery ORDER BY id_farm DESC LIMIT $this->limit OFFSET $this->offset1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $text = "";

        if ($result->num_rows > 0){
            $no = ($this->page1 - 1) * $this->limit + 1;
            while ($row = mysqli_fetch_assoc($result)){
                $id = $row['id_farm'];
                $text .= "
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
            $text .= "
                <div class='list-group-item d-flex align-items-center p-3 justify-content-center'>
                    <p class='text-center'>Tidak ada data</p>
                </div>
            ";
        }
        
        return [
            'totalPages' => $totalPages,
            'currentPage' => $this->page1,
            'textHTML' => $text
        ];
    }
    
    function showDataPlanting($search){
        $searchQuery = '';
        if (!empty($search)){
            $safeSearch = $this->conn->real_escape_string($search);
            $searchQuery = "AND (date_planting LIKE '%$search%' OR name_farm LIKE '%$search%' OR name_crop LIKE '%$search%')";
        }
        $countQuery = "SELECT COUNT(*) as total FROM planting_view WHERE id_user = $this->sessionUser $searchQuery";
        $countResult = mysqli_query($this->conn, $countQuery);
        $totalData = mysqli_fetch_assoc($countResult)['total']; 
        $totalPages = ceil($totalData / $this->limit); 

        $query = "SELECT id_planting, date_planting, name_farm, name_crop
                    FROM planting_view
                    WHERE id_user = $this->sessionUser $searchQuery
                    ORDER BY id_planting ASC LIMIT $this->limit OFFSET $this->offset2";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $text = "";

        if ($result->num_rows > 0 ){
            $no = ($this->page2 - 1) * $this->limit + 1;
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id_planting'];
                $text .= "
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
            $text .= "
                <tr>
                    <td colspan='6' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
        return [
            'totalPages' => $totalPages,
            'currentPage' => $this->page2,
            'textHTML' => $text
        ];
    }

    function showDataWerehouse($search){
        $searchQuery = '';
        if (!empty($search)){
            $safeSearch = $this->conn->real_escape_string($search);
            $searchQuery = "AND (c.name_crop LIKE '%$search%')";
        }
        $countQuery = "SELECT COUNT(*) as total 
                        FROM storages s, crops c 
                        WHERE  s.id_crop = c.id_crop and s.id_user = $this->sessionUser $searchQuery";
        $countResult = mysqli_query($this->conn, $countQuery);
        $totalData = mysqli_fetch_assoc($countResult)['total']; 
        $totalPages = ceil($totalData / $this->limit); 

        $query = "SELECT s.id_storage, c.name_crop, s.volume_storage
                    FROM storages s, crops c
                    WHERE  s.id_crop = c.id_crop and s.id_user = $this->sessionUser $searchQuery
                    ORDER BY s.id_storage ASC LIMIT $this->limit OFFSET $this->offset1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $text = "";

        if ($result->num_rows > 0 ){
            $no = ($this->page1 - 1) * $this->limit + 1;
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id_storage'];
                $text .= "
                <div class='row border rounded p-3 mb-2 justify-content-between pe-5'>
                <div class='col-1 text-center'>
                    <span class='badge bg-secondary'>".$no++."</span>
                </div>
                <div class='col-1'>
                    <h6 class='mb-0'>".$row['name_crop']."</h6>
                </div>
                <div class='col-1 text-center '>
                    <p>".$row['volume_storage']." Kg</p>
                </div>
                
            </div>
                ";
            }
            // <div class='col-4 text-center'>
            //         <a href='editItem.php?id=$id' class='text-primary me-2'>edit</a> • 
            //         <a href='delItem.php?id=$id' class='text-danger ms-2' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">delete</a>
            //     </div>
        } else {
            // This block runs if there are no rows in the result
            $text .= "
            <div class='alert text-center' role='alert'>
                Belum ada data penyimpanan tersedia.
            </div>
            ";
        }
        return [
            'totalPages' => $totalPages,
            'currentPage' => $this->page1,
            'textHTML' => $text
        ];
    }

    function showDataStock($search){
        $searchQuery = '';
        if (!empty($search)){
            $safeSearch = $this->conn->real_escape_string($search);
            $searchQuery = "AND (f.date_flow LIKE '%$search%' OR c.name_crop LIKE '%$search%')";
        }
        $countQuery = "SELECT COUNT(*) as total FROM storage_flows f, crops c WHERE f.id_crop = c.id_crop and f.id_user = $this->sessionUser $searchQuery";
        $countResult = mysqli_query($this->conn, $countQuery);
        $totalData = mysqli_fetch_assoc($countResult)['total']; 
        $totalPages = ceil($totalData / $this->limit); 

        $query = "SELECT f.id_flow, f.date_flow, c.name_crop, f.in_flow, f.out_flow, f.id_user
                    FROM storage_flows f, crops c
                    WHERE f.id_crop = c.id_crop and f.id_user = $this->sessionUser $searchQuery
                    ORDER BY f.id_flow ASC LIMIT $this->limit OFFSET $this->offset2";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $text = "";

        if ($result->num_rows > 0 ){
            $no = ($this->page2 - 1) * $this->limit + 1;
            while($row = mysqli_fetch_assoc($result)){
                $text .= 
                "<tr>
                    <th scope='row'>".$no++."</th>
                    <td>".$row['date_flow']."</td>
                    <td>".$row['name_crop']."</td>
                    <td>".$row['in_flow']." Kg</td>
                    <td>".$row['out_flow']." Kg</td>
                    <td><a href='editStock.php?id=".$row['id_flow']."' class='text-primary'>edit</a> | <a href='delStock.php?id=".$row['id_flow']."' class='text-danger' onclick=\"return confirm('yakin ingin menghapus data ini?')\">delete</a></td>
                </tr>";
            }
        } else {
            $text .= "
                <tr>
                    <td colspan='6' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
        return [
            'totalPages' => $totalPages,
            'currentPage' => $this->page2,
            'textHTML' => $text
        ];
    }

    function showDataWorkingNow($search){
        $searchQuery = '';
        if (!empty($search)){
            $safeSearch = $this->conn->real_escape_string($search);
            $searchQuery = "AND (date_planting LIKE '%$search%' OR name_crop LIKE '%$search%' OR name_farm LIKE '%$search%' OR total_workers LIKE '%$search%')";
        }
        $countQuery = "SELECT COUNT(*) as total FROM fp_view WHERE id_user = $this->sessionUser $searchQuery";
        $countResult = mysqli_query($this->conn, $countQuery);
        $totalData = mysqli_fetch_assoc($countResult)['total']; 
        $totalPages = ceil($totalData / $this->limit); 

        $query = "SELECT id_planting, date_planting, name_farm, name_crop, id_user, total_workers 
                    FROM fp_view
                    WHERE id_user = $this->sessionUser $searchQuery
                    ORDER BY id_planting ASC LIMIT $this->limit OFFSET $this->offset1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $text = "";

            if ($result->num_rows > 0 ){
                $no = ($this->page1 - 1) * $this->limit + 1;
                while($row = mysqli_fetch_assoc($result)){
                    $text .= "
                    <tr>
                    <th scope='row'>".$no++."</th>
                    <td>".$row['date_planting']."</td>
                    <td>".$row['name_farm']."</td>
                    <td>".$row['name_crop']."</td>
                    <td class='text-center'><a href=''>".$row['total_workers']."</a></td>
                    <td><a href='selesaiWn.php?id=".$row['id_planting']."' class='text-primary'>Selesai</a> | <a href='delWn.php?id=".$row['id_planting']."' class='text-danger' onclick=\"return confirm('yakin ingin menghapus data ini?')\">Hapus</a></td>
                    </tr>
                    ";
                }
            } else {
                $text .= "
                    <tr>
                        <td colspan='6' class='text-center'>Tidak ada data</td>
                    </tr>
                ";
            }
            return [
                'totalPages' => $totalPages,
                'currentPage' => $this->page1,
                'textHTML' => $text
            ];
    }

    function showDataCrops($search){
        $searchQuery = '';
        if (!empty($search)){
            $safeSearch = $this->conn->real_escape_string($search);
            $searchQuery = "AND (name_crop LIKE '%$search%')";
        }
        $countQuery = "SELECT COUNT(*) as total FROM crops WHERE id_user = $this->sessionUser $searchQuery";
        $countResult = mysqli_query($this->conn, $countQuery);
        $totalData = mysqli_fetch_assoc($countResult)['total']; 
        $totalPages = ceil($totalData / $this->limit); 

        $query = "SELECT id_crop, name_crop
                FROM crops
                WHERE id_user = $this->sessionUser $searchQuery";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $text = "";

        if ($result->num_rows > 0 ){
            $no = ($this->page1 - 1) * $this->limit + 1;
            while($row = mysqli_fetch_assoc($result)){
                $text .=
                "
                <tr>
                    <td class='col-no'>".$no++."</td>
                    <td>".$row['name_crop']."</td>
                    <td class='col-no pe-5'><a href='editTanaman.php?id=".$row['id_crop']."' class='text-primary'>edit</a> | <a href='delTanaman.php?id=".$row['id_crop']."' class='text-danger' onclick=\"return confirm('yakin ingin menghapus data ini?')\">delete</a></td>
                </tr>
                ";
            }
        } else {
            $text .= "
                <tr>
                    <td colspan='3' class='text-center'>Tidak ada data</td>
                </tr>
            ";
        }
        return [
            'totalPages' => $totalPages,
            'currentPage' => $this->page1,
            'textHTML' => $text
        ];
    }
}

?>