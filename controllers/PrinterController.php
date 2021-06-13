<?php

class PrinterController {
    public function printDocs() {
        // http://localhost/CapPhatController-baocaoQuery?manv=NV01
        $content = file_get_contents("http://localhost/CapPhatController-baocaoQuery?manv=NV01");
        if ($content['success']) {
            
        }
    }
}