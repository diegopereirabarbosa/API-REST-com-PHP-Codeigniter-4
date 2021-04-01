<?php 
namespace App\Models;
use CodeIgniter\Model;

class Model_cadastro extends Model
{
    protected $table = 'cadastro';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'senha', 'telefone', 'endereco', 'cidade', 'uf', 'foto'];

    public function DBverifica_login($email,$senha){
       return $this->db->query("SELECT * FROM cadastro");
    }
}