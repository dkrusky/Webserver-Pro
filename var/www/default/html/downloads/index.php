<?php
define('URLSIGNINCLUDE', true);
include("protected.php");

$link = URLSigner::sign( 'http://127.0.0.1/downloads/protectedfile.zip', 10 );
echo '<a href="' . $link . '">Test Protected File</a>';