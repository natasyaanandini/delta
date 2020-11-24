<?php
class prodi
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
        $kodep = "";

        $query = $this->db->prepare("SELECT ifnull(max(substring(kd_prodi, 2, 2)),0)+1 as kode from prodi");
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
            $kodep = "0"."0".$kode;
        }
        else if ($kode >=9 && $kode < 99)
        {
            $kodep = "0".$kode;
        }

        return $kodep;
    }

    public function add_data($kd_prodi, $nama_prodi)
   {
        $data = $this->db->prepare('INSERT INTO prodi (kd_prodi,nama_prodi) VALUES (?, ?)');

        $data->bindParam(1, $kd_prodi);
        $data->bindParam(2, $nama_prodi);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from prodi");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_prodi){
        $query = $this->db->prepare("SELECT * from prodi where kd_prodi=?");
        $query->bindParam(1, $kd_prodi);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_prodi)
    {
      $query = $this->db->prepare("SELECT * from prodi where kd_prodi=?");
      $query->bindParam(1, $kd_prodi);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_prodi,$nama_prodi){
        $query = $this->db->prepare('UPDATE prodi set nama_prodi=? where kd_prodi=?');

        $query->bindParam(1, $nama_prodi);
        $query->bindParam(2, $kd_prodi);

        $query->execute();
        return $query->rowCount();
    }
}
?>
