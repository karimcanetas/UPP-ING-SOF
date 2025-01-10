<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Vigilancia</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            padding: 40px;
            margin: 50px auto;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo img {
            width: 60px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 22px;
            color: #2c3e50;
            margin: 15px 0;
            font-weight: 700;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 15px 0;
        }

        .highlight {
            color: #27ae60;
            font-weight: 600;
        }

        .footer {
            margin-top: 40px;
            font-size: 14px;
            color: #7f8c8d;
        }

        .footer p {
            margin: 0;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="https://serviciosespecializados.grupoprt.com/public/assets/img/logo/prt_Mesa.ico" alt="Logo">
        </div>
        <h1>Reporte de <span class="highlight">{{ $formatoNombre }}</span></h1>
        <p>Estimado usuario,</p>
        <p>Le adjuntamos el reporte correspondiente al formato <span class="highlight">"{{ $formatoNombre }}"</span>.
        </p>
        <p>Por favor, no dude en contactarnos si necesita más información o tiene alguna consulta.</p>
        <p>Atentamente,</p>
        <p><strong>El equipo de Vigilancia</strong></p>

        <div class="footer">
            <p>No conteste a este correo.</p>
            <p>&copy; {{ date('Y') }} Vigilancia PRT. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>
