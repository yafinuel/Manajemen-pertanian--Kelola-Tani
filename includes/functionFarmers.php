<?php

class showFarmer{
    private $query;
    
    function __construct($conn){
        $this->conn = $conn;
    }

    function showDataFarmer(){
        $query = "SELECT * FROM farmers";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)){
                $id = $row['id_farmer'];
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
                                <button class='btn btn-danger btn-sm'>Delete</button>
                            </a>
                        </td>
                    </tr>";
            }
        }
    }
}

?>