
<?php

    function pagination($totalPages1, $page1, $totalPages2, $page2,$search1,$search2, $pembeda){
        echo '<nav><ul class="pagination justify-content-center">';

        // Jika pembeda adalah 1 → pagination pertama
        if ($pembeda == "1") {
            // Tombol Previous
            if ($page1 > 1) {
                $prevPage1 = $page1 - 1;
                echo "<li class='page-item'><a class='page-link text-primary-green' href='?page1=$prevPage1&page2=$page2&search1=$search1&search2=$search2'>Previous</a></li>";
            } else {
                echo "<li class='page-item disabled'><span class='page-link text-primary-green'>Previous</span></li>";
            }

            // Nomor halaman
            for ($i = 1; $i <= $totalPages1; $i++) {
                if ($i == $page1) {
                    echo "<li class='page-item active'><span class='page-link text-primary-green'>$i</span></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link text-primary-green' href='?page1=$i&page2=$page2&search1=$search1&search2=$search2'>$i</a></li>";
                }
            }

            // Tombol Next
            if ($page1 < $totalPages1) {
                $nextPage1 = $page1 + 1;
                echo "<li class='page-item'><a class='page-link text-primary-green' href='?page1=$nextPage1&page2=$page2&search1=$search1&search2=$search2'>Next</a></li>";
            } else {
                echo "<li class='page-item disabled'><span class='page-link text-primary-green'>Next</span></li>";
            }

        } else {
            // Tombol Previous
            if ($page2 > 1) {
                $prevPage2 = $page2 - 1;
                echo "<li class='page-item'><a class='page-link text-primary-green' href='?page1=$page1&page2=$prevPage2&search1=$search1&search2=$search2'>Previous</a></li>";
            } else {
                echo "<li class='page-item disabled'><span class='page-link text-primary-green'>Previous</span></li>";
            }

            // Nomor halaman
            for ($j = 1; $j <= $totalPages2; $j++) {
                if ($j == $page2) {
                    echo "<li class='page-item active'><span class='page-link text-primary-green'>$j</span></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link text-primary-green' href='?page1=$page1&page2=$j&search1=$search1&search2=$search2'>$j</a></li>";
                }
            }

            // Tombol Next
            if ($page2 < $totalPages2) {
                $nextPage2 = $page2 + 1;
                echo "<li class='page-item'><a class='page-link text-primary-green' href='?page1=$page1&page2=$nextPage2&search1=$search1&search2=$search2'>Next</a></li>";
            } else {
                echo "<li class='page-item disabled'><span class='page-link text-primary-green'>Next</span></li>";
            }
        }
        echo '</ul></nav>';
    }

    function pagination1($totalPages1, $page1, $search1){
        echo '<nav><ul class="pagination justify-content-center">'; // Buka tag nav dan ul

        // Tombol Previous
        if ($page1 > 1) {
            $prevPage1 = $page1 - 1;
            echo "<li class='page-item'><a class='page-link text-primary-green' href='?page1=$prevPage1&search1=$search1'>Previous</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link text-primary-green'>Previous</span></li>";
        }

        // Nomor halaman
        for ($i = 1; $i <= $totalPages1; $i++) {
            if ($i == $page1) {
                echo "<li class='page-item active'><span class='page-link text-primary-green'>$i</span></li>";
            } else {
                echo "<li class='page-item'><a class='page-link text-primary-green' href='?page1=$i&search1=$search1'>$i</a></li>";
            }
        }

        // Tombol Next
        if ($page1 < $totalPages1) {
            $nextPage1 = $page1 + 1;
            echo "<li class='page-item'><a class='page-link text-primary-green' href='?page1=$nextPage1&search1=$search1'>Next</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link text-primary-green'>Next</span></li>";
        }

        echo '</ul></nav>'; // Tutup tag ul dan nav
    }

    function paginationAjax($totalPages1, $page1, $search1){
        echo '<nav><ul class="pagination justify-content-center">';

        // Tombol Previous
        if ($page1 > 1) {
            $prevPage1 = $page1 - 1;
            echo "<li class='page-item'><a class='page-link text-primary-green tanaman-pagination' href='#' data-page='$prevPage1' data-search='$search1'>Previous</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link text-primary-green'>Previous</span></li>";
        }

        // Nomor halaman
        for ($i = 1; $i <= $totalPages1; $i++) {
            if ($i == $page1) {
                echo "<li class='page-item active'><span class='page-link text-primary-green'>$i</span></li>";
            } else {
                echo "<li class='page-item'><a class='page-link text-primary-green tanaman-pagination' href='#' data-page='$i' data-search='$search1'>$i</a></li>";
            }
        }

        // Tombol Next
        if ($page1 < $totalPages1) {
            $nextPage1 = $page1 + 1;
            echo "<li class='page-item'><a class='page-link text-primary-green tanaman-pagination' href='#' data-page='$nextPage1' data-search='$search1'>Next</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link text-primary-green'>Next</span></li>";
        }

        echo '</ul></nav>';
    }
?>