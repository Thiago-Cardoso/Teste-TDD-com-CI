<?php
	//mapeador para separar a logica do sql
	class Usuario_Mapper extends CI_Model
	{

		//metodo para save
		public function save(Usuario $usuario)
		{
			if(NULL == ($id = $usuario->id))
			{
				$this->db->insert('usuarios', $usuario);
				return $this->db->insert_id();
			}else{

			return $this->db->update('usuarios', $usuario, array('id' => $id));
			}
		}

		//metodo para busca do id
		public function find($id)
		{
			return $this->db->get_where('usuarios', array('id' => $id))->row();
		}
}