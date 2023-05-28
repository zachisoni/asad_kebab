<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SellingModel;
use App\Models\BuyingModel;
use App\Models\MenusModel;
use App\Models\UserModel;
use Dompdf\Dompdf;

class Transaction extends BaseController{
    protected $sellingModel;
    protected $buyingModel;

    protected $helpers = ['form'];

    function __construct(){
        $this->buyingModel = new BuyingModel();
        $this->sellingModel = new SellingModel();
    }

    public function overView(){
        $data['title'] = 'Asad Kebab | Transactions';
        return view('pages/transaction/overview', $data);
    }

    public function buyingData(){
        $data['title'] = 'Asad Kebab | Buying Transaction';
        $data['buying'] = $this->buyingModel->orderBy('id ASC')->select('buying.id, cost, menus.menu_name, amount, total_cost, timestamp')->join('menus', 'menus.id = menu_id')->get()->getResult();
        return view('pages/transaction/records', $data);
    }

    public function buyingForm(){
        $menuModel = new MenusModel();
        $data['title'] = 'Asad Kebab | Add Stock';
        $data['menus'] = $menuModel->select('id, menu_name')->where(['status' => 'active'])->get()->getResult();
        return view('pages/transaction/form', $data);
    }

    public function addStock(){
        $rules = [
            'menu_id' => 'required',
            'amount' => 'required',
            'cost' => 'required',
        ];

        if(!$this->validate($rules)){
            return redirect()->back()->withInput(validation_errors());
        }
        $menuModel = new MenusModel();

        $cost = $this->request->getVar('cost');
        $amount = $this->request->getVar('amount');
        $total_cost = $cost * $amount;

        $buying = [
            'menu_id' => $this->request->getVar('menu_id'),
            'amount' => $amount,
            'cost' => $cost,
            'total_cost' => $total_cost,
        ];

        $quantity = $menuModel->select('fin_amount')->where('id', $this->request->getVar('menu_id'))->first();
        $final_amount = $quantity['fin_amount'] + $amount;

        $menus = [
            'id' => $this->request->getVar('menu_id'),
            'buying' => $amount,
            'fin_amount' => $final_amount
        ];
        
        $this->buyingModel->save($buying);
        $buying['timestamp'] = date('d-m-Y_H-i-s');
        $menuModel->save($menus);

        $buying['title'] = 'Invoice';
        $buying['type'] = 'Purchase';
        $buying['menu_name'] = $menuModel->select('menu_name')->where('id', $this->request->getVar('menu_id'))->first();
        
        $this->generatePdf('pages/transaction/invoice', $buying);
        return view('pages/transaction/invoice', $buying);
    }

    public function sellingData(){
        $data['title'] = 'Asad Kebab | Selling Transaction';
        $data['selling'] = $this->sellingModel->orderBy('id ASC')->select('selling.id, menus.menu_name, cost, amount, total_cost, timestamp, user_id, employee_id')->join('menus', 'menus.id = menu_id')->get()->getResult();
        return view('pages/transaction/records', $data);
    }

    public function sellingForm(){
        $menuModel = new MenusModel();
        $userModel = new UserModel();

        $data['title'] = 'Asad Kebab | Add Stock';
        $data['members'] = $userModel->select('id')->where('role', 3)->get()->getResult();
        $data['menus'] = $menuModel->select('id, menu_name, price')->where(['status' => 'active'])->get()->getResult();
        return view('pages/transaction/form', $data);
    }

    public function addTransaction(){
        $rules = [
            'menu_id' => 'required',
            'amount' => 'required',
        ];

        if(!$this->validate($rules)){
            return redirect()->back()->withInput(validation_errors());
        }
        $menuModel = new MenusModel();

        $cost = $this->request->getVar('cost');
        $amount = $this->request->getVar('amount');
        $total_cost = $cost * $amount;

        $selling = [
            'menu_id' => $this->request->getVar('menu_id'),
            'amount' => $amount,
            'cost' => $cost,
            'total_cost' => $total_cost,
            'employee_id' => session('id'),
        ];

        if($this->request->getVar('member_id') != 0){
            $selling['user_id'] = $this->request->getVar('member_id');
        }

        $quantity = $menuModel->select('fin_amount')->where('id', $this->request->getVar('menu_id'))->first();
        $final_amount = $quantity['fin_amount'] - $amount;

        $menus = [
            'id' => $this->request->getVar('menu_id'),
            'selling' => $amount,
            'fin_amount' => $final_amount
        ];

        $this->sellingModel->save($selling);
        $selling['timestamp'] = date('d-m-Y_H-i-s'); 
        $menuModel->save($menus);

        $userModel = new UserModel();

        $selling['title'] = 'Invoice';
        $selling['employee_name'] = $userModel->select('username')->where('id', session('id'))->first();
        $selling['menu_name'] = $menuModel->select('menu_name')->where('id', $this->request->getVar('menu_id'))->first();
        $selling['type'] = 'Selling';

        $this->generatePdf('pages/transaction/invoice', $selling);
        return view('pages/transaction/invoice', $selling);
    }

    public function generatePdf($pages, $data){

        $invoice = view($pages, $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($invoice);
        $dompdf->render();
        $dompdf->stream($data['type'].'_'.$data['timestamp']);
    }


}

?>