{{ include('layouts/header-principal.php') }}

<h2>{{ stamp.name }}</h2>

<p>Date de création : {{ stamp.dateCreated|date('Y-m-d') }}</p>

<p>Dimensions : {{ stamp.dimension }}</p>

<p>Certifié : {{ stamp.certified ? 'Oui' : 'Non' }}</p>

<p>Dessin : {{ stamp.draw }}</p>

<p>Condition :
    {% for cond in conditions %}
        {% if cond.idCondition == stamp.condition_idCondition %}
            {{ cond.cond }}
        {% endif %}
    {% endfor %}
</p>

<p>Pays :
    {% for c in contries %}
        {% if c.idContry == stamp.contry_idContry %}
            {{ c.contry }}
        {% endif %}
    {% endfor %}
</p>

<p>Couleur :
    {% for col in colors %}
        {% if col.idColor == stamp.color_idColor %}
            {{ col.color }}
        {% endif %}
    {% endfor %}
</p>

<a href="stamp">Retour</a>