{{ include('layouts/header-principal.php') }}

<div class="oneStamp">
    <h2 class="oneStamp__title">{{ auction.name }}</h2>

    <p class="oneStamp__field"><strong>Description :</strong> {{ auction.description }}</p>
    <p class="oneStamp__field"><strong>Date de début :</strong> {{ auction.dateStart|date('Y-m-d') }}</p>
    <p class="oneStamp__field"><strong>Date de fin :</strong> {{ auction.dateEnd|date('Y-m-d') }}</p>
    <p class="oneStamp__field"><strong>Prix de départ :</strong> {{ auction.startPrize }}$</p>
    {% if auction.status == 'active' %}
    <p class="oneStamp__field"><strong>Plus haute mise en cours :</strong> {{ auction.current_price }}$</p>
    {% elseif auction.status == 'ended' %}
    <p class="oneStamp__field"><strong>Prix final :</strong> {{ auction.current_price }}$</p>
    {% endif %}

    {% if auction.status == 'active' %}
        <p class="oneStamp__field"><strong>Statut :</strong> En cours</p>
    {% elseif auction.status == 'upcoming' %}
        <p class="oneStamp__field"><strong>Statut :</strong> À venir, commence le {{ auction.start_date|date('Y-m-d') }}</p>
    {% elseif auction.status == 'ended' %}
        <p class="oneStamp__field"><strong>Statut :</strong> Terminé le {{ auction.end_date|date('Y-m-d') }}</p>
    {% endif %}

    <div>
        {% if auction.status != 'ended' %}
            <a class="oneStamp__backBtn green" href="auctionEdit?id={{ auction.idAuction }}">Modifier l'enchère</a>
        {% endif %}
        <a class="oneStamp__backBtn red" href="auctionDelete?{{ auction.idAuction }}" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette enchère ? Cette action est permanente');">
            Supprimer l'enchère
        </a>
    </div>
    

    <a class="oneStamp__backBtn" href="stamp">❮‎ ‎ Retour</a>
</div>
