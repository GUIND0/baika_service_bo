@extends('partials.main')
@section('title1')Ajout d'un ticket
@endsection
@section('content')
<div class="row">
    {{--create form --}}
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Formulaire d'enregistrement.
                <a href="{{ route('ticket.index') }}" class="btn btn-outline-success pull-right">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </h5>
            <form action="{{ route('ticket.store') }}" method='POST' role="form" id="form">
                @csrf
                <input type="hidden" name="id" value="{{ $ticket->id ?? '' }}">
                <div class="card-body">
                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            (<span class="text-danger">*</span>)Champs Obligatoires
                        </div>
                    </div>
                   <div class="row">


                    <div class="mb-3 col-md-6">
                        <label class="control-label">Ticket Restant <span class="text-danger"> *</span></label>
                        <input type="numeric" name="ticket_restant" class="form-control {{ $errors->has('ticket_restant') ? 'is-invalid' : '' }}"
                                value="{{ $ticket != null ? $ticket->ticket_restant : old('ticket_restant') }}" placeholder="Ticket Restant" required/>
                        @if($errors->has('ticket_restant'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('ticket_restant') }}</li>
                        </span>
                        @endif
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label class="control-label">Prix(F CFA) <span class="text-danger"> *</span></label>
                            <input type="text" name="prix" class="form-control prix {{ $errors->has('prix') ? 'is-invalid' : '' }}"
                                    value="{{ $ticket != null ? $ticket->prix : old('prix') }}" placeholder="Prix" id="prix" required/>
                            @if($errors->has('prix'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('prix') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label class="control-label">Date Depart <span class="text-danger"> *</span></label>
                            <input class="form-control {{ $errors->has('date_depart') ? 'is-invalid' : '' }}" type="date" name="date_depart"  id="html5-time-input"
                            value="{{ $ticket != null ? $ticket->date_depart : old('date_depart') }}" placeholder="Date de depart" required />
                            @if($errors->has('date_depart'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('date_depart') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label class="control-label">Heure Depart <span class="text-danger"> *</span></label>
                            <input type="time" name="heure_depart" class="form-control  {{ $errors->has('heure_depart') ? 'is-invalid' : '' }}"
                                    value="{{ $ticket != null ? $ticket->heure_depart : old('heure_depart') }}" placeholder="Heure de depart" required/>
                            @if($errors->has('heure_depart'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('heure_depart') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 col-md-6" >
                        <div class="form-group">
                            <label>Compagnie</label><span class="text-danger"> *</span>
                            <select class="form-control" name="compagnie" id="compagnie"  style="width: 100%;">'
                                <option value=""> --- Veuillez selectionner une Compagnie ---</option>
                                @foreach($compagnies as $compagnie)
                                    <option {{ $ticket != null ? $ticket->compagnies_id == $compagnie->id ? 'selected' : '' : old('compagnie') == $compagnie->id ? 'selected' : '' }} value="{{ $compagnie->id }}">{{ $compagnie->libelle }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('compagnie'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('compagnie') }}</li></ul>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label>Trajet</label><span class="text-danger">*</span>
                            <select class="form-control" name="trajet" id="trajet"  style="width: 100%;">'
                                <option value=""> --- Veuillez selectionner un trajet ---</option>
                                @foreach($trajets as $trajet)
                                    <option {{ $ticket != null ? $ticket->trajets_id == $trajet->id ? 'selected' : '' : old('trajet') == $trajet->id ? 'selected' : '' }} value="{{ $trajet->id }}"> {{ $trajet->depart }} / {{ $trajet->arrivee }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('trajet'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('trajet') }}</li></ul>
                                </span>
                            @endif
                        </div>
                    </div>


                    </div>
                </div>
                <div class="mb-3">
                    <div class="row d-flex justify-content-center">
                        <div class="demo-inline-spacing d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save mr-1"></i> Enregistrer
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-times mr-1"></i>  Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
   $(function() {
    $('.prix').mask("# ##0", {reverse: true});
  })


</script>
@endsection
