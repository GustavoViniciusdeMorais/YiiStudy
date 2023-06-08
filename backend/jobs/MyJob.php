<?php

namespace backend\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use Yii;

class MyJob extends BaseObject implements JobInterface
{
    public $message;

    public function execute($queue)
    {
        if (empty($this->message)) {
            $this->message = 'sent from redis';
        }

        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo('to@domain.com')
            ->setSubject($this->message)
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
    }
}
