
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UMSS Cotización</title>
<style>
body{
    font-size: 12px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}
footer, header, main{
  display: block;
}
h1, h2, h3, h4, h5, h6 {
  margin-top: 0;
  margin-bottom: 0.5rem;
}
p {
  margin-top: 0;
  margin-bottom: 1rem;
}
table {
  border-collapse: collapse;
}
th {
  text-align: inherit;
}
.container {
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
}
.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}
.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}
.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}
.table-sm th,
.table-sm td {
  padding: 0.3rem;
}
.table-bordered {
  border: 1px solid #dee2e6;
}
.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}
.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}
.text-center {
  text-align: center !important;
}
.table .thead-light th {
  color: #495057;
  background-color: #e9ecef;
  border-color: #dee2e6;
}
.table-active,
.table-active > th,
.table-active > td {
  background-color: rgba(0, 0, 0, 0.075);
}
     .title-left{
         text-transform:uppercase;
         font-size: 12px;
     }
     .contenido{
         width: 100%;
         display: flex;
         height: 50px;
     }
     .izquierda{
         width: 200px;
     }
     .title{
         text-align: center;
         font-size: x-large;
     }
     .principal{
         margin-top: 20px;
     }
     .razon-social{
        display: flex;
        padding-bottom: 0px;
        margin-bottom: 0px;
     }
     .fecha-derecha{
        text-align: right !important;
        padding-bottom: 0px;
        margin-bottom: 0px;
     }
    .bajar{
        padding-top: 15px;
        padding-bottom: 0px;
        margin-bottom: 0px;
        text-align: justify;
    }
    .table{
        position: relative;
        top: -30px;
    }
    td{
        height: 20px;
    }
    .celdaPers {
        height: 50px;
    }
    .text-right {
        text-align: right !important;
    }
</style>
</head>
<body>
    <div class="container">
        <header>
            <div class="contenido">
                <div class="izquierda title-left">universidad mayor de sam simón facultad de {{$facultad->nameFacultad}} aquisiciones</div>
                <div class="text-right"><p>Cochabamba-Bolivia</p></div>
            </div>
            <h5 class="title">SOLICITUD DE COTIZACIÓN</h5>
        </header>
        <main class="principal">
            <div class="razon-social">
                <p>Razón social:..............................................</p>
                <p class="fecha-derecha">Fecha: {{$fecha=date("d")."/".date("m")."/".date("Y")}} </p>
                <p class="bajar">Agradecemos a Uds. cotizamos, los articulos que a continuación se detallan. Luego de este formulario debe devolverse en sobre cerrado debidamente FIRMADO Y SELLADO (Favor especificar Marca, Modelo, Industria).</p>
            </div>
            <table class="table table-sm table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        <th width="4%">N&#176;</th>
                        <th width="6%">Cantidad</th>
                        <th width="10%">Unidad</th>
                        <th width="34%">DETALLE</th>
                        <th width="10%">Unitario</th>
                        <th width="10%">Total</th>
                        <th width="28%">Detalle de la oferta</th>
                    </tr>
                </thead>
               <tbody>
               {{$index=0}}
                @foreach($details as $detail)
                    <tr>
                        <th>{{$index=$index+1}}</th>
                        <td>{{$detail->amount}}</td>
                        <td>{{$detail->unitMeasure}}</td>
                        <td>{{$detail->description}}</td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>
                @endforeach
                    <tr class="table-active">
                        <td>Total </td>
                        <td colspan="3"> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>
                </tbody>
            </table>
            <table  class="table table-sm table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th colspan="2" class="text-center">A partir de la cotizacón, datos a ser llenados por el proveedor</th>
                    </tr>
                </thead>
               <tbody>
                    <!-- <tr>
                        <td>Validez de oferta:</td>
                        <td>Tiempo de entrega:</td>
                    </tr> -->
                    <tr>
                        <td>Nombre y firma:</td>
                        <td>Sello:</td>
                    </tr>
               </tbody>
            </table>
        </main>
    </div>
</body>
</html>
