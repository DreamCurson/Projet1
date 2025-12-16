{{ include('layouts/header.php') }}

<img src="{{ img }}logo-bleu.png" alt="Logo" class="logo_erreur" />

<div class="error-page">
    <h1 class="success-page__title">Mise faite !</h1>
    <p class="error-page__message">Vous avez misé avec succès sur l'enchère {{ auction.name }}!</p>
    <button class="error-page__button" onclick="history.back()">Retour</button>
</div>

