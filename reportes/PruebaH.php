<?php
require('./fpdf.php');
$materia = 'Arquitectura de Computadoras';
    class PDF extends FPDF
    {

		
        // Cabecera de página
        function Header()
        {
			global $texto_grupo;
			global $docente;
			global $carrera;
			global $materia;
			global $grupo;
			
            // Configuración del logo
            $this->Image('UNAM.jpg', 15, 5, 20); //logo de la empresa, moverDerecha, moverAbajo, tamañoIMG

            // Título 1
            $this->SetFont('Arial', 'B', 13); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
            $this->Cell(95); // Movernos a la derecha
            $this->SetTextColor(0, 0, 0); //color
            $this->Cell(110, 2, utf8_decode('UNIVERSIDAD DE SOTAVENTO, A.C.'), 0, 1, 'C', 0); // AnchoCelda, AltoCelda, Titulo, Borde, SaltoLinea, Posicion(L-C-R), ColorFondo
            $this->SetFont('Arial', '', 11); // Tipo de fuente, estilo, tamaño
            $this->Ln(5); // Salto de línea

            // Título 2
            $this->Cell(300, 4, utf8_decode('INCORPORADA A LA SECRETARIA DE EDUCACION PUBLICA'), 0, 1, 'C', 0); // AnchoCelda, AltoCelda, Titulo, Borde, SaltoLinea, Posicion(L-C-R), ColorFondo
            $this->SetFont('Arial', '', 11); // Tipo de fuente, estilo, tamaño
            $this->Ln(5); // Salto de línea

            // Título 3
            $this->Cell(300, 1, utf8_decode('Campus Coatzacoalcos'), 0, 1, 'C', 0); // AnchoCelda, AltoCelda, Titulo, Borde, SaltoLinea, Posicion(L-C-R), ColorFondo
            $this->Ln(5); // Salto de línea

            /* CAMPOS DE LA TABLA */
            //color
            $this->SetFillColor(255, 255, 255); //colorFondo
            $this->SetTextColor(0, 0, 0); //colorTexto
            $this->SetDrawColor(163, 163, 163); //colorBorde
            $this->SetFont('Arial', '', 9);

            $this->Cell(100, 10, utf8_decode('CARRERAS: INGENIERIA EN SISTEMAS COMPUTACIONALES'), 1, 0, 'L', 1);
            $this->Cell(40, 10, utf8_decode('CLAVE: 20181190/1'), 1, 0, 'C', 1);
            $this->Cell(65, 10, utf8_decode('PERIODO:'), 1, 0, 'L', 1);
            $this->Cell(70, 10, utf8_decode('/ ' . $docente), 1, 1, 'C', 1);

            $this->Cell(100, 10, utf8_decode('MATERIA: ' . $materia), 1, 0, 'L', 0);
            $this->Cell(40, 10, utf8_decode('SEMESTRE: OCTAVO'), 1, 0, 'C', 0);
            $this->Cell(65, 10, utf8_decode('GRUPO: '), 1, 0, 'L', 0);
            // Fecha actual en español
            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $fecha_actual = $meses[date('n') - 1] . '/' . date('Y');
            $this->Cell(70, 10, utf8_decode($fecha_actual), 1, 1, 'C');

            $this->Ln(5); // Salto de línea
            // Título 4
            $this->Cell(100, 1, utf8_decode('Calificacion Minima Aprobatoria para Ordinario:   6'), 0, 1, 'C', 0);
            $this->Ln(5); // Salto de línea
            //------------------------------FIN DEL ENCABEZADO----------------------------------------------

            $this->Cell(90, 12, utf8_decode('Matricula                         A l u m n o '), 1, 0, 'L', 0);
            $this->Cell(150, 12, utf8_decode(' '), 1, 0, 'C', 0);

            $x = 153; // Coordenada X
            $y = 67.5;  // Coordenada Y

            // Dibuja el texto en la posición especificada
            $this->Text($x, $y, utf8_decode('DIAS DE CLASES EN EL MES'));

            // Obtener el primer día del mes actual
            $primer_dia_mes = date('Y-m-01');
            // Definir la posición inicial
            $x = $this->GetX() - 148.5;
            $y = $this->GetY() + 6.0;

            // Definir la fuente
            $this->SetFont('Arial', '', 6);

            // Iterar sobre los días del mes
            for ($dia = 1; $dia <= 31; $dia++) {
                // Obtener el nombre del día de la semana abreviado
                $nombre_dia_semana = array('L', 'M', 'M', 'J', 'V', 'S', 'D')[date('N', strtotime(date('Y-m-' . $dia))) - 1];

                // Combinar el nombre del día de la semana con el día del mes
                $texto_a_mostrar = $nombre_dia_semana . sprintf("%02d", $dia); // Se agrega un cero si el día es menor de 10

                // Agregar el rectángulo con el texto
                $this->Rect($x, $y, 4.5, 5); // Relleno del cuadro
                $this->Text($x, $y + 4.2, $texto_a_mostrar); // El texto se ajusta para centrarlo dentro del rectángulo

                // Mover la posición al siguiente rectángulo
                $x += 4.8; // Ajusta la posición para el siguiente día
                if ($x > 400) { // Si se alcanza el borde derecho de la página, regresa a la izquierda
                    $x = $this->GetX() - 148.5;
                    $y += 5; // Mueve a la siguiente fila
    }
}


            $this->Cell(18, 12, utf8_decode('Total Faltas'), 1, 0, 'C', 0);
            $this->Cell(20, 12, utf8_decode('Calificacion'), 1, 0, 'C', 0);
            $this->Ln(5); // Salto de línea
            $this->Ln(5); // Salto de línea
            $this->Ln(2); // Salto de línea


        }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $hoy = date('d/m/Y');
        $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'L');
    }
}
require('conexion.php');
$pdf = new PDF();
$pdf->AddPage("landscape");
$pdf->AliasNbPages();

// Texto original
// Texto modificado para realizar la consulta si se encuentra "8510"
if ($materia) {
    // Consulta a la base de datos para obtener los datos según la materia especificada
    $consulta_reporte_alumnos = $db->query("SELECT a.matricula, CONCAT(a.matricula, '         ',a.nombre, ' ', a.primer_apellido, ' ', a.segundo_apellido) AS NombreCompleto, 
	CONCAT(p.nombre, ' ', p.primer_apellido, ' ', p.segundo_apellido) AS Docente
	FROM matricula m
    JOIN alumnos a ON m.alumno_id = a.alumno_id
    JOIN grupos g ON m.grupo_id = g.grupo_id
	JOIN profesores p ON m.profesor_id = p.profesor_id
    JOIN materias m2 ON m.materia_id = m2.materia_id
    WHERE m2.nombre = '$materia'");
	

    if (!$consulta_reporte_alumnos) {
        die("Error en la consulta SQL: " . $db->error);
    }
	
	// Verificar si hay resultados en la consulta
if ($consulta_reporte_alumnos->num_rows > 0) {
    // Obtener el primer resultado de la consulta
    $fila = $consulta_reporte_alumnos->fetch_assoc();
    // Guardar el valor de Docente en la variable $docente
    $docente = $fila['Docente'];
} else {
    // Si no hay resultados, asignar un valor predeterminado a $docente o manejar el caso según sea necesario
    $docente = "Sin docente asignado"; // Puedes asignar cualquier valor predeterminado aquí
}

    $nombres_alumnos = array();
    while ($fila = $consulta_reporte_alumnos->fetch_assoc()) {
		$i = 0; // Inicializa la variable $i
		
        $nombres_alumnos[] = $fila['NombreCompleto'];
		
    }
	// Generar el PDF utilizando los nombres almacenados en el array
    foreach ($nombres_alumnos as $nombre) {
    // Establecer el tamaño de la letra
    $pdf->SetFont('Arial', '', 8); // Cambia 'Arial' por la fuente que desees y '12' por el tamaño de letra deseado
    // Generar las celdas del PDF con los nombres de los alumnos
    $pdf->Cell(90, 5, utf8_decode($nombre), 1, 0, 'L', 0);
   
    // Imprime la celda extra alineada con la celda principal
    $pdf->Cell(6, 5, utf8_decode('*'), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode('*'), 1, 0, 'C', false);
    $pdf->Cell(4.8, 5, utf8_decode('*'), 1, 0, 'C', false);
    $pdf->Cell(4.8, 5, utf8_decode('*'), 1, 0, 'C', false);
    $pdf->Cell(4.5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.8, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.2, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.8, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.8, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.8, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.8, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(5, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.6, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Cell(4.6, 5, utf8_decode(' '), 1, 0, 'C', false);

        $pdf->Cell(18, 5, utf8_decode(' '), 1, 0, 'C', false);
           
        $pdf->Cell(20, 5, utf8_decode(' '), 1, 0, 'C', false);
    $pdf->Ln(); // Agrega un salto de línea
}

    



	
} else {
    // Si no se encuentra "$texto_grupo", se imprime el texto original sin realizar ninguna consulta
    $pdf->Cell(65, 10, utf8_decode('GRUPO:  6530 '), 1, 0, 'L', 0);
}


$pdf->Output('Prueba2.pdf', 'I');
?>