<form method="POST" action="{{ route('post.store') }}">
    @csrf

    <label for="title">Title:</label>
    <input type="text" id="title" name="title">
    <br>
    <label for="body" class="col-form-label">Contenido:</label>
    <textarea id="body" name="body"></textarea>

    <label for="image">Imagen:</label>
    <input type="file" id="image" name="image">
    <br>
    <button type="submit" id="miboton">Crear Publicación</button>

</form>
