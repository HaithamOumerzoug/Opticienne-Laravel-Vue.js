<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    
    <img src="https://zupimages.net/up/21/03/d7xh.png"  alt="" width="60" height="60" style="border-radius: 5px">
    <h1 class="text-center" style="color: red">Opticienne</h1>
    
    <br>
    <!-- Content Row --> 
    <h2 class="text-align-center"><u>Liste des fournisseurs :</u></h2>
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">N° patient</th>
                <th scope="col">Nom Fournisseur</th>
                <th scope="col">Pays</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Adresse</th>
                <th scope="col">Ville</th>
                <th scope="col">Code podtale</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($fournisseurs as $fournisseur)
                <tr>
                    <th scope="row">{{ $fournisseur->id }}</th>
                    <td>{{ $fournisseur->Nom_fourn }}</td>
                    <td>{{ $fournisseur->pays }}</td>
                    <td>{{ $fournisseur->Telephone_fourn }}</td>
                    <td>{{ $fournisseur->Adresse_fourn }}</td>
                    <td>{{ $fournisseur->Ville }}</td>
                    <td>{{ $fournisseur->Codepostale }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</body>
