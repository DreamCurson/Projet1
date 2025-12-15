{{ include('layouts/header-principal.php') }}
<h1 class="formulaire-ajouter__titre">Créer l'enchère pour le timbre {{ timbreName }}</h1>

<form class="formulaire-ajouter" method="POST">
    <input type="" name="timbre_idTimbre" value="{{ id }}">

    <div class="formulaire-ajouter__field">
        <label for="name" class="formulaire-ajouter__label">Nom de l'enchère :</label>
        <input type="text" id="name" name="name" class="formulaire-ajouter__input"  value="{{ auction.name }}">
    </div>
    {% if errors.name is defined %}
        <span class="error">{{ errors.name }}</span>
    {% endif %}

    <div class="formulaire-ajouter__field">
        <label for="description" class="formulaire-ajouter__label">Description :</label>
        <textarea id="description" name="description" class="formulaire-ajouter__textarea" rows="4">{{ auction.description }}</textarea>
    </div>
    {% if errors.description is defined %}
        <span class="error">{{ errors.description }}</span>
    {% endif %}

    <div class="formulaire-ajouter__flex">
        <div class="formulaire-ajouter__field">
            <label for="dateStart" class="formulaire-ajouter__label">Date de début :</label>
            <input type="date" id="dateStart" name="dateStart" class="formulaire-ajouter__input" value="{{ auction.dateStart }}">
        </div>

        <div class="formulaire-ajouter__field">
            <label for="dateEnd" class="formulaire-ajouter__label">Date de Fin :</label>
            <input type="date" id="dateEnd" name="dateEnd" class="formulaire-ajouter__input" value="{{ auction.dateEnd }}">
        </div>
    </div>
    {% if errors.dateStart is defined %}
        <span class="error">{{ errors.dateStart }}</span>
    {% elseif errors.dateEnd is defined %}
        <span class="error">{{ errors.dateEnd }}</span>
    {% endif %}


    <div class="formulaire-ajouter__field">
        <label for="startPrize" class="formulaire-ajouter__label">
            Mise minimale de départ :
        </label>
        <input
            type="number"
            id="startPrize"
            name="startPrize"
            class="formulaire-ajouter__input"
            step="0.01"
            min="0.01"
            value="{{ auction.startPrize }}"
        >
    </div>

    {% if errors.startPrize is defined %}
        <span class="error">{{ errors.startPrize }}</span>
    {% endif %}

    <button type="submit" class="formulaire-ajouter__button">Ajouter le timbre</button>
    <a href="stamp" class="formulaire-ajouter__return">Annuler</a>
</form>
