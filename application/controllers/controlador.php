<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controlador extends CI_Controller {
	
	public function index()
	{	
		$this->load->view('header');
		$dados = array();
		$this->load->view('home', $dados);
		$this->load->view('footer');
	}

}
