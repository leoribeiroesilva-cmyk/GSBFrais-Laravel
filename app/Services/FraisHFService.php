<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Models\FraisHF;
use Illuminate\Database\QueryException;

class FraisHFService
{
    public function getListFraisHF($id)
    {
        try {
            $liste = FraisHF::query()
                ->select('fraishorsforfait.*')
                ->where('id_frais', '=', $id)
                ->orderBy('date_fraishorsforfait', 'desc')
                ->get();
            return $liste;
        } catch (QueryException $exception){
            $userMessage="Erreur d'accès à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
    public function getTotalHF($id){
        try {
            $total = FraisHF::query()
                ->where('id_frais', '=', $id)
                ->sum('montant_fraishorsforfait');
            return $total;
        } catch (QueryException $exception){
            $userMessage="Erreur lors de l'addition à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
}
