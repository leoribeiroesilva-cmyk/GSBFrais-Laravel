@extends('layouts.master')

@section('content')
    <form method="post" action="{{ url('/validerFrais') }}">
        {{ csrf_field() }}

        <h1>Ajout Fiche de frais</h1>
        <div class="col-md-12 card card-body bg-light">
            <div class="form-group">
                <label class="col-md-3">Mois :</label>
                <div class="col-md-6">
                    <input type="text" name="mois" value="" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Montant saisi :</label>
                <div class="col-md-6">
                    <input type="number" name="montantsaisi" value="" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Nb justificatifs</label>
                <div class="col-md-6">
                    <input type="number" name="nbjustif" value="" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Montant validé</label>
                <div class="col-md-6">
                    <input type="number" name="valide" value="" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Etat</label>
                <div class="col-md-6">
                    <input type="number" name="etat" value="" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">
                        Valider
                    </button>
                    <button type="button" class="btn btn-secondary"
                            onclick="if (confirm('Annuler la saisie ?')) window.location='{{ url('/') }}'; ">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </form>
