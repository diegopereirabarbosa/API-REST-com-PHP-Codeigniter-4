<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_cadastro;


class Cadastro extends ResourceController
{
    use ResponseTrait;

    // all users
    public function index(){
      $model = new Model_cadastro();
      $data['cadastro'] = $model->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }

    // create
    public function create() {
        $model = new Model_cadastro();
        $data = [
            'nome' => $this->request->getVar('nome'),
            'email'  => $this->request->getVar('email'),
            'senha'  => md5($this->request->getVar('senha')),
            'telefone'  => $this->request->getVar('telefone'),
            'endereco'  => $this->request->getVar('endereco'),
            'cidade'  => $this->request->getVar('cidade'),
            'uf'  => $this->request->getVar('uf'),
            'foto'  => $this->request->getVar('foto'),
        ];
        $model->insert($data);
        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Cadastro criado com sucesso'
          ]
      ];
      return $this->respondCreated($response);
    }

    // single user
    public function show($id = null){
        $model = new Model_cadastro();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('Nenhum registro encontardo');
        }
    }

    // update
    public function update($id = null){
        $model = new Model_cadastro();
        $id = $this->request->getVar('id');
        $data = [
            'nome' => $this->request->getVar('nome'),
            'email'  => $this->request->getVar('email'),
            'senha'  => md5($this->request->getVar('senha')),
            'telefone'  => $this->request->getVar('telefone'),
            'endereco'  => $this->request->getVar('endereco'),
            'cidade'  => $this->request->getVar('cidade'),
            'uf'  => $this->request->getVar('uf'),
            'foto'  => $this->request->getVar('foto'),
        ];
        $model->update($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Cadastro atualizado com sucesso'
          ]
      ];
      return $this->respond($response);
    }

    // delete
    public function delete($id = null){
        $model = new Model_cadastro();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Cadastro deletado com sucesso'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Cadastro não encontrado');
        }
    }

    // login
    public function login(){
        $model = new Model_cadastro();
        $email = $this->request->getVar('email');
        $senha = md5($this->request->getVar('senha'));
    
        $data =  $model->DBverifica_login($email,$senha);
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('Nenhum registro encontardo');
        } 
    }

}