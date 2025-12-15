{{ include('layouts/header-principal.php') }}
<h1 class="formulaire-ajouter__titre">Ajouter un timbre</h1>

<form class="formulaire-ajouter" method="POST">
    <input type="hidden" name="idTimbre" value="{{ idTimbre }}">

    <div class="formulaire-ajouter__field">
        <label for="name" class="formulaire-ajouter__label">Nom du timbre:</label>
        <input type="text" id="name" name="name" class="formulaire-ajouter__input"  value="{{ stamp.name }}">
    </div>
    {% if errors.name is defined %}
        <span class="error">{{ errors.name }}</span>
    {% endif %}

    <div class="formulaire-ajouter__field">
        <label for="dateCreated" class="formulaire-ajouter__label">Date de création:</label>
        <input type="date" id="dateCreated" name="dateCreated" class="formulaire-ajouter__input" value="{{ stamp.dateCreated }}">
    </div>
    {% if errors.dateCreated is defined %}
        <span class="error">{{ errors.dateCreated }}</span>
    {% endif %}

    <div class="formulaire-ajouter__field">
        <label for="dimension" class="formulaire-ajouter__label">Dimension:</label>
        <input type="text" id="dimension" name="dimension" class="formulaire-ajouter__input" value="{{ stamp.dimension }}">
    </div>
    {% if errors.dimension is defined %}
        <span class="error">{{ errors.dimension }}</span>
    {% endif %}

    <div class="formulaire-ajouter__field">
        <label for="condition_idCondition" class="formulaire-ajouter__label">Condition du timbre:</label>
        <select id="condition_idCondition" name="condition_idCondition" class="formulaire-ajouter__select">
            {% for condition in conditions %}
                <option value="{{ condition.idCondition }}"
                    {% if condition.idCondition == stamp.condition_idCondition %}selected{% endif %}
                    class="formulaire-ajouter__option">
                    {{ condition.cond }}
                </option>
            {% endfor %}
        </select>
    </div>
    {% if errors.condition_idCondition is defined %}
        <span class="error">{{ errors.condition_idCondition }}</span>
    {% endif %}

    <div class="formulaire-ajouter__field">
        <label for="contry_idContry" class="formulaire-ajouter__label">Pays du timbre:</label>
        <select id="contry_idContry" name="contry_idContry" class="formulaire-ajouter__select">
            {% for contry in contries %}
                <option 
                    value="{{ contry.idContry }}" 
                    class="formulaire-ajouter__option"
                    {% if contry.idContry == stamp.contry_idContry %}selected{% endif %}
                >
                    {{ contry.contry }}
                </option>
            {% endfor %}
        </select>
    </div>
    {% if errors.contry_idContry is defined %}
        <span class="error">{{ errors.contry_idContry }}</span>
    {% endif %}

    <div class="formulaire-ajouter__field">
        <label for="color_idColor" class="formulaire-ajouter__label">Couleur du timbre:</label>
        <select id="color_idColor" name="color_idColor" class="formulaire-ajouter__select">
            {% for color in colors %}
                <option 
                    value="{{ color.idColor }}" 
                    class="formulaire-ajouter__option"
                    {% if color.idColor == stamp.color_idColor %}selected{% endif %}
                >
                    {{ color.color }}
                </option>
            {% endfor %}
        </select>
    </div>

    {% if errors.color_idColor is defined %}
        <span class="error">{{ errors.color_idColor }}</span>
    {% endif %}

    <div class="formulaire-ajouter__field">
        <label for="draw" class="formulaire-ajouter__label">Dessin:</label>
        <textarea id="draw" name="draw" class="formulaire-ajouter__textarea" rows="4">{{ stamp.draw }}</textarea>
    </div>
    {% if errors.draw is defined %}
        <span class="error">{{ errors.draw }}</span>
    {% endif %}

    <button type="submit" class="formulaire-ajouter__button">Ajouter le timbre</button>
    <a href="stampShow?{{ idTimbre }}" class="formulaire-ajouter__return">Annuler</a>
</form>
