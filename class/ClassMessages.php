<?php


class ClassMessages {
    
    private static $messageNumber;
    private static $messageID;
    
    public static function Message( $number ){
        
        self::$messageID = (int) substr($number, 0, 1);
        self::$messageNumber = $number;

        switch(self::$messageID):
            case 0:
                return self::SuccessGeneric();
                break;
            
            case 1:
                return self::PostMessage();
                break;
            
            case 2:
                return self::Categorias();
                break;
            
            case 3:
                return self::Arquivos();
                break;
            
            case 4:
                return self::Configuracoes();
                break;
            
            case 5:
                return self::Convites();
                break;
            
            case 6:
                return self::Perfil();
                break;

        endswitch;
    }
    
    
    private static function SuccessGeneric(){
        
        switch(self::$messageNumber):

            case '001':
                return 'Postagem publicada com sucesso';
                break;
            
            case '002':
                return 'Postagem alterada com sucesso';
                break;
            
            case '003':
                return 'Postagem excluída com sucesso';
                break;
            
            case '004':
                return 'Postagem agendada com sucesso';
                break;
            
            case '005':
                return 'Postagem movida com sucesso';
                break;
            
            case '006':
                return 'Postagem criada com sucesso';
                break;
                
            case '007':
                return 'Postagem excluída com sucesso';
                break;
                
            case '008':
                return 'Categoria alterada com sucesso';
                break;
            
            case '009':
                return 'Configurações alteradas com sucesso';
                break;
            
            case '010':
                return 'Configurações de email alteradas com sucesso';
                break;
            
            case '011':
                return 'Email enviado com sucesso';
                break;
            
            case '012':
                return 'Convite enviado com sucesso';
                break;
            
            case '013':
                return 'Perfil aterado com sucesso';
                break;
            
            default:
                return 'Contate o administrador: 0XX';
                break;

        endswitch;
        
    }
    
    
    private static function PostMessage(){
        
        switch(self::$messageNumber):
            case '101':
                return 'Ausência de título.';
                break;
            
            case '102':
                return 'Ausência de subtítulo.';
                break;
            
            case '103':
                return 'Ausência de texto.';
                break;
            
            case '104':
                return 'Ausência de tags.';
                break;
            
            case '105':
                return 'Ausência de agendamento.';
                break;
            
            case '106':
                return 'Ausência de categoria.';
                break;
            
            case '107':
                return 'Ausência da identificação do autor.';
                break;
            
            case '108':
                return 'Ausência do nome do autor.';
                break;
            
            case '109':
                return 'Sem data de publicação.';
                break;
            
            case '110':
                return 'Sem URL.';
                break;
            
            case '111':
                return 'Sem status';
                break;
            
            case '112':
                return 'Título ultrapassou 255 caracteres.';
                break;
            
            case '113':
                return 'Subtítulo ultrapassou 255 caracteres.';
                break;
            
            case '114':
                return 'Tags ultrapassou 255 caracteres.';
                break;
            
            case '115':
                return 'Não é possível criar uma publicação, permissão negada.';
                break;
            
            case '116':
                return 'Não é possível excluir esta publicação, permissão negada.';
                break;
            
            case '117':
                return 'Não é possível alterar a URL, permissão negada.';
                break;
            
            case '118':
                return 'Não é possível editar postagem, permissão negada';
                break;
            
            case '119':
                return 'Erro desconhecido na publicação, informe ao desenvolvedor.';
                break;
            
            default:
                return 'Contate o administrador: 1XX';
                break;            

        endswitch;
        
    }
    
    
    private static function Categorias(){
        
        switch(self::$messageNumber):
            
            case '201':
                return 'Ausência de rótulo da categoria';
                break;
            
            case '202':
                return 'Ausência de descrição';
                break;
            
            case '203':
                return 'Não foi possível excluir a categoria selecionada';
                break;
            
            case '204':
                return 'Não foi possível excluir a categoria, permissão negada.';
                break;
            
            case '205':
                return 'Não foi possível editar a categoria, permissão negada.';
                break;
            
            case '206':
                return 'Não é possível criar uma categoria, permissão negada';
                break;
            
            default:
                return 'Contate o administrador: 2XX';
                break;            
        endswitch;
    
    }
    
    
    private static function Arquivos(){
        
        switch(self::$messageNumber):
            
            case '301':
                return 'Ausência de arquivo';
                break;
            
            case '302':
                return 'Tipo de arquivo não permitido';
                break;
            
            case '303':
                return 'Tamanho do arquivo acima do permitido';
                break;
            
            case '304':
                return 'Upload de arquivo não permitido, acesso negado';
                break;
            
            case '305':
                return 'Pasta ausente';
                break;
            
            case '306':
                return 'Ação incorreta, contate o administrador';
                break;
            
            case '307':
                return 'Dimensões não permitidas, rente a recomendada';
                break;
                        
            case '308':
                return 'Altura do arquivo não permitida';
                break;
            
            case '309':
                return 'Largura do arquivo não permitida';
                break;
            
            case '310':
                return 'Capa com tamanho não permitido';
                break;
            
            case '311':
                return 'Capa com tipo de arquivo não permitido';
                break;
            
            case '312':
                return 'Capa com tamanho acima do permitido';
                break;
            
            case '313':
                return 'Perfil com resolução não permitida';
                break;
            
            case '314':
                return 'Perfil com tipo de arquivo não permitido';
                break;
            
            case '315':
                return 'Perfil com tamanho acima do permitido';
                break;
            
            case '316':
                return 'Miniatura fora do tamanho especificado';
                break;
            
            case '317':
                return 'Miniatura com tipo não permitido';
                break;
            
            case '318':
                return 'Miniatura fora do tamanho permitido';
                break;
            
            case '319':
                return 'Formato não esta em PDF';
                break;
            
            case '320':
                return 'Arquivo maior que o especificado';
                break;
            
            case '321':
                return 'Diretório não existe';
                break;
            
            default:
                return 'Contate o administrador: 3XX';
                break;

        endswitch;
        
    }

    
    public static function Configuracoes(){
        
        switch(self::$messageNumber):
            case '401':
                return 'Configurações inválidas';
                break;
            
            default:
                return 'Contate o administrador: 4XX';
                break;            
        endswitch;
        
    }

    
    public static function Convites(){

        switch(self::$messageNumber):
            case '501':
                return 'Convite enviado com sucesso';
                break;

            case '502':
                return 'Email já existe na base de dados';
                break;

            case '503':
                return 'Não é possível enviar o convite';
                break;
            
            default:
                return 'Contate o administrador: 5XX';
                break;            

        endswitch;
        
    }
    
    private static function Perfil(){
        
        switch(self::$messageNumber):
            case '601':
                return 'Perfil alterado com sucesso';
                break;
            
            case '602':
                return 'Erro na edição do perfil';
                break;
            
            case '603':
                return 'Erro na alteração da foto do perfil';
                break;
            
            case '604':
                return 'Erro na alteração da imagem de capa';
                break;
                
            case '605':
                return 'Imagem de perfil alterado com sucesso';
                break;
            
            case '606':
                return 'Imagem de capa alterado com sucesso';
                break;
            
            case '607':
                return 'Erro na alteração no banco de dados';
                break;
            
            default:
                return 'Contate o administrador: 6XX';
                break;

        endswitch;
    }
}
