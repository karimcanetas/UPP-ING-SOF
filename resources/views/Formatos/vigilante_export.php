<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="font-family: 'Calibri', sans-serif; margin: 20px;">

    <!-- título reporte -->
    <h1 style="text-align: center; color: #5e5e5e;">Reporte de Vigilancia: {{ $formatoNombre ?? 'Tipo no disponible' }}</h1>

    <!-- nombre y fecha -->
    <div style="margin-bottom: 20px;">
        <span style="font-size: 16px; font-weight: bold; display: inline-block; width: 200px;">
            Nombre Vigilante
        </span>
        <span style="border-bottom: 1px solid black; display: inline-block; width: 200px; text-align: center;">
            {{ $vigilantesYFechas[0]['nombre_vigilante'] ?? 'No asignado' }}
        </span>

        <span style="font-size: 16px; font-weight: bold; margin-left: 50px; display: inline-block; width: 100px;">
            Fecha
        </span>
        <span style="border-bottom: 1px solid black; display: inline-block; width: 200px; text-align: center;">
            {{ $vigilantesYFechas[0]['fecha_hora'] ?? 'Sin fecha' }}
        </span>
    </div>

    <!-- tabla de datos -->
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                @foreach ($nombresCampos as $nombreCampo)
                <th style="padding: 15px; text-align: center; border: 2px solid #3e3e3e; background-color: #757575; color: white; font-size: 18px; white-space: nowrap; font-weight: bold;">
                    {{ $nombreCampo }}
                </th>
            </tr>
        </thead>
        <tbody>
            @php
            // cuenta filas maximas
            $maxFilas = max(array_map('count', $valoresPorCampo));
            @endphp

            @for ($i = 0; $i < $maxFilas; $i++)
                <tr>
                @foreach ($nombresCampos as $nombreCampo)
                <td style="padding: 10px; text-align: center; border: 1px solid #BDC3C7; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ $valoresPorCampo[$nombreCampo][$i] ?? '' }}
                </td>
                @endforeach
                </tr>
                @endfor
        </tbody>
    </table>

</body>

</html>

