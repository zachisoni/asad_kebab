<?php

namespace App\Controllers;

use App\Models\BuyingModel;
use App\Models\MenusModel;
use App\Models\SellingModel;

class Home extends BaseController {

    public function index(){
        $sellingModel = new SellingModel();
        $buyingModel = new BuyingModel();
        $menuModel = new MenusModel();

        $data['sellings'] = $sellingModel->select('sum(total_cost) AS selling, count(id) AS count')->get()->getResult();
        $data['purchases'] = $buyingModel->select('sum(total_cost) AS purchase, count(id) AS count')->get()->getResult();
        $data['total_menu'] = $menuModel->select('count(id) AS menu_count')->get()->getResult();

        $data['title'] = 'Asad kebab | Dashboard';
        return view('pages/dashboard/index', $data);
    }
}
