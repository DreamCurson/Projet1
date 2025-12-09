{{ include('layouts/header-principal.php') }}
<form method="POST" enctype="multipart/form-data">

    <label>Image :</label>
    <input type="file" name="file" required>

    <label>Description :</label>
    <input type="text" name="description" required>

    <label>Ordre :</label>
    <input type="number" name="imageOrder">

    <input type="hidden" name="timbre_idTimbre" value="{{ idStamp }}">

    <button type="submit">Ajouter</button>
</form>
