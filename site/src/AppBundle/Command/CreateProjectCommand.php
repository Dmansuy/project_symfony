<?php
/**
 * Created by IntelliJ IDEA.
 * User: dmansuy
 * Date: 22/02/2018
 * Time: 13:28
 */

namespace AppBundle\Command;


use AppBundle\Manager\ProjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateProjectCommand extends Command
{
    private $projectManager;

    public function __construct(ProjectManager $projectManager)
    {
        $this->projectManager = $projectManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('name', InputArgument:: REQUIRED, 'The name of the project.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->projectManager->createFromName($input->getArgument('name'));
        $output->writeln('Project successfully created !');
    }
}