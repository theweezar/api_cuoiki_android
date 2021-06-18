<?php

class PrinterController {
    public function printDocsNhanVien($argv) {
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
            Response::render('table_1.php', $viewData);
            $htmlContent = ob_get_clean();
            sendMail("minhducducminh1999@gmail.com", "Minh Duc", "Report", $htmlContent);
            Response::render('table_1.php', $viewData);
        }
    }

    public function printDocsPhongBan($argv) {
        // http://localhost/CapPhatController-baocaoQuery?mapb=PB01

        $content = null;

        if (isset($argv['params']['mapb'])) {
            $content = json_decode(
                file_get_contents("http://localhost/CapPhatController-baocaoQuery?mapb=".$argv['params']['mapb'])
            );
        }

        if (isset($content)
            && $content->success) {
            $viewData = $content->viewData;
            Response::render('table_2.php', $viewData);
            $htmlContent = ob_get_clean();
            sendMail("minhducducminh1999@gmail.com", "Minh Duc", "Report", $htmlContent);
            Response::render('table_2.php', $viewData);
        }

    }
}

?>