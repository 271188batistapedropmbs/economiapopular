<?php
use yii\helpers\Html;
?>
<table>
 <tr>
    <td class='text-center'>  
    <?= Html::img('@web/img/gobierno-bolivariano.jpg',['style'=>'max-width:65px;position:absolute;left:10%;','class'=>'center-block']);?>                                     
    </td>

    <td class='text-center'> 
        <p style='font-size:4px;'>
            REPÚBLICA BOLIVARIANA DE VENEZUELA.<br>
            ALCALDÍA DEL MUNICIPIO HERES.<br>
            DIRECCIÓN DE DESARROLLO SOCIO PRODUCTIVO.<br>
            UNIDAD DE ECONOMÍA POPULAR.<br>
            CIUDAD BOLÍVAR - ESTADO BOLÍVAR.
        </p>                                       
    </td>

    <td class='text-center'>
    <?= Html::img('@web/img/logoalcaldia.jpg',['style'=>'max-width:50px;position:absolute;right:10%;']);?>                                      
    </td>
    <!--otra columna -->
    <td class='text-center'>
    <?= Html::img('@web/img/gobierno-bolivariano.jpg',['style'=>'max-width:65px;position:absolute;left:10%;','class'=>'center-block']);?> 
    </td>

    <td class='text-center'>
        <p style='font-size:4px;'>
        REPÚBLICA BOLIVARIANA DE VENEZUELA.<br>
        ALCALDÍA DEL MUNICIPIO HERES.<br>
        DIRECCIÓN DE DESARROLLO SOCIO PRODUCTIVO.<br>
        UNIDAD DE ECONOMÍA POPULAR.<br>
        CIUDAD BOLÍVAR - ESTADO BOLÍVAR.
        </p>                                       
    </td>

    <td class='text-center'>
    <?= Html::img('@web/img/logoalcaldia.jpg',['style'=>'max-width:50px;position:absolute;right:10%;']);?>                                      
    </td>
 </tr>
 <tr>
    <td colspan='3' style='min-width:50%; max-width:50%;padding:4px;'>
    <p style='font-size:10px;'>LA UNIDAD DE ECONOMÍA POPULAR DE LA ALCALDÍA DE HERES
                EN USO DE SUS ATRIBUCIONES CONTEMPLADAS EN EL DECRETO
                Nº 006-2007, Y CON MOTIVO DE REORDENACIÓN Y REUBICACIÓN
                DE LA ECONOMÍA INFORMAL EN EL MUNICIPIO HERES, PARROQUIA <?=$parroquia->parroquia.' SECTOR '.$sector->sector.' '.$direccion->direccion.'.';?>
                </p>
                <br>
                <p style='font-size:10px;'>
                <?php echo ($comerciante->sexo=='FEMENINO')? ' AUTORIZA A LA CIUDADANA :' : 'AUTORIZA AL CIUDADANO : ';?>
                </p>
                <p style='font-size:10px;'> 
        <?=$comerciante->nombres_y_apellidos.'.';?><br>
        TITULAR DE LA C.I Nº <?=$comerciante->nacionalidad.'-'.$comerciante->cedula.'.';?>
        </p>
        <p style='font-size:10px;'>Codigo: <?=$comerciante->id.$comerciante->cedula.date('Ymd')?></p><br>
        <p class='lead' style='font-size:10px;'>VENDEDOR DE <?=$rubro->rubro.'.';?></p>
        <br>
        <p style='font-size:10px;'>
        PARA UBICARSE TEMPORALMENTE EN EL MUNICIPIO : HERES, PARROQUIA : <?=$parroquia->parroquia.' SECTOR : '.$sector->sector.' '.$direccion->direccion.'.';?><br>
        </p>
        <br>
        
        <p style='font-size:10px;'>
        ESTE PERMISO ES INTRANSFERIBLE Y DEBERÁ PERMANECER EN UN LUGAR VISIBLE PARA SU INSPECCIÓN.
        </p>     
    </td>
    <td colspan='3' style='min-width:50%; max-width:50%;padding: 4px;'>
    <p style='font-size:10px;'>
                ESTE CARNET LO IDENTIFICA COMO TRABAJADOR INFORMAL AUTORIZADO
                POR LA ALCALDÍA PARA EJERCER EN UN ESPACIO DETERMINADO, SEGÚN 
                DECRETO Nº 006-2017 "REGLAS DE REGULACIÓN, REUBICACIÓN Y 
                ORDENAMIENTO DE LA ECONOMÍA INFORMAL EN LOS ESPACIOS CORRESPONDIENTES AL SECTOR <?=$sector->sector.' '.$direccion->direccion.' DE LA PARROQUIA '.$parroquia->parroquia.' DEL MUNICIPIO HERES DEL ESTADO BOLÍVAR".';?><br><br>
                EN NINGÚN CASO LO IDENTIFICA COMO FUNCIONARIO PUBLICO O EMPLEADO DE LA INSTITUCIÓN MUNICIPAL O SUS DEPENDENCIAS POR LA ALCALDÍA MUNICIPAL DE HERES.<br>
                </p><br>
                <p style='font-size:10px;'>
                JEFE DE LA UNIDAD DE ECONOMÍA INFORMAL
                </p><br>
                FIRMA :<br><br><br>
                SELLO:
                </p>
               
    </td>
 </tr>
</table>



