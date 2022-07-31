<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0px;
            margin: 0px
        }

        body {
            background-color: #E9E9E9;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 100px 0px;
        }

        .wrapper {
            background-color: white;
            max-width: 700px;
            min-width: 70%;
        }

        header, footer {
            width: 100%;
            height: 80px;
            background-color: #31B4AC;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logoContainer {
            width: 100px;
            height: 30px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        img {
            width: 100%;
            height: auto;
        }

        main {
            width: 100%;
            padding: 40px;
        }

        .container {
            width: 100%;
            margin-bottom: 30px;
        }

        .infoContainer {
            margin-bottom: 10px
        }

        h2 {
            font-size: 20px;
            font-family: 'Cinzel', serif;
            font-weight: 400;
            color: #126963;
            margin-bottom: 10px;
        }

        p, span {
            font-size: 16px;
            font-family: 'Caviar Dreams', sans-serif;
            font-weight: 400;
            margin-bottom: 10px
        }

        .bold {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="logoContainer">
                <img src="{{asset('/img/blancos_el_chino_blanco.png')}}" alt="Blancos El Chino Logo">
            </div>
        </header>
        <main>
            <div class="subject container">
                <h2 class="centered">¡Hola!</h2>
                <p>Estás recibiendo esto porque alguien ha decidido contactarte desde tu página de contacto.</p>
                <p>La información del usuario se mostrará a continuación:</p>
            </div>
            <div class="subject container">
                <p><span class="bold">Asunto: </span>{{$userInfo['subject']}}</p>
                <p><span class="bold">Nomnre: </span>{{$userInfo['name']}}</p>
                <p><span class="bold">Correo: </span>{{$userInfo['email']}}</p>
                <p><span class="bold">Mensaje: </span>{{$userInfo['message']}}</p>
            </div>
            <div class="subject container">
                <p>Saludos desde</p>
                <p class="bold">Blancos El Chino</p>
            </div>
        </main>
        <footer>
            <div class="logoContainer">
                <img src="{{asset('/img/blancos_el_chino_blanco.png')}}" alt="Blancos El Chino Logo">
            </div>
        </footer>
    </div>
</body>
</html>