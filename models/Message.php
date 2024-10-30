<?php 
    class Message{
        private $url;
        private $messages = [
            'required_fields' => 'Preencha todos os campos necessários',
            'login' => 'Login realizado com sucesso',
            'logout' => 'LogOut realizado com sucesso',
            'error' => 'Ocorreu um erro. Tente novamente',
            'email' => 'E-mail ja cadastrado.',
            'unauthorized' => 'Não autorizado.',
            'incorrect_fields' => 'Email ou senha incorretos',
            'image_error' => 'Erro ao processar a imagem. Verifique se o arquivo está corrompido.',
            'image_invalid' => 'Tipo inválido de imagem, insira png ou jpg.'
        ];

        function __construct($url){
            $this->url = $url;
        }

        public function setMessage($key, $type, $redirect = 'index.php'){
            
            if (isset($this->messages[$key])) {
                $_SESSION['msg'] = $this->messages[$key];
                $_SESSION['type'] = $type;
            } else {
                $_SESSION['msg'] = 'Mensagem não definida';
                $_SESSION['type'] = 'error';
            }

            if($redirect != 'back'){
                header('Location: ' . $redirect);
            }else{
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }

        public function getMessage(){
            if(!empty($_SESSION['msg'])){
                return [
                    'msg' => $_SESSION['msg'],
                    'type' => $_SESSION['type']
                ];
            }else{
                return false;
            }
        }

        public function clearMessage(){
            $_SESSION['msg'] = '';
            $_SESSION['type'] = '';
        }
    }