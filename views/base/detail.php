{{ include('layouts/header-principal.php') }}
<script type="module" src="{{ asset }}script/page-timbre.js"></script>

<div class="presentation-timbre">
    <div class="presentation-timbre__content">
      <div class="presentation-timbre__images">
          <div class="presentation-timbre__image-principal-section">
          {% if auction.images is not empty %}
          <img
              id="myimage"
              class="presentation-timbre__image-principal"
              src="data:{{ auction.images[0].mime }};base64,{{ auction.images[0].file }}"
              alt="Main Image"
          />
          {% else %}
          <img
              class="presentation-timbre__image-principal"
              src=""
              alt="Erreur lors du chargement de l'image"
          />
          {% endif %}
          </div>
      </div>

      <section class="boite-timbre__grow">
        <article class="description-general">
          <div class="description-general__boite boite-timbre">
            <h2 class="description-general__titre boite-timbre__titre">
              {{auction.name}}
            </h2>
            <div class="description-general__elements">
              <div class="description-general__prix__temps">
                <p class="description-general__chrono">2 jour, 3 heures</p>
              </div>
              <p class="description-general__prix">{{ auction.current_price }} $</p>
            </div>
            <p class="description-general__description">
              {{auction.description}}
            </p>
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
        </article>

        <details class="description boite-timbre">
          <summary class="description__titre boite-timbre__titre">
            Information du timbre
          </summary>
          <div class="description__elements">
            <div class="description__element">
              <h3 class="description__titre-element">Pays d'origine :</h3>
              <p class="description__valeur-element">
                  {% for c in contries %}
                      {% if c.idContry == stamp.contry_idContry %}
                          {{ c.contry }}
                      {% endif %}
                  {% endfor %}
              </p>
            </div>
            <div class="description__element">
              <h3 class="description__titre-element">Condition :</h3>
              <p class="description__valeur-element">
                  {% for cond in conditions %}
                      {% if cond.idCondition == stamp.condition_idCondition %}
                          {{ cond.cond }}
                      {% endif %}
                  {% endfor %}
              </p>
            </div>
            <div class="description__element">
              <h3 class="description__titre-element">Dimension :</h3>
              <p class="description__valeur-element">{{ stamp.dimension }}</p>
            </div>
            <div class="description__element">
              <h3 class="description__titre-element">Certifié :</h3>
              <p class="description__valeur-element">
                  {{ stamp.certified ? 'Oui' : 'Non' }}
              </p>
            </div>
            <div class="description__element">
              <h3 class="description__titre-element">Couleur principal :</h3>
              <div class="description__bloc-couleur">
                <p class="description__valeur-element">
                  {% for col in colors %}
                      {% if col.idColor == stamp.color_idColor %}
                          {{ col.color }}
                      {% endif %}
                  {% endfor %}
                </p>
             </div>
            </div>
          </div>
        </details>

        <details class="description boite-timbre">
          <summary class="description__titre boite-timbre__titre">
            Information de l'enchère
          </summary>
          <div class="description__elements">
            <div class="description__offre">
              <h3 class="description__offre-titre">Offre actuelle :</h3>
              <div class="description__offre-elements">
                <div class="description__element">
                  <h3 class="description__titre-element">Mise :</h3>
                  <p class="description__valeur-element bleu-gras">{{ auction.current_price }} $</p>
                </div>
                <div class="description__element">
                  <h3 class="description__titre-element">Utilisateur à avoir miser en dernier :</h3>
                  <p class="description__valeur-element bleu-gras">
                    {{ lastBidder ?: 'Aucun enchérisseur' }}
                  </p>
                </div>
              </div>
              <div class="description__offre-elements">
                <div class="description__element">
                  <h3 class="description__titre-element">
                    Ouverture de l'enchère :
                  </h3>
                  <p class="description__valeur-element bleu-gras">
                    {{ auction.dateStart }}
                  </p>
                </div>
                <div class="description__element">
                  <h3 class="description__titre-element">
                    Fermeture de l'enchère :
                  </h3>
                  <p class="description__valeur-element bleu-gras">
                    {{ auction.dateEnd }}
                  </p>
                </div>
              </div>
            </div>

            <div class="description__element">
              <h3 class="description__titre-element">Prix initial :</h3>
              <p class="description__valeur-element">{{ auction.startPrize }} $</p>
            </div>
            <div class="description__element">
              <h3 class="description__titre-element">Nombre de mise :</h3>
              <p class="description__valeur-element">{{ totalBid }}</p>
            </div>
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
        </details>
     </section>
    </div>
</div>
