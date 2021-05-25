<?php

class Mahasiswa_model extends CI_Model
{
    public function getMahasiswa($id = NULL)
    {
        if( $id === NULL ) {
            return $this->db->get('mahasiswa')->result_array();
        } else {
            return $this->db->get_where('mahasiswa', ['NIM' => $id])->result_array();
        }
    }

    public function deleteMahasiswa($id)
    {
        $this->db->delete('mahasiswa', ['NIM' => $id]);

        return $this->db->affected_rows();
    }

    public function createMahasiswa($data)
    {
    	// Instead of insert i use replace so there wont be duplicate errors
        $this->db->replace('mahasiswa', $data);

        return $this->db->affected_rows();
    }

    public function updateMahasiswa($data, $id)
    {
        $this->db->update('mahasiswa', $data, ['NIM' => $id]);

        return $this->db->affected_rows();
    }

}