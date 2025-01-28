<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Vigilancia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        table {
            width: 100%;
            background-color: #f9f9f9;
            border-collapse: collapse;
        }

        .container {
            width: 600px;
            background-color: #ffffff;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-collapse: collapse;
        }

        .header {
            padding: 20px 0;
            text-align: center;
        }

        .header img {
            width: 60px;
            margin-bottom: 20px;
        }

        .content {
            padding: 15px;
            text-align: center;
        }

        .content h1 {
            font-size: 24px;
            color: #2c3e50;
            margin: 15px 0;
            font-weight: 700;
        }

        .content p {
            font-size: 16px;
            line-height: 1.8;
            margin: 15px 0;
        }

        .content .highlight {
            color: #27ae60;
            font-weight: 600;
        }

        .footer {
            padding: 15px;
            border-top: 1px solid #ddd;
            text-align: center;
        }

        .footer p {
            font-size: 14px;
            color: #7f8c8d;
            margin: 0;
        }
    </style>
</head>

<body>
    <table role="presentation">
        <tr>
            <td align="center">
                <table role="presentation" class="container">
                    <tr>
                        <td class="header">
                            <img src="{{ asset('assets/img/logo/prt_Mesa.ico') }}" alt="Logo">
                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <h1>Reporte de <span class="highlight">{{ $formatoNombre }}</span></h1>
                            <p>Estimado usuario,</p>
                            <p>Le adjuntamos el reporte correspondiente al formato <span
                                    class="highlight">"{{ $formatoNombre }}"</span>.</p>
                            <p>Por favor, no dude en contactarnos si necesita más información o tiene alguna consulta.
                            </p>
                            <p>Atentamente,</p>
                            <p><strong>El equipo de Vigilancia</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            <p>No conteste a este correo.</p>
                            <p>&copy; {{ date('Y') }} Vigilancia PRT. Todos los derechos reservados.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
