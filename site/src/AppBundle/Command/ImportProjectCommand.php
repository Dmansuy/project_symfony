<?php
/**
 * Created by IntelliJ IDEA.
 * User: dmansuy
 * Date: 22/02/2018
 * Time: 13:29
 */

namespace AppBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportProjectCommand extends Command
{
    protected function configure()
    {
        $this
            // le nom de la commande (la partie après "bin/console")
            ->setName('app:create:project')
            // Une description courte, affichée lors de l'éxécution de la

            // commande "php bin/console list"
            ->setDescription('Create project.')
            // La description complète affichée lorsque l'on ajoute

            // l'option "--help"
            ->setHelp('This command allow you to create a project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Create Project',
            '==============',
            '',
        ]);
        $output->writeln('Whoa!');
        $output->write('You are about to ');
        $output->write('create a project.');
    }
}