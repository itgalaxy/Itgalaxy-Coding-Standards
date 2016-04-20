<?php
$directory = 'directory';
$filename = 'filename.php';
$xterm = 'xterm';
$command = 'ls';
$tunnel = '192.168.0.1';

require 'filename.php';
require 'http.php';
require 'https.php';
require 'ftp.php';
require 'ssh2.php';
require $filename;
require 'test/' . $filename;
require $directory . '/' . $filename;

require_once 'filename.php';
require_once 'http.php';
require_once 'https.php';
require_once 'ftp.php';
require_once 'ssh2.php';
require_once $filename;
require_once 'test/' . $filename;
require_once $directory . '/' . $filename;

include 'filename.php';
include 'http.php';
include 'https.php';
include 'ftp.php';
include 'ssh2.php';
include $filename;
include 'test/' . $filename;
include $directory . '/' . $filename;

include_once 'filename.php';
include_once 'http.php';
include_once 'https.php';
include_once 'ftp.php';
include_once 'ssh2.php';
include_once $filename;
include_once 'test/' . $filename;
include_once $directory . '/' . $filename;

require 'http://domain.com/test.php';
require 'https://domain.com/test.php';
require 'ftp://domain.com/test.php';
require 'ssh2.shell://user:pass@example.com:22/xterm';
require 'ssh2.exec://user:pass@example.com:22/usr/local/bin/somecmd';
require 'ssh2.tunnel://user:pass@example.com:22/192.168.0.1:14';
require 'ssh2.sftp://user:pass@example.com:22/path/to/filename';

require_once 'http://domain.com/test.php';
require_once 'https://domain.com/test.php';
require_once 'ftp://domain.com/test.php';
require_once 'ssh2.shell://user:pass@example.com:22/xterm';
require_once 'ssh2.exec://user:pass@example.com:22/usr/local/bin/somecmd';
require_once 'ssh2.tunnel://user:pass@example.com:22/192.168.0.1:14';
require_once 'ssh2.sftp://user:pass@example.com:22/path/to/filename';

include 'http://domain.com/test.php';
include 'https://domain.com/test.php';
include 'ftp://domain.com/test.php';
include 'ssh2.shell://user:pass@example.com:22/xterm';
include 'ssh2.exec://user:pass@example.com:22/usr/local/bin/somecmd';
include 'ssh2.tunnel://user:pass@example.com:22/192.168.0.1:14';
include 'ssh2.sftp://user:pass@example.com:22/path/to/filename';

include_once 'http://domain.com/test.php';
include_once 'https://domain.com/test.php';
include_once 'ftp://domain.com/test.php';
include_once 'ssh2.shell://user:pass@example.com:22/xterm';
include_once 'ssh2.exec://user:pass@example.com:22/usr/local/bin/somecmd';
include_once 'ssh2.tunnel://user:pass@example.com:22/192.168.0.1:14';
include_once 'ssh2.sftp://user:pass@example.com:22/path/to/filename';

require 'http://domain.com/' . $filename;
require 'https://domain.com/' . $filename;
require 'ftp://domain.com/' . $filename;
require 'ssh2.shell://user:pass@example.com:22/' . $xterm;
require 'ssh2.exec://user:pass@example.com:22/' . $command;
require 'ssh2.tunnel://user:pass@example.com:22/' . $tunnel;
require 'ssh2.sftp://user:pass@example.com:22/' . $filename;

require_once 'http://domain.com/' . $filename;
require_once 'https://domain.com/' . $filename;
require_once 'ftp://domain.com/' . $filename;
require_once 'ssh2.shell://user:pass@example.com:22/' . $xterm;
require_once 'ssh2.exec://user:pass@example.com:22/' . $command;
require_once 'ssh2.tunnel://user:pass@example.com:22/' . $tunnel;
require_once 'ssh2.sftp://user:pass@example.com:22/' . $filename;

include 'http://domain.com/' . $filename;
include 'https://domain.com/' . $filename;
include 'ftp://domain.com/' . $filename;
include 'ssh2.shell://user:pass@example.com:22/' . $xterm;
include 'ssh2.exec://user:pass@example.com:22/' . $command;
include 'ssh2.tunnel://user:pass@example.com:22/' . $tunnel;
include 'ssh2.sftp://user:pass@example.com:22/' . $filename;

require_once 'http://domain.com/' . $filename;
require_once 'https://domain.com/' . $filename;
require_once 'ftp://domain.com/' . $filename;
require_once 'ssh2.shell://user:pass@example.com:22/' . $xterm;
require_once 'ssh2.exec://user:pass@example.com:22/' . $command;
require_once 'ssh2.tunnel://user:pass@example.com:22/' . $tunnel;
require_once 'ssh2.sftp://user:pass@example.com:22/' . $filename;

require 'a.inc';
require_once 'b.inc';
require_once ('c.inc');
require ('d.inc');
include 'a1.inc';
include_once 'b1.php';
include ('a' . 'b');
require_once 'a' . 'b';

class TestInclude
{
    public function go($a)
    {
        include "$a";
        include "$a" . 'test';
    }
}

require_once 'test.php';

class SomeController extends Controller
{
    public function a()
    {
        require_once "o.inc";
    }
}

require_once 'controller.php';

class SomeController2 extends Controller
{
}
