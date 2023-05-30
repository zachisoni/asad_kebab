<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionsModel;
use App\Models\SellingModel;
use App\Models\PurchasesModel;
use App\Models\MenusModel;
use App\Models\UserModel;

class Transaction extends BaseController{
    protected $sellingModel;
    protected $purchasesModel;
    protected $transactionsModel;

    protected $helpers = ['form'];

    function __construct(){
        $this->purchasesModel = new PurchasesModel();
        $this->sellingModel = new SellingModel();
        $this->transactionsModel = new TransactionsModel();
    }

    public function overView(){
        $data['title'] = 'Asad Kebab | Transactions';
        return view('pages/transaction/overview', $data);
    }

    public function purchaseData(){
        
        $data['title'] = 'Asad Kebab | Buying Transaction';
        $data['purchase'] = $this->transactionsModel->orderBy('id ASC')->select('id, user_id, employee_id, timestamp, total_cost')->where('transaction_type', 'purchase')->get()->getResult();
        return view('pages/transaction/records', $data);
    }
    
    public function purchaseDetail($id){
        $userModel = new UserModel();
        $data['title'] = 'Asad Kebab | Transaction Detail';
        $data['header'] = $this->transactionsModel->select('transactions.id, users.fullname, total_cost, timestamp, transaction_type')->join('users', 'users.id = employee_id')->where('transactions.id',$id)->get()->getResult();
        $data['details'] = $this->purchasesModel->orderBy('id ASC')->select('purchases.id, menus.menu_name, purchases.price, amount, total_cost')->join('menus', 'menus.id = menu_id')->where('transaction_id', $id)->get()->getResult();
        return view('pages/transaction/invoice', $data);
    }

    public function purchaseForm(){
        $menuModel = new MenusModel();
        $data['title'] = 'Asad Kebab | Add Stock';
        $data['menus'] = $menuModel->select('id, menu_name')->where(['status' => 'active'])->get()->getResult();
        return view('pages/transaction/form', $data);
    }

    public function addStock(){
        $size = $this->request->getVar('size');
        $menuModel = new MenusModel();
        $total_cost = 0;
        $total_amount = 0;

        for ($i=0; $i < $size; $i++) { 
            $cost = $this->request->getVar("cost[$i]");
            $amount = $this->request->getVar("amount[$i]");
            $total_amount += $amount;
            $total_cost += $cost * $amount;
        }
        $transaction = [
            'employee_id' => session('id'),
            'transaction_type' => 'purchase',
            'total_cost' => $total_cost,
        ];
        
        $this->transactionsModel->save($transaction);
        $transaction_id = $this->transactionsModel->orderBy('id DESC')->select('id')->first();
        $trans_id = $transaction_id['id'];

        for ($i=0; $i < $size; $i++) { 
            $cost = $this->request->getVar("cost[$i]");
            $amount = $this->request->getVar("amount[$i]");

            $purchase = [
                'transaction_id' => $trans_id,
                'menu_id' => $this->request->getVar("menu_id[$i]"),
                'price' => $cost,
                'amount' => $amount,
                'total_cost' => $cost * $amount,
            ];

            dd($purchase);
            
            $this->purchasesModel->save($purchase);

            $quantity = $menuModel->select('fin_amount, purchase')->where('id', $this->request->getVar("menu_id[$i]"))->first();
            $final_amount = $quantity['fin_amount'] + $amount;
            $buyingMenu = $quantity['purchase'] + $amount;

            $menus = [
                'id' => $this->request->getVar("menu_id[$i]"),
                'buying' => $buyingMenu,
                'fin_amount' => $final_amount,
            ];
            $menuModel->save($menus);  
        }
        
        $menuModel->save($menus);   

        // $purchase['timestamp'] = date('d-m-Y H:i:s');

        // $purchase['title'] = 'Invoice';
        // $purchase['type'] = 'Purchase';
        // $purchase['menu_name'] = $menuModel->select('menu_name')->where('id', $this->request->getVar('menu_id'))->first();
        
        // $this->generatePdf('pages/transaction/invoice', $purchase);
        return redirect()->to('purchases');
    }

    public function sellingData(){
        $data['title'] = 'Asad Kebab | Selling Transaction';
        $data['selling'] = $this->transactionsModel->orderBy('id ASC')->select('id, user_id, employee_id, timestamp, total_cost')->where('transaction_type', 'selling')->get()->getResult();
        return view('pages/transaction/records', $data);
    }

    public function sellingDetail($id){
        $userModel = new UserModel();
        $data['title'] = 'Asad Kebab | Transaction Detail';
        $data['header'] = $this->transactionsModel->select('transactions.id, users.fullname, total_cost, timestamp, transaction_type')->join('users', 'users.id = employee_id')->where('transactions.id',$id)->get()->getResult();
        $data['details'] = $this->sellingModel->orderBy('id ASC')->select('sellings.id, menus.menu_name, menus.price, amount, total_cost')->join('menus', 'menus.id = menu_id')->where('transaction_id', $id)->get()->getResult();
        // dd($data);
        return view('pages/transaction/invoice', $data);
    }

    public function sellingForm(){
        $menuModel = new MenusModel();
        $userModel = new UserModel();

        $data['title'] = 'Asad Kebab | Add Stock';
        $data['members'] = $userModel->select('id, fullname')->where('role', 3)->get()->getResult();
        $data['menus'] = $menuModel->select('id, menu_name, price, fin_amount')->where(['status' => 'active'])->get()->getResult();
        return view('pages/transaction/form', $data);
    }

    public function addTransaction(){
        $size = $this->request->getVar('size');

        // $rules = [
        //     'menu_id' => 'required',
        //     'amount' => 'required',
        // ];

        // if(!$this->validate($rules)){
        //     return redirect()->back()->withInput(validation_errors());
        // }

        $menuModel = new MenusModel();
        $total_cost = 0;

        $total_amount = 0;

        for ($i=0; $i < $size; $i++) { 
            $menuModel = new MenusModel();
            $cost = $menuModel->select('price')->where('id',$this->request->getVar("menu_id[$i]"))->first();
            $amount = $this->request->getVar("amount[$i]");
            $total_amount += $amount;
            $total_cost += $cost['price'] * $amount;
        }

        $transaction = [
            'employee_id' => session('id'),
            'transaction_type' => 'selling',
            'total_cost' => $total_cost,
        ];
        
        $this->transactionsModel->save($transaction);
        
        $transaction_id = $this->transactionsModel->orderBy('id DESC')->select('id')->first();
        $trans_id = $transaction_id['id'];
        for ($i=0; $i < $size; $i++) { 
            $cost = $menuModel->select('price')->where('id',$this->request->getVar("menu_id[$i]"))->first();
            $amount = $this->request->getVar("amount[$i]");

            $selling = [
                'transaction_id' => $trans_id,
                'menu_id' => $this->request->getVar("menu_id[$i]"),
                'amount' => $amount,
                'total_cost' => $cost['price'] * $amount,
            ];

            $this->sellingModel->save($selling);

            $quantity = $menuModel->select('fin_amount, selling')->where('id', $this->request->getVar("menu_id[$i]"))->first();
            $final_amount = $quantity['fin_amount'] - $amount;
            $sellingMenu = $quantity['selling'] + $amount;

            $menus = [
                'id' => $this->request->getVar("menu_id[$i]"),
                'buying' => $sellingMenu,
                'fin_amount' => $final_amount,
            ];
            $menuModel->save($menus);   
            
        }
        

        // $cost = $this->request->getVar('cost');
        // $amount = $this->request->getVar('amount');
        // $total_cost = $cost * $amount;

        // $selling = [
        //     'menu_id' => $this->request->getVar('menu_id'),
        //     'amount' => $amount,
        //     'cost' => $cost,
        //     'total_cost' => $total_cost,
        //     'employee_id' => session('id'),
        // ];

        // if($this->request->getVar('member_id') != 0){
        //     $selling['user_id'] = $this->request->getVar('member_id');
        // }

        // $quantity = $menuModel->select('fin_amount')->where('id', $this->request->getVar('menu_id'))->first();
        // $final_amount = $quantity['fin_amount'] - $amount;

        // $menus = [
        //     'id' => $this->request->getVar('menu_id'),
        //     'selling' => $amount,
        //     'fin_amount' => $final_amount
        // ];

        // $this->sellingModel->save($selling);
        // $selling['timestamp'] = date('d-m-Y H:i:s'); 
        // $menuModel->save($menus);

        // $userModel = new UserModel();

        // $selling['title'] = 'Invoice';
        // $selling['employee_name'] = $userModel->select('username')->where('id', session('id'))->first();
        // $selling['menu_name'] = $menuModel->select('menu_name')->where('id', $this->request->getVar('menu_id'))->first();
        // $selling['type'] = 'Selling';

        // $this->generatePdf('pages/transaction/invoice', $selling);
        return redirect()->to('sellings');
    }

    // public function generatePdf($pages, $data){

    //     $invoice = view($pages, $data);
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml($invoice);
    //     $dompdf->render();
    //     $dompdf->stream($data['type'].'_'.$data['timestamp']);
    // }


}

?>