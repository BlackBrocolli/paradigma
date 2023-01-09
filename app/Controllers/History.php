<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\HistoryModel;

class History extends BaseController
{
    public function index(){
        $model = new HistoryModel();
        $data['peminjaman'] = $model->getData();
        echo view('history',$data);
    }
    
}
