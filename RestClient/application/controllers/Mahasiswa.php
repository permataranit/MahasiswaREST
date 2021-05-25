<?php

class Mahasiswa extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data['judul'] = 'Halaman Daftar Mahasiswa';
		//kalo mau manggil model harus load dulu
		//sudah di load di construct
		$data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
		if( $this->input->post('keyword') )
		{
			$data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
		}
		$this->load->view('template/header', $data);
		$this->load->view('mahasiswa/index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data['judul'] = 'Form Tambah Data Mahasiswa';

		//set_rules('nama_elemennya_di_html','alias untuk di pesan error','rules yang diinginkan | rules yang diinginkan 2')
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('nim','NIM','required|numeric');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('phone','Telp','required|numeric');
		$this->form_validation->set_rules('alamat','Alamat','required');
		
		if( $this->form_validation->run() == FALSE){
			//ini apabila ada yang salah inputannya, maka dikembalikan kemana
			$this->load->view('template/header', $data);
			$this->load->view('mahasiswa/tambah');
			$this->load->view('template/footer');
		} else {
			$this->Mahasiswa_model->tambahDataMahasiswa();
			//set_flashdata('nama_flash_bebas','pesannya')
			$this->session->set_flashdata('flash','Ditambahkan'); 
			redirect('mahasiswa');
		}
	}

	public function hapus($id)
	{
		$this->Mahasiswa_model->hapusDataMahasiswa($id);
		$this->session->set_flashdata('flash','Dihapus');
		redirect('mahasiswa');
	}

	public function detail($id)
	{
		$data['judul'] = 'Detail Data Mahasiswa';
		$data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
		$this->load->view('template/header', $data);
		$this->load->view('mahasiswa/detail', $data);
		$this->load->view('template/footer');
	}

	public function edit($id)
	{
		$data['judul'] = 'Form Edit Data Mahasiswa';
		$data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);

		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('phone','Telp','required|numeric');
		$this->form_validation->set_rules('alamat','Alamat','required');
		
		if( $this->form_validation->run() == FALSE){
			$this->load->view('template/header', $data);
			$this->load->view('mahasiswa/edit',$data);
			$this->load->view('template/footer');
		} else {
			$this->Mahasiswa_model->editDataMahasiswa();
			$this->session->set_flashdata('flash','Diedit'); 
			redirect('mahasiswa');
		}
	}
}