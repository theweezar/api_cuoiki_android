<?php

class PrinterController {
    public function printDocs() {
        // http://localhost/CapPhatController-baocaoQuery?manv=NV01
        $content = json_decode(file_get_contents("http://localhost/CapPhatController-baocaoQuery?manv=NV01"));
        
        if ($content->success) {
            $viewData = $content->viewData;
            ob_start();
            Response::render('table.php', $viewData);
            $htmlContent = ob_get_clean();
            sendMail("minhducducminh1999@gmail.com", "Minh Duc", "Report", $htmlContent);
            Response::render('table.php', $viewData);
        }
    }
}

?>