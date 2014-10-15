<?php
/**
 * This file is part of the server-component project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Server\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class RunCommand
 *
 * @author Kevin Archer (http://github.com/kevinarcher)
 * @author Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Server\Command
 */
final class RunCommand extends Command
{
    const NAME = 'server:run';

    // todo add frontend script
    // todo add server root
    // todo configure through config file

    protected function configure()
    {
        $this->setName(self::NAME);
        $this->setDescription('Start the development server');
        $this->addOption('env', 'e', InputOption::VALUE_REQUIRED, 'Environment to run the web server in', 'dev');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // todo configure port
        // todo configure server name
        $output->writeln('Server running on <info>http://localhost:8000/</info>');

        $builder = new ProcessBuilder([
            PHP_BINARY,
            '-S',
            'localhost:8000',
            '-t',
            'web/',
            sprintf('web/%s.php', $input->getOption('env'))
        ]);

        $builder->setTimeout(null);
        $builder->getProcess()->run(
            function ($type, $buffer) use ($output) {
                $output->write($buffer);
            }
        );
    }
}
