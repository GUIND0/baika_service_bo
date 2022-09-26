@extends('partials.main')
@section('title1')Ajout d'un automobile
@endsection
@section('content')
<div class="row">
    {{--create form --}}
    <div class="col-md-12">
    <form action="{{ route('automobile.store') }}" method='POST' role="form" id="form">
            @csrf
        <input type="hidden" name="id" value="{{ $automobile->id ?? '' }}">
        <div class="card card-box">
            <div class="card-body">
                <div class="mb-3 col-md-12">
                    <div class="form-group">
                        (<span class="text-danger">*</span>) Champs Obligatoires
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                            <label  class="form-label">Type Automobile</label><span class="text-danger"> *</span>
                            <select class="form-control {{ $errors->has('type_auto') ? 'is-invalid' : ''}}" name="type_auto" id="type_auto"  style="width: 100%;" required>
                                <option value=""> --- Veuillez selectionner un type auto ---</option>
                                @foreach($type_autos as $type_auto)
                                    <option {{ $automobile != null ? $automobile->type_auto_id == $type_auto->id ? 'selected' : '' : old('type_auto') == $type_auto->id ? 'selected' : '' }} value="{{ $type_auto->id }}"> {{ $type_auto->libelle }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type_auto'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('type_auto') }}</li></ul>
                                </span>
                            @endif
                    </div>
                    <div class="mb-3 col-6">
                        <label for="statut" class="form-label">Statut</label><span class="text-danger"> *</span>
                        <select class="form-control {{ $errors->has('statut') ? 'is-invalid' : ''}}" id="statut" name="statut" aria-label="Default select example" aria-placeholder="Choisir statut ..." required>
                            <option value="">-- Statut --</option>
                            <option value="1" {{ ($automobile != null ? $automobile->statut == '1' : old('statut')) == "Libre" ? 'selected' : '' }}>Libre</option>
                            <option value="0" {{ ($automobile != null ? $automobile->statut == '0' : old('statut')) == "Loue" ? 'selected' : '' }}>Loue</option>
                            </select>
                        @if($errors->has('statut'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('statut') }}</li>
                            </span>

                        @endif
                    </div>

                    <div class="mb-3 col-6">
                        <div class="form-group">
                            <label class="control-label">Caracteristique <span class="text-danger"> *</span></label>
                            <input type="text" name="caracteristique" class="form-control {{ $errors->has('caracteristique') ? 'is-invalid' : '' }}"
                                    value="{{ $automobile != null ? $automobile->caracteristique : old('caracteristique') }}" placeholder="caracteristique" required/>
                            @if($errors->has('caracteristique'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('caracteristique') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label">Description <span class="text-danger"> *</span></label>
                            <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    value="{{ $automobile != null ? $automobile->description : old('description') }}" placeholder="description" required/>
                            @if($errors->has('description'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('description') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row d-flex justify-content-center">
                    <div class="demo-inline-spacing d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save mr-1"></i> Enregistrer
                        </button>
                        <button type="reset" class="btn btn-danger">
                            <i class="fa fa-times mr-1"></i>  Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
  $(function() {
    $('#toFormat1').maskMoney();
    $('#toFormat2').maskMoney();
    $('#toFormat3').maskMoney();
  })
  $('.timepicker').datetimepicker({
    format: 'HH:mm',

  })
</script>
@endsection
