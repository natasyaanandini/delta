<?php
class ruangan
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "ruang";
        $username = "root";
        $password = "";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }

        public function add_data($kd_ruang, $nama_ruang, $kapasitas)
   {
        $data = $this->db->prepare('INSERT INTO ruangan (kd_ruang,nama_ruang,kapasitas) VALUES (?, ?, ?)');

        $data->bindParam(1, $kd_ruang);
        $data->bindParam(2, $nama_ruang);
        $data->bindParam(3, $kapasitas);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from ruangan");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_ruang){
        $query = $this->db->prepare("SELECT * from ruangan where kd_ruang=?");
        $query->bindParam(1, $kd_ruang);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_ruang)
    {
      $query = $this->db->prepare("SELECT * from ruangan where kd_ruang=?");
      $query->bindParam(1, $kd_ruang);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_ruang,$nama_ruang,$kapasitas){
        $query = $this->db->prepare('UPDATE ruangan set nama_ruang=?, kapasitas=? where kd_ruang=?');

        $query->bindParam(1, $nama_ruang);
        $query->bindParam(2, $kapasitas);
        $query->bindParam(3, $kd_ruang);

        $query->execute();
        return $query->rowCount();
    }
}
?>
