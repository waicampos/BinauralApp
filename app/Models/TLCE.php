<?php
namespace App\Models;

use PhpOffice\PhpWord\TemplateProcessor;


class TLCE extends \App\Models\AbstractModels\AbstractTLCE
{

    /**
     * Gera o TLCE usando a biblioteca PHPWord
     * 
     */
    public function gerarDoc($data)
    {
        $nome = $data->nome;
        $sobrenome = $data->sobrenome;

        $path = './storage/app/tlce/';

        $templateProcessor = new TemplateProcessor($path.'ola.docx');
        $templateProcessor->setValue('nome', 'Juliana');
        $templateProcessor->setValue('sobrenome', 'Hachmann');

        $pathToSave = 'path/to/save/mod.docx';
        $templateProcessor->saveAs($pathToSave);


    }

}
