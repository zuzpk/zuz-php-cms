<?php 
match($_PARAMS->section){
    'privacy' => include(__DIR__ . '/help/privacy.php'),
    'cookies' => include(__DIR__ . '/help/cookies.php'),
    'terms' => include(__DIR__ . '/help/terms.php'),
    'gdpr' => include(__DIR__ . '/help/gdpr.php'),
    'roadmap' => include(__DIR__ . '/help/roadmap.php'),
    'checkpoints' => include(__DIR__ . '/help/checkpoints.php'),
    'refund-policy' => include(__DIR__ . '/help/refundpolicy.php'),
    'refund-request' => include(__DIR__ . '/help/refundpolicy.php')
}
?>