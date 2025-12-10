{{ include('layouts/header-principal.php') }}

<div class="oneStamp">
    <h2 class="oneStamp__title">{{ stamp.name }}</h2>
    {% if stamp.images is not empty %}
        <div class="oneStamp__image">
            <img src="data:image/png;base64,{{ stamp.images[0].file }}" alt="Image du timbre">
        </div>
    {% else %}
        <p class="oneStamp__noImage">Aucune image à ce jour</a>
    {% endif %}


    <p class="oneStamp__field"><strong>Date de création :</strong> {{ stamp.dateCreated|date('Y-m-d') }}</p>
    <p class="oneStamp__field"><strong>Dimensions :</strong> {{ stamp.dimension }}</p>
    <p class="oneStamp__field"><strong>Certifié :</strong> {{ stamp.certified ? 'Oui' : 'Non' }}</p>
    <p class="oneStamp__field"><strong>Dessin :</strong> {{ stamp.draw }}</p>

    <p class="oneStamp__field"><strong>Condition :</strong>
        {% for cond in conditions %}
            {% if cond.idCondition == stamp.condition_idCondition %}
                {{ cond.cond }}
            {% endif %}
        {% endfor %}
    </p>

    <p class="oneStamp__field"><strong>Pays :</strong>
        {% for c in contries %}
            {% if c.idContry == stamp.contry_idContry %}
                {{ c.contry }}
            {% endif %}
        {% endfor %}
    </p>

    <p class="oneStamp__field"><strong>Couleur :</strong>
        {% for col in colors %}
            {% if col.idColor == stamp.color_idColor %}
                {{ col.color }}
            {% endif %}
        {% endfor %}
    </p>

    <div>
        <a class="oneStamp__backBtn green" href="stampEdit?{{ stamp.idTimbre }}">Modifier le timbre</a>
        {% if stamp.images is not empty %}
        <a class="oneStamp__backBtn greenlight" href="imageEdit?{{ stamp.images[0].idImage }}">Modifier l'image</a>
        {% else %}
        <a href="addImage?{{ stamp.idTimbre }}" class="oneStamp__backBtn greenlight">Ajouter une image</a>
        {% endif %}
        <a class="oneStamp__backBtn red" href="stampDelete?{{ stamp.idTimbre }}" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce timbre ? Cette action est permanente');">
            Supprimer le timbre
        </a>
    </div>
    <a class="oneStamp__backBtn" href="stamp">❮‎ ‎ Retour</a>
</div>
