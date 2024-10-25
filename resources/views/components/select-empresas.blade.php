<select id="id_empresa" name="id_empresa" required
    class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
    <option value="">Seleccione una empresa</option>
    @foreach ($empresas as $empresa)
        <option value="{{ $empresa->id_empresa }}">{{ $empresa->alias }}</option>
    @endforeach
</select>
