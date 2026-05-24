<?php
class Model{
use Database;


    protected $table = 'users';
    // protected $limit = 10;
    // protected $offset =0;
public function where($data = [], $data_not = [], $limit = 10, $offset = 0) {
    $conditions = [];
    $params = [];

   foreach ($data as $key => $value) {
        $conditions[] = "$key = ?";
        $params[] = $value;
    }

    foreach ($data_not as $key => $value) {
        $conditions[] = "$key != ?";
        $params[] = $value;
    }

    $query = "SELECT * FROM $this->table";
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }
    $query .= " LIMIT $limit OFFSET $offset";

    $result = $this->query($query, $params);
    return $result ?: false;
}

public function one($data = [], $data_not = []){
    return $this->where($data, $data_not, 1)[0];
}

    public function all($limit =10, $offset =0){
        $query = "SELECT * FROM $this->table LIMIT $limit OFFSET $offset";
        return $this->query($query);
    }
    public function insert($data) {
        if (empty($data)) return false;
        
        $keys = array_keys($data);

        $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") 
                VALUES (:" . implode(",:", $keys) . ")";

        return $this->query($query, $data);
    }
    public function update($data, $id) {
        if (empty($data)) return false;

        $keys = array_keys($data);

        $set = [];
        foreach ($keys as $key) {
            $set[] = "$key = :$key";
        }

        $query = "UPDATE $this->table SET " . implode(", ", $set) . " WHERE id = :id";

        $data['id'] = $id;

        return $this->query($query, $data);
    }
    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = :id";

        return $this->query($query, [
            'id' => $id
        ]);
    }
     public function deleteMultiple($data = []){
        $ids = implode(',', array_fill(0, count($data), '?'));
        $query = "DELETE FROM $this->table WHERE id IN ($ids)";

        return $this->query($query, $data);
     }

    public function softDelete($id) {
    return $this->query("UPDATE $this->table SET izbrisano = 1 WHERE id = :id", ['id' => $id]);
    }

    public function softDeleteMultiple($data = []){
        $ids = implode(',', array_fill(0, count($data), '?'));
        $query = "UPDATE $this->table  SET izbrisano = 1 WHERE id IN ($ids)";
        return $this->query($query, $data);
    }

    public function restore($id) {
    return $this->query("UPDATE $this->table SET izbrisano = 0 WHERE id = :id", ['id' => $id]);
    }

    public function restoreMultiple($data = []){
        $ids = implode(',', array_fill(0, count($data), '?'));
        $query = "UPDATE $this->table  SET izbrisano = 0 WHERE id IN ($ids)";
        return $this->query($query, $data);
    }

}