<?php
namespace App\Models;

abstract class Model
{
    protected $db = null;

    protected string $table_name;

    public function __construct()
    {
        $this->db = \App\System\DB::getConnect();
    }

    public function find($id) {
        $stmt = $this->db->prepare('SELECT * FROM '. $this->table_name .' WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchColumn();
    }

}