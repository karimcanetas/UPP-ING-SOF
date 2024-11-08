<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>{{ $formato->Tipo }}</title> --}}
</head>

<body style="font-family: Arial, sans-serif; margin: 20px;">

    <h1 style="text-align: center; color: #5e5e5e;">Reporte de Vigilancia: {{ $formato->Tipo }}</h1>
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                @foreach ($nombresCampos as $nombreCampo)
                    <th
                        style="padding: 15px; text-align: center; border: 2px solid #3e3e3e; background-color: #757575; color: white; font-size: 18px; white-space: nowrap; font-weight: bold;">
                        {{ $nombreCampo }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                // Contar la cantidad máxima de valores para determinar el número de filas
                $maxFilas = max(array_map('count', $valoresPorCampo));
            @endphp

            @for ($i = 0; $i < $maxFilas; $i++)
                <tr>
                    @foreach ($nombresCampos as $nombreCampo)
                        <td
                            style="padding: 10px; text-align: center; border: 1px solid #BDC3C7; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $valoresPorCampo[$nombreCampo][$i] ?? '' }}
                        </td>
                    @endforeach
                </tr>
            @endfor
        </tbody>
    </table>

</body>

</html>
