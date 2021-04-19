<h1>Edit</h1>
<div>pagina in cui l'utente registrato può modificare i propri dati</div>

<form action="" method="post">
    @csrf  
    @method('PUT')
    <div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Inserisci il nome..." value="{{$user->name}}">
    </div>

    <div class="form-group">
    <label for="lastname">Cognome</label>
    <input type="text" class="form-control" name="lastname" placeholder="Inserisci il cognome..." value="{{$user->lastname}}">
    </div>

    <div class="form-group">
    <label for="lastname">Indirizzo</label>
    <input type="text" class="form-control" name="address" placeholder="Inserisci l'indirizzo..." value="{{$user->address}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('dashboard') }}">Ritorna alla dashboard</a>


</form>