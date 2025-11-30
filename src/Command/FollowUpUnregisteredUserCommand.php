<?php

declare(strict_types=1);

namespace App\Command;

use Cake\Log\Log;

use Cake\Mailer\Mailer;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * FollowUpUnregisteredUser command.
 */
class FollowUpUnregisteredUserCommand extends Command
{
    /**
     * The name of this command.
     *
     * @var string
     */
    protected string $name = 'follow_up_unregistered_user';

    /**
     * Get the default command name.
     *
     * @return string
     */
    public static function defaultName(): string
    {
        return 'follow_up_unregistered_user';
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
        return parent::buildOptionParser($parser)
            ->setDescription(static::getDescription());
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
        $verificationsTable = $this->fetchTable('EmailVerifications');

        // fetch distinct emails in email_verifications where used IS null (not in users table)
        $emails = $verificationsTable->find()
                                        ->select(['email'])
                                        ->distinct(['email'])
                                        ->where([
                                            'DATE(EmailVerifications.created)' => date('Y-m-d', strtotime('-1 day')),
                                            'EmailVerifications.used IS'       => null
                                        ])
                                        ->all()
                                        ->extract('email')
                                        ->toList();

        $mailer = new Mailer('default');

        foreach ($emails as $email)
        {       
            $mailer->setEmailFormat('html')
                    ->setFrom(['invoke.jy@gmail.com' => 'Cake'])
                    ->setTo($email)
                    ->setSubject('Cake - Complete Your Registration')
                    ->viewBuilder()
                        ->setTemplate('unregistered')
                        ->setLayout('default');

            $mailer->deliver();

            Log::write('debug', "Unregisted email sent to {$email}");
        }

        $io->out(true);
    }
}
