<?php


function write_to_console($data){
    $console = $data;
    if (is_array($console))
        $console = implode(',', $console);

    echo "<script>console.log('Console: " . $console . "' );</script>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['btnregistrar'])) {

        if (!empty($_POST['nombre']) && !empty($_POST['centro_cargo']) && !empty($_POST['cargo']) && !empty($_POST['identificacion']) && !empty($_POST['salario']) && !empty($_POST['dias'])) {

            $nombre =           $_POST['nombre'];
            $centro_cargo =     $_POST["centro_cargo"];
            $cargo =            $_POST["cargo"];
            $identificacion =   $_POST["identificacion"];
            $salario = floatval($_POST["salario"]);
            $dias =      intval($_POST["dias"]);
            $dias_incapacidad = $_POST["dias_incapacidad"];


            //DEVENGADOS
            $Salario_segun_dias_laborados = ($salario / 30) * $dias;
 
            $diasVacaciones = 15; //Vacaciones obligatorias de la empresa
            $Vacaciones_Disfrutadas = ($salario / 30) * $diasVacaciones;

            $transporte = 140606; //Auxilio de Transporte para el año 2023
            $Auxilio_de_transporte = ($transporte / 30) * $dias;

            $Pago_Incapacidad_EPS = 0;

            // Realizar los cálculos
            $calculo1 = (($salario / 30) * $dias_incapacidad) * 0.6667;
            $calculo2 = ((828116 / 30) * $dias_incapacidad);
            // Aplicar la lógica condicional
            if ($calculo1 < $calculo2) {
                $resultado = $calculo2;
            } else {
                $resultado = $calculo1;
            }

            $Pago_Incapacidad_EPS = $resultado;
            $Pago_Incapacidad_ARL = ($salario / 30) * $dias_incapacidad;


            $Recargo_Nocturno = 1692; //Hora extra nocturna (aumento del 35 %)
            $H_Dominicales = 8457; //100% de lo que vale la hora normal, más 75% adicionales


            $Aux_Alimentacion_no_prestacional = 0;
            if($salario >= 2338198){
                $Aux_Alimentacion = 0;
            }else{
                $Aux_Alimentacion = 83385; //Según decreto 0905 de 2023
            }
            $Aux_Alimentacion_no_prestacional = ($Aux_Alimentacion / 30) * $dias;

            //Falta Recargo Nocturno y Horas Dominicales
            $Total_devengado = $Salario_segun_dias_laborados+$Vacaciones_Disfrutadas+$Auxilio_de_transporte+$Pago_Incapacidad_EPS+$Pago_Incapacidad_ARL+$Aux_Alimentacion_no_prestacional;


            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


            //DEDUCCIONES
            $Salud = $salario*0.04;

            $Pension = $salario*0.04;


            $Fondo_de_Solidaridad_Pensional = 0;
            if ($salario > 3124968) {
                $resultado = $salario * 0.01;
            } else {
                $resultado = 0;
            }
            $Fondo_de_Solidaridad_Pensional = $resultado;



            //EN CASO DE QUE EL EMPLEADO TENGA UN PRESTAMO CON LA EMPRESA
            $Monto_del_Desembolso = 0;
            $Num_De_Cuotas_a_Descontar = 0;
            $Fecha_del_Desembolso = 0;
            $Num_De_Cuota_Pagada = 0;
            $Cuotas_por_Descontar = 0;
            $Nomina_en_que_termina_prestamo = 0;
            $Prestamo = 0;
            $Valor_Cuota = 0;
            $Saldo_al_Prestamo = 0;
            ///////////////////////////////////////////////////////////////

            $Total_deducciones = $Salud+$Pension+$Fondo_de_Solidaridad_Pensional+$Valor_Cuota;

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            //TOTAL A PAGAR AL EMPLEADO
            $TOTAL_NOMINA = $Total_devengado - $Total_deducciones;

            /////////////////////////////////////////////////////////////////////////////////////////////////

            //PRESTACIONES SOCIALES
            $PRIMA = ($salario+$Auxilio_de_transporte) * 0.0833;

            $CESANTIAS = ($salario+$Auxilio_de_transporte) * 0.0833;

            $INTERES_DE_CESANTIAS = 0;
            $factor = $dias / 1; 
            $interes = ($CESANTIAS * $factor * 0.12) / 360;
            $INTERES_DE_CESANTIAS = $interes;

            $VACACIONES = $salario*0.0417;


            $TOTALES = $PRIMA+$CESANTIAS+$INTERES_DE_CESANTIAS+$VACACIONES;



            //COSTOS DE LA EMPRESA
            $COSTOS_A_CARGO_DE_LA_EMPRESA_DIARIO = $COSTOS_A_CARGO_DE_LA_EMPRESA_MENSUAL/30;
            $COSTOS_A_CARGO_DE_LA_EMPRESA_MENSUAL = $TOTALES+$Total_devengado;
            $COSTOS_A_CARGO_DE_LA_EMPRESA_ANUAL = $COSTOS_A_CARGO_DE_LA_EMPRESA_MENSUAL*12;


            /*-------------------------------------------------------------------------------------------------------------------------------*/

            //INSERCIÓN DE DATOS A LA BD
            $sql = $conexion->query("INSERT INTO nomina_empleado(nombre, centro_cargo, cargo, identificacion, salario, dias, salario_neto) VALUES('$nombre','$centro_cargo','$cargo','$identificacion','$salario','$dias',200000)");

            if ($sql == 1) {
                echo "<script>alert('Datos guardados correctamente');</script>";
                echo "<script>window.location.href='./index.php';</script>";
            } else {
                echo "<script>alert('Error al guardar los datos');</script>";
            }
        }
    } else {
        echo '<div class="alert alert-warning">Algunos campo está vacios</div>';
    }
} else {
    //echo '<div class="alert alert-danger"><span>Error: </span>Ha ocurrido un error en el procesamiento.</div>';
}
