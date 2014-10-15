#!/usr/bin/env php
<?php
/**
 * This file is part of the server-component project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace {
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

    use Star\Component\Server\Command\RunCommand;
    use Symfony\Component\Console\Application;
    use Symfony\Component\Console\Input\ArgvInput;
    use Symfony\Component\Console\Output\ConsoleOutput;

    $app = new Application();
    $app->add(new RunCommand());

    $argv[] = '--ansi';
    $argv[] = RunCommand::NAME;
    $app->run(new ArgvInput($argv), new ConsoleOutput());
}
