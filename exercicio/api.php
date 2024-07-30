<?php
    header('Content-Type:application/json');
    include 'conexao.php';

    $metodo = $_SERVER['REQUEST_METHOD'];

    $url = $_SERVER['REQUEST_URI'];

    $path = parse_url($url, PHP_URL_PATH);
    $path = trim($path, '/');


    $path_parts = explode('/', $path);
    echo json_encode($path_parts);

    $primeiraparte = isset($path_parts[0]) ? $path_parts[0] : ' '; 
    $segundaparte = isset($path_parts[1]) ? $path_parts[1] : ' '; 
    $terceiraparte = isset($path_parts[2]) ? $path_parts[2] : ' '; 
    $quartaparte = isset($path_parts[3]) ? $path_parts[3] : ' '; 

    $resposta = [
        'metodo' => $metodo, 
        'primeiraparte' => $primeiraparte,
        'segundaparte' => $segundaparte,
        'terceiraparte' => $terceiraparte,
        'quartaparte' => $quartaparte,
    ];

    //echo json_encode($resposta);

    switch($metodo){
        case 'GET':
            //lógica para GET
            if($terceiraparte == 'alunos' && $quartaparte == '' ){
            echo json_encode([
                'mensagem' => 'LISTA DE TODOS OS ALUNOS',
            ]);
        }
        elseif($terceiraparte == 'alunos' && $quartaparte != '' ){
            echo json_encode([
                'mensagem' => 'LISTA DE UM ALUNO',
                'id_aluno' => $quartaparte
            ]);
        }
        elseif($terceiraparte == 'cursos'){
            echo json_encode([
                'mensagem' => 'LISTA DE TODOS OS CURSOS',
            ]);
        }
            elseif($terceiraparte == 'cursos' && $quartaparte != '' ){
                echo json_encode([
                    'mensagem' => 'LISTA DE UM CURSO',
                    'id_curso' => $quartaparte
                ]);
            }
            break; 
                
        case 'POST':
            //lógica para POST
            break; 
        case 'PUT':
            //lógica para PUT
            break;     
        case 'DELETE':
            //lógica para DELETE
            break; 
         default:
         echo json_encode([
            'mensagem' => 'Metodo não permitido!',

         ]);
         break;   
    }  

?>