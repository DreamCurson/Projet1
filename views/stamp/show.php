{{ include('layouts/header-principal.php') }}

<div class="oneStamp">
    <h2 class="oneStamp__title">{{ stamp.name }}</h2>

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

    <a class="oneStamp__backBtn" href="stamp">Retour</a>
</div>
