<?php
    header('Content-type:application/json');
    include 'conexao.php';

    $metodo = $_SERVER['REQUEST_METHOD'];

    $url = $_SERVER['REQUEST_URI'];

    $path = parse_url($url, PHP_URL_PATH);
    $path = trim($path, '/');


    $path_parts = explode('/', $path);
    //echo json_encode($path_parts);

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
           lista_alunos();
            
        }
        elseif($terceiraparte == 'alunos' && $quartaparte != '' ){
         
            lista_um_aluno($quartaparte);
        }
        elseif($terceiraparte == 'cursos'  && $quartaparte = ''){
        lista_cursos();
        }
        elseif($terceiraparte == 'cursos' && $quartaparte != '' ){
            lista_um_curso($quartaparte);
        }
        break; 
                
        case 'POST':
        //lógica para POST
        if($terceiraparte == 'alunos'){
            echo json_encode([
                'mensagem' => 'INSERE UM ALUNO',
            
            ]);
        }elseif($terceiraparte == 'cursos'){
                echo json_encode([
                    'mensagem' => 'INSERE UM ALUNO',
                ]);
            }
        
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

    
    function lista_alunos(){
        global $conexao;
        $resultado = $conexao  -> query ("SELECT * FROM alunos");
        $alunos = $resultado ->fetch_all(MYSQLI_ASSOC);
        echo json_encode([
            'mensagem' => 'LISTA DE TODOS OS ALUNOS',
            'dados' => $alunos
        ]);
    }

    function lista_um_aluno($quartaparte){
        global $conexao;
        $stmt = $conexao -> prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt -> bind_param('i',$quartaparte);
        $stmt -> execute();
        $resultado = $stmt->get_result();
        $alunos = $resultado ->fetch_assoc();

        echo json_encode([
            'mensagem' => 'LISTA DE UM ALUNO',
            'dados_aluno' => $alunos
        ]);
    }

    function lista_cursos(){
        global $conexao;
        $stmt -> $conexao -> prepare("SELECT * FROM cursos WHERE id = ?");
        $stmt -> bind_param('i',$quartaparte);
        $stmt -> execute();
        $resultado = $stmt->get_result();
        $cursos = $resultado ->fetch_assoc();
        echo json_encode([
            'mensagem' => 'LISTA DE TODOS OS CURSOS',
            'dados_cursos' => $cursos,
        ]);
    }

    function lista_um_curso($quartaparte){
        echo json_encode([
            'mensagem' => 'LISTA DE UM CURSO',
            'dado_curso' => $cursos,
        ]);
    }



?>