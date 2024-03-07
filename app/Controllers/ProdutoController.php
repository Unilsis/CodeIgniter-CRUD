<?php

namespace App\Controllers;

use App\Models\ProdutoMOD;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ProdutoController extends ResourceController {

    /**
     * index the designated resource object from the model.
     */
    public function index() {
        $model = new ProdutoMOD();
        $data['produto_lista'] = $model->allProdutos();
        echo view('produtos/produto_viewer', $data);
    }

    /**
     * create the designated resource object from the model.
     * @return ResponseInterface
     */
    public function teste() {
        $data = array(
            'messagem' => 'A mensagem '.$this->request->getVar('messagem').' foi adicionar com sucessos.'
        );
        return $this->respond($data, 200);
    }
    /**
     * create the designated resource object from the model.
     * @return ResponseInterface
     */
    public function create() {
        $model = new ProdutoMOD();
        $data = [
            'descricao' => $this->request->getVar('descricao'),
            'custo' => $this->request->getVar('custo'),
            'precovenda' => $this->request->getVar('precovenda'),
            'qtd' => $this->request->getVar('qtd'),
            'estoque' => $this->request->getVar('estoque')
        ];
        
        if ($model->addProdutos($data) === false) {
            $response = array(
                'errors' => $model->errors(),
                'message' => 'Ouve um erro ao adicionar produto.'
            );
            return $this->fail($response, 409);
        }
        $response = array(
            'message' => 'O produto '.$this->request->getVar('descricao').' foi adicionar com sucesso.'
        );
        return $this->respond($response, 200);
    }
    /**
     * update the designated resource object from the model.
     * @return ResponseInterface
     */
    public function update($id = null) {
        $model = new ProdutoMOD();
        $data = [
            'descricao' => $this->request->getVar('descricao'),
            'custo' => $this->request->getVar('custo'),
            'precovenda' => $this->request->getVar('precovenda'),
            'qtd' => $this->request->getVar('qtd'),
            'estoque' => $this->request->getVar('estoque')
        ];

        if ($model->updateProdutos($this->request->getVar('id'), $data) === false) {
            $response = array(
                'errors' => $model->errors(),
                'message' => 'Ouve um erro ao atualizado produto.'
            );
            return $this->fail($response, 409);
        }
        $response = array(
            'message' => 'O produto '.$this->request->getVar('descricao').' foi atualizado com sucesso.'
        );

        return $this->respond($response, 200);
    }
    /**
     * deletePD the designated resource object from the model.
     * @return ResponseInterface
     */
    public function deletePD() {
        $model = new ProdutoMOD();
        $model->deleteProdutos($this->request->getVar('id'));
        
        $response = array(
            'message' => 'O produto foi eliminado com sucesso id '.$this->request->getVar('id')
        );

        return $this->respond($response, 200);
    }
}
