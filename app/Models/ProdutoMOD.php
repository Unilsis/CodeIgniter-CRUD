<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoMOD extends Model
{
    protected $table            = 'produtomods';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['descricao','custo','precovenda','qtd','estoque'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * MEUS MÉTODOS
     */
     
    protected function initialize() {
        $this->allowedFields[] = 'default';
    }

    public function allProdutos($id = null){
        if($id === null){
            return $this->findAll();
        }
        return $this->asObject()->where(['id'=>$id])->first();
    }

    public function addProdutos($data){
        return $this->insert($data);
    }

    public function updateProdutos($id, $data){
        if($data !== null){
            return $this->where('id', $id)->set($data)->update();
        }
        return false;
    }

    public function deleteProdutos($id){
        $this->where('id', $id)->delete();
    }
}
