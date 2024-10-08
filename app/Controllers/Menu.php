<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TypesModel;
use App\Models\MenusModel;

class Menu extends BaseController
{

    protected $session;
    protected $menuModel;
    protected $typeModel;
    protected $helpers = ['form'];

    public function __construct(){
        $this->session = \Config\Services::session();
        $this->menuModel = new MenusModel();
        $this->typeModel = new TypesModel();
    }

    public function index(){
        $data['title'] = 'Asad Kebab | Home';
        $data['foods'] = $this->menuModel->select('id, menu_name, menu_image, price, fin_amount')->where(['menu_type' => 1, 'status' => 'active'])->get()->getResult();
        $data['drinks'] = $this->menuModel->select('id, menu_name, menu_image, price, fin_amount')->where(['menu_type' => 2, 'status' => 'active'])->get()->getResult();
        return view('pages/product/list', $data);
    }

    public function menuDetail($id){
        if(empty($id)){
            $this->session->setFlashdata('error_message','Unknown Data ID.') ;
            return redirect()->to(base_url());
        }
        $query = $this->menuModel->select('*')->where('id', $id);
        $data['details'] = $query->first();
        $data['title'] = 'Menu | '.$data['details']['menu_name'];
        return view('pages/product/detail', $data);
    }

    public function editMenu($id = -1){
        if ( (!session('isLoggedIn')) || (session('role') != 1)){
            return "Error : Access Denied!";
        }
        if ($id == -1){
            $data['title'] = 'Asad Kebab | Add Menu';
        } else {
            $query = $this->menuModel->select('id, menu_name, menu_type, price, menu_image, init_amount, details')->where('id', $id);
            $data['menu_data'] = $query->first();

            $data['title'] = "Edit Menu | ".$data['menu_data']['menu_name'];
        }
        $data['types'] = $this->typeModel->select('*')->get()->getResult();
        return view('pages/product/edit', $data);

    }

    public function saveMenu($id = 0){
        $rules = [
            'menu_name' => 'required',
            'price' => 'required',
            'init_amount' => 'required',
            'imageUrl' => 'required'
        ];

        if(!$this->validate($rules)){
            return redirect()->back()->withInput(validation_errors());
        }

        $data = [
            'menu_name' => $this->request->getvar('menu_name'),
            'price' => $this->request->getVar('price'),
            'menu_image' => $this->request->getVar('imageUrl'),
            'init_amount' => $this->request->getVar('init_amount'),
            'menu_type' => $this->request->getVar('menu_type'),
            'fin_amount' => $this->request->getVar('init_amount'),
            'details' => $this->request->getVar('details'),
            'status' => 'active',
        ];


        // try {
        //     $menu_image = $this->request->getFile('menu_image');
        //     $data['menu_image'] = $menu_image->getRandomName();
        // } catch (\Throwable $th) {
        //     $data['menu_image'] = $this->request->getVar('oldFile');
        // }

        if($id !== 0){
            $data['id'] = $id;
        }

        $this->menuModel->save($data);
        return redirect()->to(base_url());

    }

    public function deleteMenu($id){
        if ( (!session('isLoggedIn')) || (session('role') != 1)){
            return "Error : Access Denied!";
        }
        if(empty($id)){
            return "Product ID is Empty!";
        }

        $deleted = [
            'id' => $id,
            'status' => 'deleted',
        ];

        $this->menuModel->save($deleted);
        return redirect()->to(base_url());
        
    }
}
