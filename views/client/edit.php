{{ include('layouts/header-principal.php') }}

<div class="profile-card">
    <h2>Modifier votre profil</h2>

    <form method="POST" class="profil-form">
        <input type="hidden" name="idUser" value="{{ utilisateur.idUser }}">

        <div class="profile-field">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="{{ utilisateur.name }}">
        </div>
        {% if errors.name is defined %}
            <span class="error">{{ errors.name }}</span>
        {% endif %}

        <div class="profile-field">
            <label for="email">Email :</label>
            <input type="text" id="email" name="email" value="{{ utilisateur.email }}">
        </div>
        {% if errors.email is defined %}
            <span class="error">{{ errors.email }}</span>
        {% endif %}
        
        <div class="profile-field profile-field__last">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password">
        </div>
        <p class="password-hint">Si vous laissez le champ vide, votre mot de passe reste le même</p>
        {% if errors.password is defined %}
            <span class="error">{{ errors.password }}</span>
        {% endif %}
       
        <button type="submit" class="button--edit">Enregistrer les modifications</button>
        <a href="profil" class="profile-return">Annuler</a>
    </form>
</div>
