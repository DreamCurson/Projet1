{{ include('layouts/header-principal.php') }}
{% if stamps is not empty %}
    <div class="stamp-list">
        <h2>Vos timbres :</h2>

        {% for stamp in stamps %}
            <div class="stamp-card">

                <h3>{{ stamp.name }}</h3>

                <a class="btn" href="stampShow?{{ stamp.idTimbre }}">
                    Voir le timbre
                </a>

            </div>
        {% endfor %}

    </div>
{% else %}
    <p>Aucun timbre trouvé. Ajouté votre premier timbre</p>
{% endif %}

<div>
    <a href="stampCreate" class="button_basic">Ajouter un timbre</a>
</div>