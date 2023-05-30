<?php

namespace App\Controllers;

use App\Models\TransactionsModel;
use App\Models\MenusModel;

class Home extends BaseController {

    public function index(){
        $transactionModel = new TransactionsModel();
        $menuModel = new MenusModel();

        $data['sellings'] = $transactionModel->select('sum(total_cost) AS selling, count(id) AS count')->where('transaction_type', 'selling')->get()->getResult();
        $data['purchases'] = $transactionModel->select('sum(total_cost) AS purchase, count(id) AS count')->where('transaction_type', 'purchase')->get()->getResult();
        $data['total_menu'] = $menuModel->select('count(id) AS menu_count')->get()->getResult();

        $data['title'] = 'Asad kebab | Dashboard';
        return view('pages/dashboard/index', $data);
    }
}
