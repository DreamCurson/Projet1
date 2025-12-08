{{ include('layouts/header-principal.php') }}
<h1>Ajouter un timbre</h1>

<form class="formulaire-ajouter" method="POST">
    <div class="formulaire-ajouter__field">
        <label for="name" class="formulaire-ajouter__label">Nom du timbre:</label>
        <input type="text" id="name" name="name" class="formulaire-ajouter__input">
    </div>

    <div class="formulaire-ajouter__field">
        <label for="dateCreated" class="formulaire-ajouter__label">Date de création:</label>
        <input type="date" id="dateCreated" name="dateCreated" class="formulaire-ajouter__input">
    </div>

    <div class="formulaire-ajouter__field">
        <label for="dimension" class="formulaire-ajouter__label">Dimension:</label>
        <input type="text" id="dimension" name="dimension" class="formulaire-ajouter__input">
    </div>

    <div class="formulaire-ajouter__field">
        <label for="condition_idCondition" class="formulaire-ajouter__label">Condition du timbre:</label>
        <select id="condition_idCondition" name="condition_idCondition" class="formulaire-ajouter__select">
            {% for condition in conditions %}
                <option value="{{ condition.idCondition }}" class="formulaire-ajouter__option">{{ condition.cond }}</option>
            {% endfor %}
        </select>
    </div>

    <div class="formulaire-ajouter__field">
        <label for="contry_idContry" class="formulaire-ajouter__label">Pays du timbre:</label>
        <select id="contry_idContry" name="contry_idContry" class="formulaire-ajouter__select">
            {% for contry in contries %}
                <option value="{{ contry.idContry }}" class="formulaire-ajouter__option">{{ contry.contry }}</option>
            {% endfor %}
        </select>
    </div>

    <div class="formulaire-ajouter__field">
        <label for="color_idColor" class="formulaire-ajouter__label">Couleur du timbre:</label>
        <select id="color_idColor" name="color_idColor" class="formulaire-ajouter__select">
            {% for color in colors %}
                <option value="{{ color.idColor }}" class="formulaire-ajouter__option">{{ color.color }}</option>
            {% endfor %}
        </select>
    </div>

    <div class="formulaire-ajouter__field">
        <label for="draw" class="formulaire-ajouter__label">Dessin:</label>
        <textarea id="draw" name="draw" class="formulaire-ajouter__textarea" rows="4"></textarea>
    </div>

    <button type="submit" class="formulaire-ajouter__button">Ajouter le timbre</button>
    <a href="profil" class="formulaire-ajouter__return">Annuler</a>
</form>
