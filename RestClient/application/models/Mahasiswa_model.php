<?php

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_Model
{

	/* NOTES :
		$client = new Client();
		
		$response = $client->request('GET', 'http://localhost/cobaAPI/RestServer/api/mahasiswa', [			
			'auth' => ['admin','1234'],
			'query' => [
				'X-API-KEY' => 'wpu123'
			]
		]);

		Untuk menghindari perulangan kode diatas pada setiap method maka dipindah ke 
		method _construct. Berikut merupakan kodenya:
	*/

	// Menggunakan _ di depan untuk membedakan variable private
	private $_client;

	public function __construct()
	{

		// Menggunakan this untuk memanggil variable private
		// Menambahkan parameter pada pembuatan Client()
		$this->_client = new Client([
			// Menyimpan hanya sampai api/ , bukan mahasiswa/
			'base_uri' => 'http://localhost/MahasiswaREST/RestServer/api/',
			// Menyimpan authentikasi [username, password]
			'auth' => ['admin', '1234']
		]);
	}
	public function getAllMahasiswa()
	{
		$response = $this->_client->request('GET', 'mahasiswa', [
			'query' => [
				'X-API-KEY' => 'wpu123'
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result['data'];
		die();
	}

	public function getMahasiswaById($id)
	{
		$response = $this->_client->request('GET', 'mahasiswa', [
			'query' => [
				'X-API-KEY' => 'wpu123',
				'id' => $id
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result['data'][0];
	}

	public function tambahDataMahasiswa()
	{
		//siapin datanya dulu baru nanti di insert
		//true pada fungsi post untuk mengaktifkan pengamanan dari SQL Injection
		$data = array(
			'nama' => $this->input->post('nama', true),
			'NIM' => $this->input->post('nim', true),
			'email' => $this->input->post('email', true),
			'no_telp' => $this->input->post('phone', true),
			'alamat' => $this->input->post('alamat', true),
			'X-API-KEY' => 'wpu123' //ini ngikut disini hehe
		);

		$response = $this->_client->request('POST', 'mahasiswa', [
			// Ini kalo lewat body
			'form_params' => $data
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result;
	}

	public function hapusDataMahasiswa($id)
	{
		$response = $this->_client->request('DELETE', 'mahasiswa', [
			// Ini kalo lewat body
			'form_params' => [
				'X-API-KEY' => 'wpu123',
				'id' => $id
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result;
	}

	public function editDataMahasiswa()
	{
		//siapin datanya untuk di update
		//true pada fungsi post untuk mengaktifkan pengamanan dari SQL Injection
		$data = array(
			'id' => $this->input->post('nim', true),
			'nama' => $this->input->post('nama', true),
			'no_telp' => $this->input->post('phone', true),
			'alamat' => $this->input->post('alamat', true),
			'X-API-KEY' => 'wpu123'
		);

		$response = $this->_client->request('PUT', 'mahasiswa', [
			// Ini kalo lewat body
			'form_params' => $data
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result;
	}

	public function cariDataMahasiswa()
	{
		// $keyword = $this->input->post('keyword',true);
		// $this->db->like('nama', $keyword); //untuk pencarian berdasarkan nama saja
		// $this->db->or_like('alamat', $keyword); //untuk pencarian berdasarkan nama dan alamat
		// $this->db->or_like('NIM', $keyword);
		// $this->db->or_like('email', $keyword);
		// $this->db->select('nama, NIM');
		// return $this->db->get('anggota')->result_array();
	}
}
