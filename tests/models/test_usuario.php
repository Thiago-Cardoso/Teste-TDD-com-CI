<?php

	class Test_Usuario extends CIUnit_TestCase
	{

		private $usuarios = array();
		private $usuario;
		private $usuario_mapper;

		//setup roda antes dos teste
		public function setUp(){

			 parent::setUp();
		     parent::tearDown();

		     //limpa a tabela
		    // $this->tearDown();

		    $this->CI->load->model('usuario');
		    $this->CI->load->model('usuario_mapper');

		    $this->usuario = &$this->CI->usuario; //modelo
		    $this->usuario_mapper = &$this->CI->usuario_mapper; //mapeador

		    //crio os usuarios
		    for($i=1; $i<6; $i++)
		    {
		    	//clono para dentro de um indice do array
		    	$this->usuarios[$i] = clone $this->usuario;
		        $this->usuarios[$i]->id = 1;
		    	$this->usuarios[$i]->nome = 'Thiago Cardoso';
		    	$this->usuarios[$i]->email = 'trovador1@gmail.com';
		    	$this->usuarios[$i]->senha = '123';
		    }
		}

		//teardow no final dos testes
		public function tearDown(){

			//$this->CI->db->query('TRUNCATE TABLE usuarios');
		}

		///tenta cria usuario no bd
		public function test_cria_usuario()
		{

			$this->assertEquals(1, $this->usuario_mapper->save($this->usuarios[1]));
			//$this->assertEquals(2, $this->usuario_mapper->save($this->usuarios[2]));
			//$this->assertEquals(3, $this->usuario_mapper->save($this->usuarios[3]));
		}

		/***
			depends test usuario
		*/
		public function test_salva_usuario()
		{

			$this->test_cria_usuario();

			$email = 'teste@teste.com';
			$id = 1;
			$this->usuarios[1]->id = $id;
			$this->usuarios[1]->email = $email; 
			$this->assertTrue($this->usuario_mapper->save($this->usuarios[1]));
			//busca o usuario
			$usuario = $this->usuario_mapper->find($id);
			$this->assertEquals($email, $usuario->email);
		}
	}
?>