<html>
<head>
    <style>
        body{
            font-family: sans-serif;
        }
        @page  {
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
            top: -160px;
            right: 0px;
            width: 100% !important;
            height: 100px;
            background: url("<?php echo e(asset('AppResources/login/img/bg-login.png')); ?>") no-repeat top center;
            background-size: cover;
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
            float: left;
            width: 100px;
            margin-left: 50px;
        }

        #content {
            margin-left: 70px;
            margin-right: 50px;
        }

        h1.title{
            justify-content: center;
            text-align: center;
            text-transform: uppercase;
        }

        .contenido {
            font-size: 12px;
        }

    </style>
</head>
<body>
    <header>
        <img class="logo-sidg" src="<?php echo e(asset('AppResources/login/img/logo-sidg.png')); ?>">
    </header>
    <footer>
        <table>
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
        </table>
    </footer>
    <div id="content">
       <h1 class="title">
        <?php 
            $data->title = str_replace('{%name_user%}', $user['name'], $data->title);
            $data->title = str_replace('{%nit_user%}', $user['nit'], $data->title);
            $data->title = str_replace('{%email_user%}', $user['email'], $data->title);
            $data->title = str_replace('{%phone_user%}', $user['phone'], $data->title);
            $data->title = str_replace('{%address_user%}', $user['address'], $data->title);


            $data->content = str_replace('{%name_user%}', $user['name'], $data->content);
            $data->content = str_replace('{%nit_user%}', $user['nit'], $data->content);
            $data->content = str_replace('{%email_user%}', $user['email'], $data->content);
            $data->content = str_replace('{%phone_user%}', $user['phone'], $data->content);
            $data->content = str_replace('{%address_user%}', $user['address'], $data->content);
        ?>

        <?php echo e($data->title); ?></h1>
       <div class="contenido">
            <?php
                $doc = new DOMDocument();
                $doc->loadHTML('<?xml encoding="UTF-8">'.$data->content);
                echo $doc->saveHTML();
            ?>
       </div>
   </div>
</body>
</html><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/showPolitics-pdf.blade.php ENDPATH**/ ?>