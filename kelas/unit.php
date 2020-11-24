<?php
class unit
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "ruang";
        $username = "root";
        $password = "";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }

    public function createCode()
    {
        $kode = 0;
        $kodeu = "";

        $query = $this->db->prepare("SELECT ifnull(max(substring(kd_unit, 2, 2)),0)+1 as kode from unit");
        $query ->execute();
        $data = $query->fetch();

        if ($data['kode']=="")
        {
            $kode=0;
        }
        else
        {
            $kode = $data['kode'];
        }

        if ($kode > 0 && $kode < 9)
        {
            $kodeu = "U"."0".$kode;
        }
        else if ($kode >=9 && $kode < 99)
        {
            $kodeu = "U".$kode;
        }

        return $kodeu;
    }

    public function add_data($kd_unit, $nm_unit, $kp_unit)
    {
        $data = $this->db->prepare('INSERT INTO unit (kd_unit,nm_unit,kp_unit) VALUES (?, ?, ?)');

        $data->bindParam(1, $kd_unit);
        $data->bindParam(2, $nm_unit);
        $data->bindParam(3, $kp_unit);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from unit");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_unit){
        $query = $this->db->prepare("SELECT * from unit where kd_unit=?");
        $query->bindParam(1, $kd_unit);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_unit)
    {
      $query = $this->db->prepare("SELECT * from unit where kd_unit=?");
      $query->bindParam(1, $kd_unit);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_unit,$nm_unit, $kp_unit){
        $query = $this->db->prepare('UPDATE unit set nm_unit=?, kp_unit=? where kd_unit=?');

        $query->bindParam(1, $nm_unit);
        $query->bindParam(2, $kp_unit);
        $query->bindParam(3, $kd_unit);

        $query->execute();
        return $query->rowCount();
    }
}
?>
