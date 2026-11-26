<?php

namespace App\Http\Controllers;

use App\Services\FraisHFService;
use App\Services\FraisService;
use Exception;
use Illuminate\Http\Request;

class FraisHFController extends Controller
{
    public function listFraisHF($id){
        try {
            $service = new FraisService();
            $frais = $service->getFrais($id);
            $service = new FraisHFService();
            $fraisHF = $service->getListFraisHF($id);
            $totalHF = $service->getTotalHF($id);
            return view('listFraisHF',compact('frais','fraisHF','id', 'totalHF'));
        } catch (Exception $exception){
            return view('error', compact('exception'));
        }
    }
}
