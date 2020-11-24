<?php
class organisasi
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
        $kodeo = "";

        $query = $this->db->prepare("SELECT ifnull(max(substring(kd_organisasi, 2, 2)),0)+1 as kode from organisasi");
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
            $kodeo = "0"."0".$kode;
        }
        else if ($kode >=9 && $kode < 99)
        {
            $kodeo = "0".$kode;
        }

        return $kodeo;
    }

    public function add_data($kd_organisasi, $nm_organisasi, $pj)
   {
        $data = $this->db->prepare('INSERT INTO organisasi (kd_organisasi,nm_organisasi,pj) VALUES (?, ?, ?)');

        $data->bindParam(1, $kd_organisasi);
        $data->bindParam(2, $nm_organisasi);
        $data->bindParam(3, $pj);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from organisasi");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_organisasi){
        $query = $this->db->prepare("SELECT * from organisasi where kd_organisasi=?");
        $query->bindParam(1, $kd_organisasi);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_organisasi)
    {
      $query = $this->db->prepare("SELECT * from organisasi where kd_organisasi=?");
      $query->bindParam(1, $kd_organisasi);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_organisasi,$nm_organisasi,$pj){
        $query = $this->db->prepare('UPDATE organisasi set nm_organisasi=?, pj=? where kd_organisasi=?');

        $query->bindParam(1, $nm_organisasi);
        $query->bindParam(2, $pj);
        $query->bindParam(3, $kd_organisasi);

        $query->execute();
        return $query->rowCount();
    }
}
?>
