{{ include('layouts/header-principal.php') }}
{% if stamps is not empty %}
    <h2>Vos timbres :</h2>
    <div class="stamp-list">
        {% for stamp in stamps %}
            <div class="stamp-card">
                {% if stamp.images is empty %}
                    <a href="addImage?{{ stamp.idTimbre }}" class="stamp-card__notice">
                        Ajouter une image à votre timbre !
                    </a>
                {% else %}
                    <div class="stamp-card__images">
                        {% for image in stamp.images %}
                            <img src="data:image/png;base64,{{ image.file }}" alt="{{ image.description }}">
                        {% endfor %}
                    </div>
                {% endif %}

                <div class="stamp-card__text">
                    <h3 class="stamp-card__title">{{ stamp.name }}</h3>

                    <a class="stamp-card__btn" href="stampShow?{{ stamp.idTimbre }}">
                        Voir le timbre
                    </a>

                    {% if stamp.images is not empty %}
                        <a class="stamp-card__btn green" href="#">
                            Créer une enchère
                        </a>
                    {% else %}
                        <a class="stamp-card__btn red" href="#">
                            Ajouter une image
                        </a>
                    {% endif %}
                </div>
            </div>
        {% endfor %}

    </div>
{% else %}
    <p>Aucun timbre trouvé. Ajoutez votre premier timbre !</p>
{% endif %}


<div>
    <a href="stampCreate" class="button_basic">Ajouter un timbre</a>
</div>