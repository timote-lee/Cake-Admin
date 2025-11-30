<?php

declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * PasswordHash command.
 */
class PasswordHashCommand extends Command
{
    /**
     * The name of this command.
     *
     * @var string
     */
    protected string $name = 'password_hash';

    /**
     * Get the default command name.
     *
     * @return string
     */
    public static function defaultName(): string
    {
        return 'password_hash';
    }

    /**
     * Get the command description.
     *
     * @return string
     */
    public static function getDescription(): string
    {
        return 'Command description here.';
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @link https://book.cakephp.org/5/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser
            ->addArgument('password', [
                'help'     => 'The plain text password to hash.',
                'required' => true,
            ]);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null|void The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $password = $args->getArgument('password');

        $hasher = new DefaultPasswordHasher();
        $hashed_password = $hasher->hash($password);

        $io->out('Hashed Password: ' . $hashed_password);
    }
}
