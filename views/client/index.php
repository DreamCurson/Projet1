{{ include('layouts/header-principal.php') }}

<div class="profile-card">
    <h2>Votre profil</h2>

    <div class="profile-field">
        <label>Nom :</label>
        <span>{{utilisateur.name}}</span>
    </div>

    <div class="profile-field profile-field__last">
        <label>Email :</label>
        <span>{{utilisateur.email}}</span>
    </div>

    <a href="editProfil"><button class="button--edit">Modifier vos informations</button></a>
</div>