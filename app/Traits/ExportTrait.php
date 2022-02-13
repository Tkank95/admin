<?php

namespace App\Traits;

use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Rap2hpoutre\FastExcel\FastExcel;

trait ExportTrait
{

    public function exportTrait($sql, $filename)
    {
        function modelGenerator($sql)
        {
            foreach ($sql->cursor() as $model) {
                yield $model;
            }
        }

        $header_style = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(13)
            ->setFontName('calibri')
            ->build();

        $rows_style = (new StyleBuilder())
            ->setFontSize(11)
            ->setFontName('calibri')
            ->setCellAlignment('left')
            ->build();

        return (new FastExcel(modelGenerator($sql)))
            ->headerStyle($header_style)
            ->rowsStyle($rows_style)
            ->download($filename);
    }
}
