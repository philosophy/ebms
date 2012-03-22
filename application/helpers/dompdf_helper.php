<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
    function pdf_create($html, $filename, $stream=true, $papersize = 'letter', $orientation = 'portrait')
    {
        require_once("dompdf/dompdf_config.inc.php");
 
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($papersize, $orientation);
        $dompdf->render();
 
        if ($stream)
        {
            $options['Attachment'] = 1;
            $options['Accept-Ranges'] = 0;
            $options['compress'] = 1;
            $dompdf->stream($filename.".pdf", $options);
        }
        else
        {
            write_file("$filename.pdf", $dompdf->output());
        }
    }
?>