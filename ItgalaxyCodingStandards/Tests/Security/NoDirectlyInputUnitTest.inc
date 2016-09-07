<?php
someFunction($_GET['securityProblem']);
link($_GET['securityProblem'], foo($POST), bar($GLOBALSS));
link(getenv('REMOTE_ADDR'));
symlink($_GET['securityProblem']);
link($trustedVariable);
$object->link = 'string';
$object->link($_GET['securityProblem']);
$object::link = 'string';
$object::link($_GET['securityProblem']);
$object->someFunction($_GET['securityProblem']);
$object::someFunction($_GET['securityProblem']);
link($_POST['securityProblem']);
link($_REQUEST['securityProblem']);
link($_COOKIE['securityProblem']);
link($_SERVER['securityProblem']);
link($_FILES['securityProblem']);
link($_ENV['securityProblem']);
link($_SESSION['securityProblem']);
link($GLOBALS['securityProblem']);
link($GLOBALS['securityProblem']);
link;
link("$_POST");
link("{$_POST['securityProblem']}");
link ($_POST['securityProblem']);
link( $_POST['securityProblem'] );

abstract class Foo
{
    public abstract function link();
}

link($POST['securityProblem']);
link($someVariable, $_POST['securityProblem'], $GLOBALS);
link(sanitizing($_POST['notSecurityProblem']));
link([$_POST], [[$_GET]]);
