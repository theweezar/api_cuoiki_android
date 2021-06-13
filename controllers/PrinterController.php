<?php

class PrinterController {
    public function printDocs($argv) {
        // http://localhost/CapPhatController-baocaoQuery?manv=NV01

        $content = null;

        if (isset($argv['params']['manv'])) {
            $content = json_decode(
                file_get_contents("http://localhost/CapPhatController-baocaoQuery?manv=".$argv['params']['manv'])
            );
        }
        
        if (isset($content) 
            && $content->success) {
            $viewData = $content->viewData;
            ob_start();
            Response::render('table.php', $viewData);
            $htmlContent = ob_get_clean();
            sendMail("daiphan308@gmail.com", "Minh Duc", "Report", $htmlContent);
            Response::render('table.php', $viewData);
        }
    }
}

?>