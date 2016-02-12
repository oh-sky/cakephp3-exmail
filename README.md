# cakephp3-exmail
Cakephp3Exmail is extended Class of Cake\Mailer\Email.
Send Emails with Base64 or quoted-printable.

[![Build Status](https://travis-ci.org/oh-sky/cakephp3-exmail.svg?branch=master)](https://travis-ci.org/oh-sky/cakephp3-exmail)

# Requirements

- CakePHP 3.1.x

# Installation

```
composer require oh-sky/cakephp3-exmail
```

# Example

```app/Console/Command/MailShell.php
<?php
namespace App\Shell;

use Cake\Console\Shell;
use OhSky\CakephpExmail;

class MailShell extends Shell
{

    public function main()
    {
        $email = new Cakephp3Exmail();
        $mail = $email->from('from@example.com')
                      ->to('to@example.com')
                      ->subject('subject')
                      ->send('Hello');
    }
}
```

# Test

```
git clone git@github.com:oh-sky/cakephp3-exmail.git cakephp3-exmail
cd cakephp3-exmail
composer install --dev
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```
