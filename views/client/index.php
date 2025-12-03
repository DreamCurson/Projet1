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
    <a href="deleteProfil" onclick="return confirmDelete();">
        <button class="button--delete">Supprimer votre compte</button>
    </a>
    
    <script>
        function confirmDelete() {
            return confirm("Êtes-vous sûr ? Cette action est permanente.");
        }
    </script>
</div>