@extends('layouts.master')

@section('content')
    <form method="post" action="{{ url('/validerFrais') }}">
        {{ csrf_field() }}

        <h1>@if($frais->id_frais) Modification @else Ajout @endif Fiche de frais</h1>
        <div class="col-md-12 card card-body bg-light">
            <div class="form-group">
                <label class="col-md-3" >Identifiant :</label>
                <div class="col-md-6">
                    <input type="hidden" name="id" value="{{ $frais->id_frais }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Mois :</label>
                <div class="col-md-6">
                    <input type="text" name="mois" value="{{ $frais->anneemois }}" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Montant saisi :</label>
                <div class="col-md-6">
                    <input type="number" name="montantsaisi" value="" disabled>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <a href="" class="btn btn-info @if(!$frais->id_frais) disabled @endif"> Frais hors forfait</a>
                    <a href="" class="btn btn-info @if(!$frais->id_frais) disabled @endif"> Frais au forfait</a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Titre :</label>
                <div class="col-md-6">
                    <input type="text" name="titre" value="{{ $frais->titre }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Nb justificatifs</label>
                <div class="col-md-6">
                    <input type="number" name="nbjustif" value="{{ $frais->nbjustificatifs }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Montant validé</label>
                <div class="col-md-6">
                    <input type="number" name="valide" value="{{ $frais->montantvalide }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Etat</label>
                <div class="col-md-6">
                    <select name="etat" class="form-control">
                    @foreach($etats as $etat)
                        <option value="{{ $etat->id_etat }}" @if($frais->id_etat == $etat->id_etat) selected @endif> {{ $etat->lib_etat }}</option>
                    @endforeach
                    </select>
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
                    @if($frais->id_frais)
                        <a href="{{url('/supprimerFrais/'.$frais->id_frais) }}"
                        id="suppr" class="btn btn-danger"
                        onclick="return confirm('Supprimer cette fiche de frais ?')">
                            Supprimer
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </form>
    @if(isset($erreur))
        <div class="alert alert-danger" role="alert">{{ $erreur }}</div>
    @endif
@endsection
