<?php
require('./fpdf.php');
require('conexion.php');

$pdf = new FPDF();

$consultaEncabezado = $db->query("SELECT 
    f.nombre AS nombre_facultad,
    ma.nombre AS nombre_materia,
    s.nombre AS nombre_semestre,
    g.clave_grupo AS cve_grupo,
    CONCAT(p.nombre, ' ', p.primer_apellido, ' ', p.segundo_apellido) AS Docente,
    MAX(CASE WHEN MONTH(m.fecha_alta) = 3 THEN 'Marzo' END) AS Mes
    FROM 
    matricula m
    JOIN 
    profesores p ON m.profesor_id = p.profesor_id
    JOIN 
    materias ma ON m.materia_id = ma.materia_id
    JOIN 
    grupos g ON m.grupo_id = g.grupo_id
    JOIN 
    facultades f ON g.facultad_id = f.facultad_id
    JOIN 
    semestres s ON g.semestre_id = s.semestre_id
    WHERE 
    MONTH(m.fecha_alta) = 3
    AND g.clave_grupo = '8510'
    GROUP BY 
    f.nombre,
    CONCAT(p.nombre, ' ', p.primer_apellido, ' ', p.segundo_apellido),
    ma.nombre,
    s.nombre,
    g.clave_grupo;");

if($consultaEncabezado->num_rows > 0){
    
    //echo "<ul>";
    while ($fila = $consultaEncabezado->fetch_assoc()) {
        $pdf->AddPage("landscape");
        $pdf->AliasNbPages();
		            // Configuración del logo
        $pdf->Image('UNAM.jpg', 15, 5, 20); //logo de la empresa, moverDerecha, moverAbajo, tamañoIMG
            // Título 1
        $pdf->SetFont('Arial', 'B', 13); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $pdf->Cell(95); // Movernos a la derecha
        $pdf->SetTextColor(0, 0, 0); //color
        $pdf->Cell(80, 2, utf8_decode('UNIVERSIDAD DE SOTAVENTO, A.C.'), 0, 1, 'C', 0); // AnchoCelda, AltoCelda, Titulo, Borde, SaltoLinea, Posicion(L-C-R), ColorFondo
        $pdf->SetFont('Arial', '', 11); // Tipo de fuente, estilo, tamaño
        $pdf->Ln(5); // Salto de línea
		            // Título 2
        $pdf->Cell(275, 4, utf8_decode('INCORPORADA A LA SECRETARIA DE EDUCACION PUBLICA'), 0, 1, 'C', 0); // AnchoCelda, AltoCelda, Titulo, Borde, SaltoLinea, Posicion(L-C-R), ColorFondo
        $pdf->SetFont('Arial', '', 11); // Tipo de fuente, estilo, tamaño
        $pdf->Ln(5); // Salto de línea

            // Título 3
        $pdf->Cell(265, 1, utf8_decode('Campus Coatzacoalcos'), 0, 1, 'C', 0); // AnchoCelda, AltoCelda, Titulo, Borde, SaltoLinea, Posicion(L-C-R), ColorFondo
        $pdf->Ln(5); // Salto de línea
		
		$pdf->SetFillColor(255, 255, 255); //colorFondo
        $pdf->SetTextColor(0, 0, 0); //colorTexto
        $pdf->SetDrawColor(163, 163, 163); //colorBorde
        $pdf->SetFont('Arial', '', 9);

        $pdf->Cell(100, 10, utf8_decode('CARRERAS: '. $fila['nombre_facultad']), 1, 0, 'L', 1);
        $pdf->Cell(40, 10, utf8_decode('CLAVE: 20181190/1'), 1, 0, 'L', 1);
		$pdf->Cell(65, 10, utf8_decode('PERIODO:'), 1, 0, 'L', 1);
        $pdf->Cell(70, 10, utf8_decode('/'. $fila['Docente']), 1, 1, 'C', 1);

        $pdf->Cell(100, 10, utf8_decode('MATERIA: '. $fila['nombre_materia']), 1, 0, 'L', 0);
        $pdf->Cell(40, 10, utf8_decode($fila['nombre_semestre']), 1, 0, 'L', 0);
        $pdf->Cell(65, 10, utf8_decode('GRUPO: '. $fila['cve_grupo']), 1, 0, 'L', 0);

        $pdf->Cell(70, 10, utf8_decode($fila['Mes']), 1, 1, 'C');

        $pdf->Ln(5); // Salto de línea
            // Título 4
        $pdf->Cell(100, 1, utf8_decode('Calificacion Minima Aprobatoria para Ordinario:   6'), 0, 1, 'C', 0);
        $pdf->Ln(5); // Salto de línea
        //------------------------------FIN DEL ENCABEZADO----------------------------------------------
		
        //----------------------INICIO DE LA LISTA DE LOS ALUMNOS--------------------------------------
		
		$pdf->Cell(90, 12, utf8_decode('Matricula                         A l u m n o '), 1, 0, 'L', 0);
        $pdf->Cell(155, 12, utf8_decode(' '), 1, 0, 'C', 0);

        $x = 153; // Coordenada X
        $y = 67.5;  // Coordenada Y

        // Dibuja el texto en la posición especificada
        $pdf->Text($x, $y, utf8_decode('DIAS DE CLASES EN EL MES'));

        // Obtener el primer día del mes actual
        $primer_dia_mes = date('Y-m-01');
        // Definir la posición inicial
        $x = $pdf->GetX() - 154.5;
        $y = $pdf->GetY() + 6.0;

        // Definir la fuente
        $pdf->SetFont('Arial', '', 6);
		
		

            // Iterar sobre los días del mes
		// Iterar sobre los días del mes
            for ($dia = 1; $dia <= 31; $dia++) {
                // Obtener el nombre del día de la semana abreviado
                $nombre_dia_semana = array('L', 'M', 'M', 'J', 'V', 'S', 'D')[date('N', strtotime(date('Y-m-' . $dia))) - 1];

                // Combinar el nombre del día de la semana con el día del mes
                $texto_a_mostrar = $nombre_dia_semana . sprintf("%02d", $dia); // Se agrega un cero si el día es menor de 10

                // Agregar el rectángulo con el texto
                $pdf->Rect($x, $y, 4, 5); // Relleno del cuadro
                $pdf->Text($x, $y + 4.4, $texto_a_mostrar); // El texto se ajusta para centrarlo dentro del rectángulo

                // Mover la posición al siguiente rectángulo
                $x += 4.8; // Ajusta la posición para el siguiente día
                if ($x > 400) { // Si se alcanza el borde derecho de la página, regresa a la izquierda
                    $x = $pdf->GetX() - 150.5;
                    $y += 6; // Mueve a la siguiente fila
    }
}
		
		
		
		$pdf->Cell(18, 12, utf8_decode('Total Faltas'), 1, 0, 'C', 0);
        $pdf->Cell(20, 12, utf8_decode('Calificacion'), 1, 0, 'C', 0);
        $pdf->Ln(5); // Salto de línea
        $pdf->Ln(5); // Salto de línea
        $pdf->Ln(2); // Salto de línea


        $consultaAlumnos = $db->query("SELECT 
        a.matricula,
        CONCAT(a.primer_apellido, ' ', a.segundo_apellido, ' ', a.nombre) AS nombre_completo,
        asi.fecha_alta AS Asistencias,
        asi.asistencia,
        MAX(
            CASE when asi.asistencia = 1 then '*'
            when asi.asistencia = 2 then '*'
            else '/'
            
            END) As Reporte            
        FROM 
        matricula m 
        JOIN 
        profesores p ON m.profesor_id = p.profesor_id
        JOIN 
        alumnos a ON m.alumno_id = a.alumno_id
        JOIN 
        materias ma ON m.materia_id = ma.materia_id
        JOIN 
        grupos g ON m.grupo_id = g.grupo_id
        JOIN 
        facultades f ON g.facultad_id = f.facultad_id
        JOIN
        semestres s ON g.semestre_id = s.semestre_id
        JOIN 
        asistencia asi ON asi.asistencia = asi.asistencia
        WHERE 
        MONTH(asi.fecha_alta) = 4
        AND g.clave_grupo = '8510'
        GROUP BY 
        a.matricula,
        CONCAT(a.primer_apellido, ' ', a.segundo_apellido, ' ', a.nombre),
        asi.fecha_alta,
        asi.asistencia
        ORDER BY 2");

        while ($alu = $consultaAlumnos->fetch_assoc()) {
        $pdf->SetFont('Arial', '', 8);
        // Imprime la matrícula y el nombre en la misma línea
        $pdf->Cell(90, 5, $alu['matricula'] . "            " . $alu['nombre_completo'], 1, 0, 'L');
    
        // Obtener la información de asistencia del alumno actual
        $asistencias = $alu['Reporte'];
			

        // Convertir la cadena de asistencias en un array
        $asistencias_array = explode(' ', $asistencias);

        // Iterar sobre los días de clase en el mes
         for ($dia = 1; $dia <= 31; $dia++) {
           // Verificar si el día está presente en el array de asistencias
           $asistencia_dia = in_array($dia, $asistencias_array);

            // Imprimir la asistencia del día
            $pdf->Cell(5, 5, utf8_decode($asistencia_dia), 1, 0, 'C', false);
        }

        // Espacio para las otras columnas (Total Faltas y Calificación)
        $pdf->Cell(18, 5, utf8_decode(' '), 1, 0, 'C', false);
        $pdf->Cell(20, 5, utf8_decode(' '), 1, 0, 'C', false);

        $pdf->Ln();
    }
}


    //echo "</ul>";
} else {
    //echo "0 resultados";
}


    
$pdf->Output('Prueba3.pdf', 'I');

$db->close();

?>