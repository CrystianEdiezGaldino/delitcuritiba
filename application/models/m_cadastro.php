<?php
class M_cadastro extends CI_Model {
	//Liberação de variaveis 
	public $usuario;
	public $email;
	public $senha;
	public $conf_senha;
	public $referencia;
	public $forum_id;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function pesquisar_usuario($usuario, $email) {
		// Construção da consulta usando Active Record
		$this->db->select('count(*) as total');
		$this->db->from('accounts');
		$this->db->where('username', $usuario);
		$this->db->or_where('mail', $email);

		// Executa a consulta
		$query = $this->db->get();
		$result = $query->row_array();

		// Extrai o valor de 'total'
		$total = isset($result['total']) ? $result['total'] : 0;

		// Verifica se o usuário ou email já existe
		$valida = ($total == 0) ? TRUE : FALSE;

		return $valida;
	}


	public function pesquisar_ip($ip) {
		// Construção da consulta usando Active Record
		$this->db->select('count(*) as total');
		$this->db->from('accounts');
		$this->db->where('ip_created', $ip);

		// Executa a consulta
		$query = $this->db->get();
		$result = $query->row_array();

		// Extrai o valor de 'total'
		$total = isset($result['total']) ? $result['total'] : 0;

		// Verifica se o total é menor que 3
		$valida = ($total < 3) ? TRUE : FALSE;

		return $valida;
	}

	
	public function pesquisar_usuario_login($usuario, $senha) {
		// Construção da consulta usando Active Record
		$this->db->select('*');
		$this->db->from('accounts');
		$this->db->where('username', $usuario);
		$this->db->where('password_hash', $senha);

		// Executa a consulta
		$query = $this->db->get();

		// Obtém o resultado da consulta
		$result = $query->row_array();

		// Verifica se encontrou algum resultado
		if ($result) {
			return $result;
		}

		return false;
	}
	
	public function dados_usuario($id) {
		// Construção da consulta usando Active Record
		$this->db->select('username, mail, cash, password_hash, id');
		$this->db->from('accounts');
		$this->db->where('id', $id);

		// Executa a consulta
		$query = $this->db->get();
		$result = $query->row_array();

		// Verifica se encontrou algum resultado
		if ($result) {
			return $result;
		}

		return false;
	}


	public function alterar_senha($id, $senha) {
		// Criptografa a senha
		$senha = md5($senha);

		// Construção da consulta usando Active Record
		$this->db->set('password_hash', $senha);
		$this->db->where('id', $id);

		// Executa a atualização
		return $this->db->update('accounts');
	}

	
	public function incluir($usuario,$senha,$email,$forum_id,$minha_referencia,$ip){
		$horario = $_SERVER['REQUEST_TIME'];

				

		$dados = array(
				'username' => $usuario,
				'password_hash' => md5($senha),
				'mail' => $email,
				'forum_id' => $forum_id,
				'time_created' => $horario,
				'cash' => 0,
				'ip_created' => $ip
		);
		$dados_referencia = array(
				'referrer' => $usuario,
				'code' => $minha_referencia,
				'total_refs' => 0
		);
		$this->db->insert('referrers', $dados_referencia);
		return $this->db->insert('accounts', $dados);
	}
	
	public function incluir_referencia($referencia) {
		// Incrementa o valor de 'total_refs'
		$this->db->set('total_refs', 'total_refs + 1', FALSE);
		$this->db->where('code', $referencia);

		// Executa a atualização
		return $this->db->update('referrers');
	}

	
	public function forum_id() {
		// Seleciona o valor máximo de 'forum_id'
		$this->db->select_max('forum_id', 'id');
		$this->db->from('accounts');

		// Executa a consulta
		$query = $this->db->get();
		$result = $query->row_array();

		// Extrai o valor de 'id' e ajusta se necessário
		$id = isset($result['id']) ? $result['id'] : 0;

		// Retorna o próximo ID
		return $id + 1;
	}

	
	public function incluir_transacao($usuario,$transacao,$valor,$cash,$status,$id){
		$dados = array(
				'account_id' => $usuario,
				'transaction_id' => $transacao,
				'price' => $valor,
				'status' => $status,
				'method' => $cash,
				'asaas_id' => $id
		);

		return $this->db->insert('donates', $dados);
	}
	
}
?>
