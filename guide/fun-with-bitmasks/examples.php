<?php
echo decbin(E_ALL)."\n";             //    111011111111111
echo decbin(E_NOTICE)."\n";          //    000000000001000
echo decbin(E_ALL & ~E_NOTICE)."\n"; //    111011111110111
echo decbin(E_ALL ^ E_NOTICE)."\n";  //    111011111110111
echo "\n\n";
echo (0 ^ 0)."\n";
echo (0 ^ 1)."\n";
echo (1 ^ 0)."\n";
echo (1 ^ 1)."\n";
echo "\n\n";

echo (0 &~ 0)."\n";
echo (0 &~ 1)."\n";
echo (1 &~ 0)."\n";
echo (1 &~ 1)."\n";


