<?php
class matakuliah
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "ruang";
        $username = "root";
        $password = "";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }


    public function add_data($kd_matkul, $nama_matkul, $semester)
   {
        $data = $this->db->prepare('INSERT INTO matakuliah (kd_matkul,nama_matkul,semester) VALUES (?, ?, ?)');

        $data->bindParam(1, $kd_matkul);
        $data->bindParam(2, $nama_matkul);
        $data->bindParam(3, $semester);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from matakuliah");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_matkul){
        $query = $this->db->prepare("SELECT * from matakuliah where kd_matkul=?");
        $query->bindParam(1, $kd_matkul);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_matkul)
    {
      $query = $this->db->prepare("SELECT * from matakuliah where kd_matkul=?");
      $query->bindParam(1, $kd_matkul);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_matkul,$nama_matkul,$semester){
        $query = $this->db->prepare('UPDATE matakuliah set nama_matkul=?, semester=? where kd_matkul=?');

        $query->bindParam(1, $nama_matkul);
        $query->bindParam(2, $semester);
        $query->bindParam(3, $kd_matkul);

        $query->execute();
        return $query->rowCount();
    }
}
?>
