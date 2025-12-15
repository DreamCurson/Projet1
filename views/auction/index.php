{{ include('layouts/header-principal.php') }}
<script type="module" src="{{ asset }}script/page-encheres.js"></script>

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
                            <p class="bloc-enchere__texte-temps">Temps restant :</p>
                        </div>
                        <h3 class="bloc-enchere__sous-titre">{{ auction.name }}</h3>
                        <div class="bloc-enchere__textes">
                            <p class="bloc-enchere__texte">{{ auction.description }}</p>
                            <p class="bloc-enchere__texte">Prix actuel : $</p>
                            <div class="miser">
                                <span class="miser__texte">
                                    <label for="miser{{ auction.id }}">Miser :</label>
                                    <input type="number" id="miser{{ auction.id }}" min="{{ auction.current_price }}" step="0.50" value="{{ auction.current_price }}" class="miser__input" />
                                </span>
                                <button type="button" class="miser__confirmer">Soumettre</button>
                            </div>
                        </div>
                        <a href="#" class="bloc-enchere__lien">Voir l’enchère</a>
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
