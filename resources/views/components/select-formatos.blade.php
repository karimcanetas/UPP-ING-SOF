<div class="card">
    <div class="select-format-container">
        <div class="form-group">
            <label for="id_formatos" class="text-white">Formatos:</label>
            <select class="form-control" id="id_formatos" name="id_formatos" style="text-transform: uppercase;" required>
                <option value="" disabled selected>Seleccione un formato</option>
                @foreach ($formatos as $formato)
                    <option value="{{ $formato->id_formatos }}">{{ $formato->Tipo }}</option>
                @endforeach
            </select>
        </div>

        {{-- <script> 
            $('#id_formatos').select2();
        </script> --}}
