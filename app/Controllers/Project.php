<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use CodeIgniter\RESTful\ResourceController;

class Project extends ResourceController
{

    protected $format    = 'json';

    public function index()
    {
        $model = new ProjectModel();
        $data['proj_lista'] = $model->getProjetos();
        echo view('produtos/product', $data);
        //echo view('templates/projects_dashboard');
    }

    public function create()
    {
        $model = new ProjectModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        if ($model->insert($data) === false) {

            $response = [
                'errors' => $model->errors(),
                'message' => 'Invalid Inputs'
            ];

            return $this->fail($response, 409);
        }

        return $this->respond(['message' => 'Created Successfully'], 201);
    }

    public function update($id = null)
    {
        $model = new ProjectModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
        ];

        if ($model->where('id', $this->request->getVar('id'))->set($data)->update() === false) {
            $response = [
                'errors' => $model->errors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);
        }

        return $this->respond(['message' => 'Updated Successfully'], 200);
    }

    public function deleteProgect() {
        $model = new ProjectModel();
        $model->where('id', $this->request->getVar('id'))->delete();
        return $this->respond(['message' => 'Deleted Successfully'], 200);
    }
}
