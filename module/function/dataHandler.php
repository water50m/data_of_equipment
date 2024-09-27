<?php

class DataHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPaginatedData($pageNumber, $itemsPerPage) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM your_table LIMIT $offset, $itemsPerPage";
        $result = mysqli_query($this->conn, $sql);
        
        // Fetch and return data
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
?>