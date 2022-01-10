<html>
<head>
    <title>Reporte de {{ $request->type }}</title>
    <style>
        body{
            font-family: sans-serif;
        }
        @page {
            margin: 160px 0px;
        }
        h1 {
            font-size: 20px;
        }

        h2 {
            font-size: 18px;
        }

        h3 {
            font-size: 16px;
        }

        h4 {
            font-size: 14px;
        }

        h5, h6 {
            font-size: 13px;
        }

        header { 
            position: fixed;
            left: 0px;
            top: -155px;
            right: 0px;
            width: 100% !important;
            height: 100px;
            /*background: url("{{ asset('img/logo.jpg') }}") no-repeat top center 50%;
            background-size: cover;
            background-position: 50% 50% 50% 50%;
            background-attachment: fixed;*/
            text-align: center;
        }
        header h1{
            margin: 10px 0;
        }
        header h2{
            margin: 0 0 10px 0;
        }
        footer {
            position: fixed;
            left: 0px;
            bottom: -50px;
            right: 0px;
            height: 40px;
            /* border-bottom: 2px solid #ddd;*/ 
        }

        footer {
            margin: 10px 50px; 
        }
        footer .page:after {
            /* content: counter(page); */
        }
        footer table {
            width: 100%;
        }
        footer p {
            text-align: right;
        }
        footer .izq {
            text-align: left;
            font-size: 12px;
            color: #95b3d7;
        }

        .logo-sidg {
            float: center !important;
            width: 250px;
            margin: 0 auto !important;
            position: absolute;
        }

        #content {
            margin-left: 70px;
            margin-right: 50px;
        }

        .title{
            justify-content: center;
            text-align: center;
            text-transform: uppercase;
        }

        .contenido {
            font-size: 12px;
        }

        table {
          border-collapse: collapse;
        }
        th, td {
          border-bottom: 1px solid #ddd;
          padding: 5px;
        }

    </style>
</head>
<body>
    <header>
         <h3 class="title">
           <img src="{{ asset('img/logo.jpg') }}" width="150px">
        </h3>
        <h3 class="title">Reporte de {{ $request->type }}</h3>
    </header>
    <footer>
        <!-- <table>
            <tr>
                <td>
                    <p class="izq">
                        Carrera 108 # 71 a 33 Bogotá - Colombia <br/>
                        (571) 828 5530 / (57) 311 880 9558 <br/>
                        directoragestion@sistemasintegradosdegestion.co / www.sistemasintegradosdegestion.co <br/>
                    </p>
                </td>
                <td>
                    <p class="page">

                    </p>
                </td>
            </tr>
        </table> -->
    </footer>
    <div id="content">
       
       <div class="contenido">
           <table class="table table-hover table-hover-animation mb-0">
               <thead>
                        <tr>
                            <th>Fecha creación</th>
                            <th>Vigilante</th>
                            <th>Puesto Origen</th>
                            <th>Turno Origen</th>
                            <th>Puesto Destino</th>
                            <th>Turno destino</th>
                        </tr>              
               </thead>
               <tbody>
                    @foreach($data as $report)
                    <tr>
                        <td>{{ explode(' ', $report->created_at)[0] }}</td>
                        <td>{{ $report->watchmen->name }}</td>
                        <td>
                            {{ $report->clients_origin->name }}<br/>
                            <label>Desde: </label>{{ $report->assignment_watchmen_origin->pivot->date_ini }}<br/>
                            <label>Hasta: </label>{{ $report->assignment_watchmen_origin->pivot->date_end }}<br/>
                        </td>
                        <td>{{ $report->assignment_watchmen_origin->shift->name }}</td>
                        <td>
                            {{ $report->clients_destiny->name }}
                            <label>Desde: </label>{{ $report->start_date_vigilant }}<br/>
                        </td>
                        <td>{{ $report->assignment_watchmen_destiny->shift->name }}</td>
                    </tr>
                    @endforeach
               </tbody>
           </table>
       </div>
   </div>
</body>
</html>