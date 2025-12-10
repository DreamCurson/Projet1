{{ include('layouts/header-principal.php') }}

<h1 class="formulaire-ajouter__titre">Ajouter votre image</h1>

<form class="formulaire-ajouter" method="POST" enctype="multipart/form-data">

    <div class="formulaire-ajouter__field">
        <label class="formulaire-ajouter__label">Image :</label>
        <input type="file" name="file" class="formulaire-ajouter__input" required>
        {% if errors.message is defined %}
            <span class="error">{{ errors.message }}</span>
        {% endif %}
    </div>

    <div class="formulaire-ajouter__field">
        <label class="formulaire-ajouter__label">Description :</label>
        <input type="text" name="description" class="formulaire-ajouter__input">
        {% if errors.description is defined %}
            <span class="error">{{ errors.description }}</span>
        {% endif %}
    </div>

    <div class="formulaire-ajouter__field">
        <label class="formulaire-ajouter__label">Ordre :</label>
        <input type="number" name="imageOrder" class="formulaire-ajouter__input">
    </div>

    <input type="hidden" name="timbre_idTimbre" value="{{ idStamp }}">

    <button type="submit" class="formulaire-ajouter__button">Ajouter</button>

</form>
