{{ include('layouts/header-principal.php') }}

{% if stamps is not empty %}
    <h2 class="stamp-list__title">Vos timbres :</h2>
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

                    {% if stamp.has_active_auction %}
                        {% if stamp.auction_status == 'active' %}
                            <!-- Enchere en cours -->
                            <a class="stamp-card__btn yellow" href="auctionDetail?{{ stamp.idTimbre }}">
                                Enchère en cours
                            </a>
                        {% elseif stamp.auction_status == 'upcoming' %}
                            <!-- L'enchere na pas commencer encore -->
                            <a class="stamp-card__btn yellow-orange" href="auctionDetail?{{ stamp.idTimbre }}">
                                L'enchère débute le {{ stamp.auction_start_date | date('d/m/y') }}
                            </a>
                        {% endif %}
                    {% elseif stamp.images is not empty %}
                        <!-- Si il y a une image mais pas d'enchère encore -->
                        <a class="stamp-card__btn green" href="auctionCreate?{{ stamp.idTimbre }}">
                            Créer une enchère
                        </a>
                    {% else %}
                        <!-- Si il n'y a pas d'image -->
                        <a class="stamp-card__btn red" href="addImage?{{ stamp.idTimbre }}">
                            Ajouter une image
                        </a>
                    {% endif %}
                </div>
            </div>
        {% endfor %}
    </div>
{% else %}
    <p class="stamp-card__notice-text">Aucun timbre trouvé. Ajoutez votre premier timbre !</p>
{% endif %}

<div>
    <a href="stampCreate" class="button_basic">Ajouter un timbre</a>
</div>
