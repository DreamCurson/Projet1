{{ include('layouts/header.php') }}

<img src="{{ img }}logo-bleu.png" alt="Logo" class="logo_erreur" />

<div class="error-page">
    <h1 class="error-page__title">Oups !</h1>
    <p class="error-page__message">{{ message|default('Le système a rencontré une erreur.') }}</p>
    <button class="error-page__button" onclick="history.back()">Retour</button>
</div>

