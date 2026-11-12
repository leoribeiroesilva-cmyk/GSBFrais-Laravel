<?php

namespace App\Http\Controllers;

use App\Models\Frais;
use App\Services\FraisService;
use Illuminate\Http\Request;

class FraisController extends Controller
{
    public function listFrais()
    {
        $services =  new FraisService();
        $id_visiteur = session('id_visiteur');
        $fiches = $services->getListFrais($id_visiteur);
        return view('listFrais', compact('fiches'));
    }
    public function addFrais()
    {
        $frais = new Frais();
        $frais->anneemois=date("Y-m");
        return view('formFrais', compact('frais'));
    }
    public function validFrais(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            $services = new FraisService();
            $frais = $services->getFrais($id);
        } else {
            $frais = new Frais();
        }

        $frais->id_visiteur = session('id_visiteur');
        $frais->anneemois = $request->input('mois');
        $frais->nbjustificatifs = $request->input('nbjustif');
        $frais->montantvalide = $request->input('valide');
        $frais->id_etat = $request->input('etat');
        $frais->datemodification = date("y-m-d");

        $services = new FraisService();
        $services->saveFrais($frais);

        return redirect('/listerFrais');
    }
    public function editFrais($id)
    {
        $services = new FraisService();
        $frais = $services->getFrais($id);
        return view('formFrais', compact('frais'));
    }
}
