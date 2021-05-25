<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        //mahasiswa = aliasnya Mahasiswa_model
        $this->load->model('Mahasiswa_model', 'mahasiswa');

        //limit per method per jam
        //limit method get
        $this->methods['index_get']['limit'] = 100;
        //limit method delete
        $this->methods['index_delete']['limit'] = 2;
    }

    // Ini pake methodnya get
    public function index_get()
    {
        // Mengambil id apa bila ada yang mengirimkan
        $id = $this->get('id');

        // Apabila tidak ada permintaan id maka kembalikan semua data
        if ($id === NULL) {
            $mahasiswa = $this->mahasiswa->getMahasiswa();
        } else {
            $mahasiswa = $this->mahasiswa->getMahasiswa($id);
        }
        
        //ubah ke JSON
        //Apabila ada kembalian
        if($mahasiswa) {
             $this->response([
                 'status' => true,
                 'data' => $mahasiswa
             ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code)

        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'ID could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

    }

    // Ini pake methodnya delete
    public function index_delete()
    {   
        // Ambil id dari method delete 
        $id = $this->delete('id');

        if ($id === NULL) {
            $this->response([
                'status' => FALSE,
                'message' => 'Provide an ID'
            ], REST_Controller::HTTP_BAD_REQUEST); // NOT_FOUND (404) being the HTTP response 
        } else {
            // Jika nilai yang dikembalikan > 0 maka ada data yang berhasil terhapus
            if( $this->mahasiswa->deleteMahasiswa($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted'
                ], REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'ID could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response 
            }
        }
    }

    public function index_post()
    {
        // Masalah validasi harusnya udah ditangani di client
        // $nim = $this->post('nim');
        // $nim = +$nim;
        // $phone = $this->post('phone');
        // $phone = +$phone;

        // Ambil data dari method post
        $data = [
            'nama' => $this->post('nama'),
            'NIM' => $this->post('NIM'),
            'email' => $this->post('email'),
            'no_telp' => $this->post('no_telp'),
            'alamat' => $this->post('alamat')
        ]; // sebelah kiri sesuaikan dengan nama kolom yang di tabel

        if( $this->mahasiswa->createMahasiswa($data) > 0 ) {
            $this->response([
                'status' => true,
                'message' => 'new Anggota has been created'
            ], REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to create new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }

    public function index_put()
    {
        // Ambil id dari method put
        $id = $this->put('id');

        // Ambil data dari method post
        $data = [
            'nama' => $this->put('nama'),
            'no_telp' => $this->put('no_telp'),
            'alamat' => $this->put('alamat')
        ];

        if( $this->mahasiswa->updateMahasiswa($data, $id) > 0 ) {
            $this->response([
                'status' => true,
                'id' => $id,
                'message' => 'has been modified'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}