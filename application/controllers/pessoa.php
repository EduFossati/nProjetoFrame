<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pessoa
 *
 * @author user
 */
class pessoa extends CI_Controller{
    //put your code here
    function __construct(){
        parent::__construct();
        $this->load->model('pessoa_model','pessoa'); //apelido do model
    }
    
    public function index(){
        $lista['pessoas']=$this->pessoa->listar();
        $this->load->view('pessoaCadastro', $lista);
    }
    
    public function inserir() {
        //NOme do vetor deve ser o mesmo nome do campo na tabela
        $dados['nome']= $this->input->post('nome');
        $dados['telefone']= $this->input->post('telefone');
        $dados['email']= $this->input->post('email');
        $dados['endereco']= $this->input->post('endereco');
        if($this->input->post('tpPessoa')=='Fisica' ){
            $dados['cpf']= $this->input->post('cpf');
            $dados['sexo']= $this->input->post('sexo');
        }
        else{
            $dados['cnpj']= $this->input->post('cnpj');
            $dados['nomeFantasia']= $this->input->post('nomeFantasia');
        }
        $result = $this->pessoa->inserir($dados);
        if($result==true){
            $this->session->set_flashdata('true','msg');
            redirect('pessoa');
        }
        else{
            $this->session->set_flashdata('err','msg');
            redirect('pessoa');
        }
    }
    
    public function excluir ($id){
        $result = $this->pessoa->deletar($id);
        if($result==true){
            $this->session->set_flashdata('true','msg');
            redirect('pessoa');
        }
        else{
            $this->session->set_flashdata('err','msg');
            redirect('pessoa');
        }
    }
    
    public function editar($idPessoa){
        $data['pessoa'] = $this->pessoa->editar($idPessoa);
        $this->load->view('pessoaEditar',$data);
    }
    
    public function atualizar(){
        $dados['nome']= $this->input->post('nome');
        $dados['telefone']= $this->input->post('telefone');
        $dados['email']= $this->input->post('email');
        $dados['endereco']= $this->input->post('endereco');
        if($this->input->post('tpPessoa')=='Fisica' ){
            $dados['cpf']= $this->input->post('cpf');
            $dados['sexo']= $this->input->post('sexo');
        }
        else{
            $dados['cnpj']= $this->input->post('cnpj');
            $dados['nomeFantasia']= $this->input->post('nomeFantasia');
        }
        
        if($this->pessoa->atualizar($dados)==true){
            $this->session->set_flashdata('true','msg');
            redirect('pessoa');
        }
        else{
            $this->session->set_flashdata('err','msg');
            redirect('pessoa');
        }
    }
}
