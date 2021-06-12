<?php

class MailController {
    public function send($argv) {
        $emailTo = $argv['email'];
        $nameTo = $argv['name'];

        $content = "";
        


        sendMail($emailTo, $nameTo, $content);
    }
}