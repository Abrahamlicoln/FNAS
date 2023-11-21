<?php
$email = "<script>ABRA'HAM";
$new = filter_var($email, FILTER_SANITIZE_STRING);
var_dump($new);
