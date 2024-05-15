<form action="{{ route('login') }}" method="post">
    @csrf
    <label for="usuario">Usuario:</label>
    <input type="text" name="usuario" id="usuario" value="11678" >
    <label for="dni">DNI:</label>
    <input type="text" name="dni" id="dni" value="26248931C" >
    <button type="submit">Ingresar</button>
</form>