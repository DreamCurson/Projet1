{{ include('layouts/header-principal.php') }}

<h1 class="formulaire-ajouter__titre">Modifier votre image</h1>

<form class="formulaire-ajouter" method="POST" enctype="multipart/form-data">

    <div class="formulaire-ajouter__field">
        <label class="formulaire-ajouter__label">Image actuelle :</label>
        <img src="data:image/png;base64,{{ image.file }}" alt="Image actuelle" class="formulaire-ajouter__preview">
    </div>

    <div class="formulaire-ajouter__field">
        <label class="formulaire-ajouter__label">Changer l'image :</label>
        <input type="file" name="file" class="formulaire-ajouter__input">
        <p>Si vous ne mettez rien votre image ne changera pas</p>
        {% if errors.message is defined %}
            <span class="error">{{ errors.message }}</span>
        {% endif %}
    </div>

    <div class="formulaire-ajouter__field">
        <label class="formulaire-ajouter__label">Description :</label>
        <input type="text" name="description" class="formulaire-ajouter__input" value="{{ image.description }}">
        {% if errors.description is defined %}
            <span class="error">{{ errors.description }}</span>
        {% endif %}
    </div>

    <div class="formulaire-ajouter__field">
        <label class="formulaire-ajouter__label">Ordre :</label>
        <input type="number" name="imageOrder" class="formulaire-ajouter__input" value="{{ image.imageOrder }}">
    </div>

    <input type="hidden" name="idImage" value="{{ image.idImage }}">
    <input type="hidden" name="timbre_idTimbre" value="{{ idStamp }}">

    <button type="submit" class="formulaire-ajouter__button">Mettre à jour</button>
    <a href="imageDelete?{{ image.idImage }}" 
        class="formulaire-ajouter__return" 
        onclick="return confirm('Voulez-vous vraiment supprimer cette image ?');">
        Supprimer l'image
    </a>
    <a href="stampShow?{{ idStamp }}" class="formulaire-ajouter__return">Annuler</a>
</form>

