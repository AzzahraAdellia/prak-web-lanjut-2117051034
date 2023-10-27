<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\KelasModel;
use LDAP\Result;

class UserController extends BaseController
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new KelasModel();
    }
    protected $helpers=['Form'];
    public function index(){
        $data = [
            'title' => "List User",
            'users' => $this->userModel->getUser(),
        ];
    return view('list_user', $data);
    }
    public function profile($nama = "", $kelas = "", $npm = ""){
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'npm' => $npm,
        ];
        return view('profile', $data);
}
    public function create(){
        $kelasModel = new KelasModel();
        $kelas = $kelasModel->getKelas();

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];
        // $kelas = [
        //     [
        //         'id' => 1,
        //         'nama_kelas' => 'A'
        //     ],
        //     [
        //         'id' => 2,
        //         'nama_kelas' => 'B'
        //     ],
        //     [
        //         'id' => 3,
        //         'nama_kelas' => 'C'
        //     ],
        //     [
        //         'id' => 4,
        //         'nama_kelas' => 'D'
        //     ],
        // ];

        return view('create_user', $data);
    }

    public function store(){
        $userModel = new UserModel();
        if(!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tidak Boleh Kosong'
                ]
                ],
            'npm' => [
                'rules' => 'required|is_unique[user.npm]',
                'errors' => [
                    'required' => 'Wajib di isi!',
                    'is_unique' => 'Silahkan masukkan NPM lain'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        
        
        $path = 'assets/upload/img/';
        $foto = $this->request->getFile('foto');
        $name = $foto->getRandomName();
 
        if ($foto->move($path, $name)){
            $foto = base_url ($path . $name);
        }

       $this->userModel->saveUser([
        'nama' => $this->request->getVar('nama'),
        'id_kelas' => $this->request->getVar('kelas'),
        'npm' => $this->request->getVar('npm'),
        'foto' => $foto
       ]);

        $data = [
            'nama' => $this->request->getVar('nama'),
            'kelas' => $this->request->getVar('kelas'),
            'npm' => $this->request->getVar('npm'),
        ];

        return redirect()->to('/user');
    }

	/**
	 * @return mixed
	 */
	public function getHelpers() {
		return $this->helpers;
	}
	
	/**
	 * @param mixed $helpers 
	 * @return self
	 */
	public function setHelpers($helpers): self {
		$this->helpers = $helpers;
		return $this;
	}

    public function show($id){
        $user = $this->userModel->getUser($id);
        $data = [
            'title' => 'Profile',
            'user'  => $user,
        ];
        return view('profile', $data);
    }

    public function edit($id){
        $user = $this->userModel->getUser($id);
        $kelas = $this->kelasModel->getKelas();
        $data = [
            'title' => 'Edit User',
            'user'  => $user,
            'kelas' => $kelas,
        ];
        return view('edit_user', $data);
    }
    public function update($id)
    {
        // Retrieve the existing user data
        $existingUser = $this->userModel->getUser($id);
    
        if (empty($existingUser)) {
            // Handle the case where the user doesn't exist
            return redirect()->back()->with('error', 'User not found.');
        }
    
        $path = 'assets/upload/img/';
        $foto = $this->request->getFile('foto');
    
        if ($foto) { // Check if a file was uploaded
            $name = $foto->getRandomName();
    
            if ($foto->move($path, $name)) {
                $foto = base_url($path . $name);
    
                // Update the user's data
                $this->userModel->updateUser($id, [
                    'nama' => $this->request->getVar('nama'),
                    'id_kelas' => $this->request->getVar('kelas'),
                    'npm' => $this->request->getVar('npm'),
                    'foto' => $foto
                ]);
    
                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'kelas' => $this->request->getVar('kelas'),
                    'npm' => $this->request->getVar('npm'),
                ];
    
                return redirect()->to('/user')->with('success', 'User data updated successfully.');
            } else {
                // Log the error message to the console
                echo '<script>console.error("File upload failed.")</script>';
                return redirect()->back()->with('error', 'File upload failed.');
            }
        } else {
            // Handle the case where no file was uploaded.
            return redirect()->back()->with('error', 'No file uploaded.');
        }
    }
    
    

public function destroy($id)
{
    $result = $this->userModel->deleteUser($id);
    
    if (!$result) {
        return redirect()->back()->with('error', 'Failed to delete data');
    }
    
    return redirect()->to(base_url('/user'))->with('success', 'Data successfully deleted');
}
public function delete($id)
{
    $user = $this->userModel->getUser($id); // Retrieve the user data
    if (empty($user)) {
        return redirect()->to(base_url('/user'))->with('error', 'User not found.');
    }

    $result = $this->userModel->deleteUser($id);

    if ($result) {
        return redirect()->to(base_url('/user'))->with('success', 'User data deleted successfully.');
    } else {
        return redirect()->to(base_url('/user'))->with('error', 'Failed to delete user.');
    }
}

public function deleteUser($id)
{
    return $this->delete($id);
}

    public function getKelas($id_kelas){
        $user = $this->userModel->getUserKelas($id_kelas);
        $data = [
            'title' => 'Profile',
            'user'  => $user,
        ];
        return view('list_kelas', $data);
    }


}