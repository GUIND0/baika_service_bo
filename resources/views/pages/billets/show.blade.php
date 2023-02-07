<div class="card">
    <h5 class="card-header"><i class="fa fa-bus"></i> {{ $billet->trajet }} - {{ $billet->compagnie }} - {{ $billet->date_depart }} a {{ $billet->heure_depart }}</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead class="table-light">
          <tr>
            <th>Client</th>
            <th>Telephone</th>
            <th>Nombre billet</th>
            <th>Prix Unitaire (F CFA)</th>
            <th>Total ( FCFA)</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @if(!$get_billets->isEmpty())
                @foreach ($get_billets as $get_billet )
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $get_billet->nom }}</strong></td>
                    <td>{{ $get_billet->telephone }}</td>
                    <td>{{ $get_billet->nbr_billet }}</td>
                    <td>{{number_format($get_billet->pu, 0, ' ', ' ')  }}</td>
                    <td>{{ number_format($get_billet->ttc, 0, ' ', ' ') }}</td>
                </tr>
                @endforeach
            @else
            <tr class="table-danger">
                <td></td>
                <td></td>
                <td>
                        Pas de billet
                </td>
                <td></td>
                <td></td>
              </tr>
            @endif
            <tr><td></td></tr>

        </tbody>
      </table>
    </div>
  </div>
