<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datos as $dato)
            <tr>
                <td>{{ $dato['nombre'] }}</td>
                <td>{{ $dato['valor'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>