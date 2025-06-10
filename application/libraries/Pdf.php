<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {
    public $filename;

    public function __construct()
    {
        $this->filename = "laporan.pdf";
    }

    public function load_view($view, $data = array())
    {
        $CI =& get_instance();
        $html = $CI->load->view($view, $data, TRUE);

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE); // Untuk load gambar/css external jika ada

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // $dompdf->stream($this->filename, array("Attachment" => FALSE)); // Tampilkan di browser
        $dompdf->stream($this->filename, array("Attachment" => TRUE)); // Langsung download
    }
}