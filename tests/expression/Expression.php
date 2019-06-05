<?php
######################################################################

spl_autoload_register(function ($class_name)
{
    if (strpos($class_name, "generated\\Contexts\\") === 0) {
        include 'generated/ExpressionParser.php';
    }
    else {
        include "$class_name.php";
    }
});

######################################################################

use \Antlr4\CharStreams;
use \Antlr4\CommonTokenStream;

######################################################################

$lexer = new \generated\ExpressionLexer(CharStreams::fromString("12"));
//$lexer->AddErrorListener(new ThrowExceptionErrorListenerOnLex());
$tokens = new CommonTokenStream($lexer);
$parser = new \generated\ExpressionParser($tokens);
//$parser->addErrorListener(new ThrowExceptionErrorListenerOnParse());

$tree = $parser->atom();
$visitor = new ExpressionVisitor();
$r = $visitor->visit($tree);
echo $r;
