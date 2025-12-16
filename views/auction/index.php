{{ include('layouts/header-principal.php') }}
<script type="module" src="{{ asset }}script/page-encheres.js"></script>

<section class="filtre">
    <div class="filtre__bloc">
        <h2>Filtres</h2>
        <form class="filtre__formulaire" method="GET" action="auction">
            
            <div class="filtre__section">
                <label for="pays" class="filtre__texte-gras">Pays d'origine</label>
                <select id="pays" name="pays">
                    <option value="all" {% if filters.country == 'all' or filters.country is empty %}selected{% endif %}>Tous les pays</option>
                    {% for country in countries %}
                        <option value="{{ country.idContry }}" {% if filters.country == country.idContry %}selected{% endif %}>{{ country.contry }}</option>
                    {% endfor %}
                </select>
            </div>

            <div class="filtre__section">
                <label for="condition" class="filtre__texte-gras">Condition</label>
                <select id="condition" name="condition">
                    <option value="all" {% if filters.condition == 'all' or filters.condition is empty %}selected{% endif %}>Non spécifié</option>
                    {% for condition in conditions %}
                        <option value="{{ condition.idCondition }}" {% if filters.condition == condition.idCondition %}selected{% endif %}>{{ condition.cond }}</option>
                    {% endfor %}
                </select>
            </div>

            <div class="filtre__section">
                <label for="certifie" class="filtre__texte-gras">Certifié ?</label>
                <select id="certifie" name="certifie">
                    <option value="all" {% if filters.certified == 'all' or filters.certified is empty %}selected{% endif %}>Non spécifié</option>
                    <option value="oui" {% if filters.certified == 'oui' %}selected{% endif %}>Oui</option>
                    <option value="non" {% if filters.certified == 'non' %}selected{% endif %}>Non</option>
                </select>
            </div>
            
            <div class="filtre__section">
                <label for="couleur" class="filtre__texte-gras">Couleur(s)</label>
                <select id="couleur" name="couleur">
                    <option value="all" {% if filters.color == 'all' or filters.color is empty %}selected{% endif %}>Non spécifié</option>
                    {% for color in colors %}
                        <option value="{{ color.idColor }}" {% if filters.color == color.idColor %}selected{% endif %}>{{ color.color }}</option>
                    {% endfor %}
                </select>
            </div>

            <button type="submit" class="filtre__bouton">Recherchez</button>
        </form>
    </div>
</section>

<div class="navigation-enchere">
    <nav class="navigation-enchere__bloc">
        <ul class="navigation-enchere__elements">
            <li class="navigation-enchere__element">
                <a href="#" class="lien-navigation">
                   Enchères en cours
                </a>
            </li>
            <li class="navigation-enchere__element">
                <a href="#" class="lien-navigation">
                   Enchères archivées
                </a>
            </li>
        </ul>
    </nav>
</div>

<section class="enchere-en-cours">
    <div class="bloc-enchere">
        <h2 class="bloc-enchere__titre">Enchère en cours</h2>
        <div class="bloc-enchere__encheres">
            {% for auction in auctions %}
                {% if auction.status == 'active' %}
                    <article class="bloc-enchere__bloc">
                        {% if auction.images is not empty %}
                            <img src="data:image/png;base64,{{ auction.images[0].file }}" alt="{{ auction.name }}" class="bloc-enchere__image" />
                        {% else %}
                            <img src="default-image.jpg" alt="Image invalide" class="bloc-enchere__image" />
                        {% endif %}
                        
                        <div class="bloc-enchere__temps-restant">
                            <p class="bloc-enchere__texte-temps">Temps restant : 
                                <span class="temps-restant">{{ auction.remaining_time }}</span>
                            </p>
                        </div>

                        <h3 class="bloc-enchere__sous-titre">{{ auction.name }}</h3>
                        <div class="bloc-enchere__textes">
                            <p class="bloc-enchere__texte">{{ auction.description }}</p>
                            <p class="bloc-enchere__texte">Prix actuel : {{ auction.current_price }} $</p>
                            <div class="miser">
                            <span class="miser__texte">
                                <label for="miser{{ auction.id }}">Miser :</label>
                                <form method="POST">
                                    <input type="number" id="miser{{ auction.id }}" name="bid" min="{{ auction.current_price }}" step="0.50" value="{{ auction.current_price }}" class="miser__input" />
                                    <input type="hidden" name="auction_id" value="{{ auction.idAuction }}" />
                                    <input type="hidden" name="user_id" value="{{ user_id }}" />
                                    <button type="submit" class="miser__confirmer">Soumettre</button>
                                </form>
                            </span>
                        </div>
                        </div>
                        <a href="auctionShow?id={{ auction.idAuction }}" class="bloc-enchere__lien">Voir l’enchère</a>
                    </article>
                {% endif %}
            {% endfor %}
        </div>
    </div>
</section>

<section class="enchere-archivé">
    <div class="bloc-enchere">
        <h2 class="bloc-enchere__titre">Enchères archivées</h2>
        <div class="bloc-enchere__encheres">
            {% for auction in auctions %}
                {% if auction.status == 'ended' %}
                    <article class="bloc-enchere__bloc">
                        {% if auction.images is not empty %}
                            <img src="data:image/png;base64,{{ auction.images[0].file }}" alt="{{ auction.name }}" class="bloc-enchere__image" />
                        {% else %}
                            <img src="default-image.jpg" alt="Image invalide" class="bloc-enchere__image" />
                        {% endif %}
                        
                        <div class="bloc-enchere__temps-restant">
                            <p class="bloc-enchere__texte-temps">Enchère terminé le {{ auction.end_date | date('d/m/Y') }}</p>
                        </div>
                        <h3 class="bloc-enchere__sous-titre">{{ auction.name }}</h3>
                        <div class="bloc-enchere__textes">
                            <p class="bloc-enchere__texte">{{ auction.description }}</p>
                            <p class="bloc-enchere__texte">Prix final de vente : {{ auction.current_price }}$</p>
                        </div>
                    </article>
                {% endif %}
            {% endfor %}
        </div>
    </div>
</section>
