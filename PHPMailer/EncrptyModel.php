<?php
class passEncrypt{
    public function twoPassEncrypt($data) {
        $tempHash = md5($data);
        return hash('sha1', $tempHash);
    }
} ?>