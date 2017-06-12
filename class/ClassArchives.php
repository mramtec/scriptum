<?php

include_once 'defines.php';

class ClassArchives {


    private $local;
    private $arquivo;
    private $arquivoPath;

    
    public function setLocal($local){
        $this->local = $local;
    }
    
    
    public function setArquivo( $arquivo ){
        $this->arquivo = $arquivo;
    }
    
    
    public function setArquivoPath($arquivoPath){           /* Diretório para Exclusão ou Busca */
        $this->arquivoPath = $arquivoPath;
    }
    
    
    public function getValidaoArquivo( $tipo = 'imagem' ){
        
        list($width, $height, $type, $attr) = getimagesize( $this->arquivo['tmp_name'] );

        if($tipo == 'miniatura'){
        
            if( $type != 2 )
                return 302;
            elseif ( $width != MINIATURA_LARGURA )
                return 309;
            elseif ( $height != MINIATURA_ALTURA )
                return 308;
            else
                return (bool) true;

        }elseif( $tipo == 'capa' ){
            
            if( $type != 2 )
                return 302;
            elseif ( $width != CAPA_LARGURA )
                return 309;
            elseif ( $height != CAPA_ALTURA )
                return 308;
            else
                return (bool) true;
            
        }elseif( $tipo == 'perfil' ){
            
            if( $type != 2 )
                return 314;
            elseif ( $width != PERFIL_LARGURA )
                return 313;
            elseif ( $height != PERFIL_ALTURA )
                return 313;
            else
                return (bool) true;
                    
        }else{
            return 306;
        }

    }
    
    public function getValidarPasta(){
        if(is_dir('../../'.$this->local)){
            return TRUE;
        }else{
            return 321;
        }
    }
    
    public function getNovoArquivo($NomeFile = FALSE){
        
        $nome = NULL;
        
        if($NomeFile === FALSE)
            $nome = md5(date('Y-m-d H:i:s')).'.jpg';
        else
            $nome = $NomeFile.'.jpg';

        if(move_uploaded_file( $this->arquivo['tmp_name'] , '../../'.$this->local.$nome ))
            return $this->local.$nome;
        else
            return 305;

    }
    
    
    public function getExcluirArquivo(){

        if(is_file($this->arquivoPath)){
            if(unlink($this->arquivoPath))
                return true;
            else
                return false;
        }else
            return false;

    }
    /*
    public static function arquivo_validacao_miniatura(){

        list($width, $height, $type, $attr) = getimagesize( self::$path_arquivo['tmp_name'] );

        if( $type != 2 ){
            return 302;
        }elseif ( $width != MINIATURA_LARGURA ){
            return 309;
        }elseif ( $height != MINIATURA_ALTURA ){
            return 308;
        }else{
            return (bool) true;
        }

    }
    
    
    public static function arquivo_validacao_capa(){

        list($width, $height, $type, $attr) = getimagesize( self::$path_arquivo['tmp_name'] );

        if( $type != 2 ){
            return 302;
        }elseif ( $width != CAPA_LARGURA){
            return 309;
        }elseif ( $height != CAPA_ALTURA ){
            return 308;
        }else{
            return (bool) true;
        }

    }

    
    public static function arquivo_novo(){
        
        $pasta_destino = self::$path_upload;
        $nome = md5(date('Y-m-d H:i:s')).'.jpg';
        
        if(move_uploaded_file(self::$path_arquivo['tmp_name'], '../../'.$pasta_destino.$nome))
            return $pasta_destino.$nome;
        else
            return 305;

    }
    
    
    public static function arquivo_excluir(string $path){

        if(is_file($path)){
            unlink($path);
            return true;
        }else
            return false;
        
    }
    
    
    public static function arquivo_valida_perfil( $path ){

        list($width, $height, $type, $attr) = getimagesize( $path );

        if( $type != 2 ){
            return 314;
        }elseif ( $width != PERFIL_LARGURA ){
            return 313;
        }elseif ( $height != PERFIL_ALTURA ){
            return 313;
        }else{
            return (bool) true;
        }

    }
    
    
    public static function arquivo_valida_capa( $path ){

        list($width, $height, $type, $attr) = getimagesize( $path );

        if( $type != 2 ){
            return 311;
        }elseif ( $width != CAPA_LARGURA ){
            return 310;
        }elseif ( $height != CAPA_ALTURA ){
            return 310;
        }else{
            return (bool) true;
        }
    }
    
    
    public static function arquivo_perfil( array $file, string $destino ){

        $nome = md5('perfil'.date('Y-m-d H:i:s')).'.jpg';

        try{
            if(move_uploaded_file($file['tmp_name'], '../../'.$destino.$nome))
                return $destino.$nome;
            else
                return 305;
        } catch (Exception $ex) {
            return $ex;
        }

    }
    
    
    public static function arquivo_capa(){
        
        $pasta_destino = self::$path_upload;
        $nome = md5('capa_'.date('Y-m-d H:i:s')).'.jpg';
        
        try{
            if(move_uploaded_file(self::$path_arquivo['tmp_name'], '../../'.$pasta_destino.$nome))
                return $pasta_destino.$nome;
            else
                return 305;
        } catch (Exception $ex) {
            return $ex;
        }

    }
    
    */
    /******************************* Função usada no isabeltavares.com
    ******************************************************************/
    
    public static function arquivo_validacao_miniatura_livro(){

        list($width, $height, $type, $attr) = getimagesize( self::$path_arquivo['tmp_name'] );

        if( $type != 2 ){
            return 317;
        }elseif ( $width != 400){
            return 316;
        }elseif ( $height != 620 ){
            return 316;
        }else{
            return (bool) true;
        }

    }    
    
    
    public static function arquivo_documento_valida(){
        
        try{
        
            if(self::$path_arquivo['type'] != "application/pdf")
                return 319;
            elseif(self::$path_arquivo['size'] > 1024 * 1024 * 25)
                return 320;
            else
                return true;

        } catch (Exception $e){
            return $e;
        }

    }
    
    
    public static function arquivo_documento_novo_pdf(){
        
        $pasta_destino = self::$path_upload;
        $nome = md5('book_'.date('Y-m-d H:i:s')).'.pdf';
        
        try{
            if(move_uploaded_file(self::$path_arquivo['tmp_name'], '../../'.$pasta_destino.$nome))
                return $pasta_destino.$nome;
            else
                return 305;
        } catch (Exception $ex) {
            return $ex;
        }        
        
    }

}