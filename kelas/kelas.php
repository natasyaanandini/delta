<?php
class kelas
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "ruang";
        $username = "root";
        $password = "";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }

    public function add_data($kd_kelas, $nama_kelas, $kd_prodi)
    {
        $data = $this->db->prepare('INSERT INTO kelas (kd_kelas,nama_kelas,kd_prodi) VALUES (?, ?, ?)');

        $data->bindParam(1, $kd_kelas);
        $data->bindParam(2, $nama_kelas);
        $data->bindParam(3, $kd_prodi);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from kelas");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_kelas){
        $query = $this->db->prepare("SELECT * from kelas where kd_kelas=?");
        $query->bindParam(1, $kd_kelas);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_kelas)
    {
      $query = $this->db->prepare("SELECT * from kelas where kd_kelas=?");
      $query->bindParam(1, $kd_kelas);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_kelas,$nama_kelas, $kd_prodi){
        $query = $this->db->prepare('UPDATE kelas set nama_kelas=?, kd_prodi=? where kd_kelas=?');

        $query->bindParam(1, $nama_kelas);
        $query->bindParam(2, $kd_prodi);
        $query->bindParam(3, $kd_kelas);

        $query->execute();
        return $query->rowCount();
    }
}
?>
