<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga{

    /**
     * Identificador único da vaga
     * @var integer
     */
    public $id;

    
    /**
     * Titulo da vaga
     * @var string
     */
    public $titulo;

        /**
     * Descricaao da vaga (pode conter html)
     * @var string
     */
    public $descricao;

            /**
     * Define se a vaga ativa
     * @var string(s/n)
     */
    public $ativo;

    /**
     * Define a publicao da vaga
     * @var string
     */
    public $data;
    /**
     * 
     * Metodo responsavelpor cadastrar uma nova vaga no banco
     * @return boolean
     */
    public function cadastrar(){
        //DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');

        //INSERIR A VAGA NO BANCO
        $obDatabase = new Database('vagas');
        #echo "<pre>"; print_r($obDatabase); echo "</pre>"; exit;
        $this->id = $obDatabase->insert([
            'titulo'   => $this->titulo,
            'descricao'=> $this->descricao,
            'ativo'    => $this->ativo,
            'data'     => $this->data
        ]);
        
        //RETORNAR SUCESSO
        return true;



    }
    public static function getVagas($where = null, $order = null, $limit = null){
        return (new Database('vagas'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getVaga($id){
        return (new Database('vagas'))->select('id = '.$id)
                                      ->fetchObject(self::class);
    }
}