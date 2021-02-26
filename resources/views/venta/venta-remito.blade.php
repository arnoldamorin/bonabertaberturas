<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Remito</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        p {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <a href="{{route('imprimir')}}" target="_blank" rel="noopener noreferrer"><button>Imprimir PDF</button></a>
    <div class="container border">
        <div class="row">
            <div class="col-7">
                <div class="row">
                    <div class="col-9">
                        <img class="img img-fluid " src="img/logo.svg" alt="no se xq no carga este logo verga c:">
                    </div>
                    <div class="col-3">
                        <p>A</p>
                        <p>Cod. 01</p>
                    </div>
                </div>
                <p>Direccion:</p>
                <p>Telefono:</p>
                <p>E-Mail:</p>
                <p>I.V.A Responsable Inscripto</p>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col-6">
                        <p>ORIGINAL</p>
                    </div>
                    <div class="col-6">
                        <p>Paginas 1 of 1</p>
                    </div>
                </div>
                <p>FVE A0003-00051883</p>
                <p>Fecha: 26/02/2021</p>
                <p>C.U.I.T.: 22-22222222-6</p>
                <p>ING-BRUTOS CONV. MULT.: 901-967591-6</p>
                <p>CAJA JUB. COMERCIO N°: 64868048</p>
                <p>FECHA DE INICIO DE ACT: 01/06/2000</p>
            </div>
        </div>
    </div>
    <div class="container border">
        <div class="row">
            <div class="col-12">
                <p>Señor/a: HOMBRE PEZ</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <p>Domicilio: CALLE FALSA 123</p>
            </div>
            <div class="col-4">
                <p>Zona: OESTE</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>C.P.: 1744</p>
            </div>
            <div class="col-4">
                <p>C.U.I.T. N°: 11-555555-55</p>
            </div>
            <div class="col-4">
                <p>CLIENTE N°: 45</p>
            </div>
        </div>
    </div>
    <div class="container border">
        <div class="row">
            <div class="col-12 text-right">
                <p>Remito N°:</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <tr>
                        <th>Cant.</th>
                        <th>Articulo</th>
                        <th>Descripcion</th>
                        <th>Unit.</th>
                        <th>Desc.</th>
                        <th>Importe</th>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>022545544</td>
                        <td>Puerta 360</td>
                        <td>744.75</td>
                        <td>0.00%</td>
                        <td>8937.00</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <tr>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Impuesto</th>
                        <th>Subtotal</th>
                        <th>I.V.A Insc. %</th>
                        <th>Total:</th>
                    </tr>
                    <tr>
                        <td>$ 31,997.07</td>
                        <td>$-3,199.71</td>
                        <td></td>
                        <td>28,797.36</td>
                        <td>6,047.45</td>
                        <td>34,844.81 $</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</body>

</html>