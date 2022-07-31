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
            overflow-x: auto;
        }

        table {
            min-width: 450px;
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #31B4AC;
            color: white;
        }

        tr {
            width: 100%;
            height: 40px;
        }

        th, td {
            border: 1px solid #AFAFAF;
            padding: 10px;
            font-family: 'Caviar Dreams', sans-serif;
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

        .centered {
            text-align: center;
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
            <div class="container">
                <h2 class="centered">Este es un correo de aviso</h2>
                <p>El usuario con el correo <span class="bold">{{$mail}}</span> ha hecho una compra en blancoschino.com</p>
                <p>Este es el resumen de los productos comprados: </p>
            </div>
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{$purchase['name']}}</td>
                                <td>${{number_format($purchase['price'], 2)}}mxn</td>
                                <td>{{$purchase['quantity']}}</td>
                                <td>${{number_format($purchase['subtotal'], 2)}}mxn</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="container">
                <p class="bold">Total: ${{number_format($total, 2)}}mxn</p>
            </div>
            <div class="container">
                <p>
                    Podrás ver más detalles de la transacción en el apartado
                    <a href="{{route('admin.purchases')}}">"Compras"</a>
                    en el menú de administración
                </p>
            </div>
            <div class="container">
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