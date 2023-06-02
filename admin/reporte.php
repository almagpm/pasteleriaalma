<?php
require_once("controllers/sistema.php");
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

//Arreglos de estilos
//Estilo para el encabezado
$tableHead = [
    'font' => [
        'color' => [
            'rgb' => 'FFFFFF'
        ],
        'bold' => true,
        'size' => 14
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '000000'
        ]
    ]
];
$titulo = [
    'font' => [
        'color' => [
            'rgb' => 'FFFFFF'
        ],
        'bold' => true,
        'size' => 20
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'A58E4E'
        ]
    ]
];
$subTitulo = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => true,
        'size' => 16
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'FFFFFF'
        ]
    ]
];
$infoGral = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => true,
        'size' => 12
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'D7DBDD'
        ]
    ]
];
$infoGral2 = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => false,
        'size' => 12
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'D7DBDD'
        ]
    ]
];
$evenRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'D7DBDD'
        ]
    ]
];
$oddRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'BDC3C7'
        ]
    ]
];
$aesthetic = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'FFFFFF'
        ]
    ]
];
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$sistema->db();
switch ($action):
    case 'reporte':
        $sql = "select * from producto";
        $st = $sistema->db->prepare($sql);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        //Establecer fuente de la letra
        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize(10);
        //Encabezado
        $spreadsheet->getActiveSheet()
            ->mergeCells("A1:G1");
        $spreadsheet->getActiveSheet()
            ->getStyle('A1')
            ->applyFromArray($titulo);
        $spreadsheet->getActiveSheet()
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        //Otro subencabezado
        $spreadsheet->getActiveSheet()
            ->setCellValue('A7', "Productos");
        $spreadsheet->getActiveSheet()
            ->mergeCells("A7:G7");
        $spreadsheet->getActiveSheet()
            ->getStyle('A7')
            ->applyFromArray($subTitulo);
        $spreadsheet->getActiveSheet()
            ->getStyle('A7')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //Establecer ancho de columnas
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('A')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('B')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('C')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('D')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('E')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('F')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('G')
            ->setAutoSize(true);
        //Encabezados tabla
        $spreadsheet->getActiveSheet()
            ->setCellValue('B8', "ID")
            ->setCellValue('C8', "Nombre")
            ->setCellValue('D8', "Precio");
        $spreadsheet->getActiveSheet()
            ->getStyle('B8:D8')
            ->getFont()
            ->setSize(12);
        $spreadsheet->getActiveSheet()
            ->getStyle('B8:D8')
            ->getFont()
            ->setBold(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('B8:D8')
            ->applyFromArray($tableHead);
        $spreadsheet->getActiveSheet()
            ->getStyle('B8:D8')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //Celdas extra
        $spreadsheet->getActiveSheet()
            ->mergeCells("E8:G8");
        $spreadsheet->getActiveSheet()
            ->getStyle('E8:G8')
            ->applyFromArray($aesthetic);
        $spreadsheet->getActiveSheet()
            ->getStyle('A8')
            ->applyFromArray($aesthetic);
        //Contenido de la tabla
        $row = 9;
        foreach ($data as $key => $tarea):
            $spreadsheet->getActiveSheet()
                ->setCellValue('B' . $row, $tarea['id_producto'])
                ->setCellValue('C' . $row, $tarea['nombre'])
                ->setCellValue('D' . $row, $tarea['precio_referencia']);
            if ($row % 2 == 0) {
                $spreadsheet->getActiveSheet()
                    ->getStyle('B' . $row . ':D' . $row)
                    ->applyFromArray($evenRow);
            } else {
                $spreadsheet->getActiveSheet()
                    ->getStyle('B' . $row . ':D' . $row)
                    ->applyFromArray($oddRow);
            }
            $spreadsheet->getActiveSheet()
                ->getStyle('B' . $row . ':D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $row)
                ->applyFromArray($aesthetic);
            $spreadsheet->getActiveSheet()
                ->mergeCells("E" . $row . ":G" . $row);
            $spreadsheet->getActiveSheet()
                ->getStyle('E' . $row . ':G' . $row)
                ->applyFromArray($aesthetic);
            $row++;
        endforeach;
        break;
    default:
endswitch;
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteProyectos.xlsx"');
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
?>