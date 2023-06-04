<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;

class HelpController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSendEmail()
    {
        // $email = null;
        $email = Yii::$app->mailer->compose('layouts/text', [
                'content' => "gustavo"
            ])
            ->setFrom('somebody@domain.com')
            ->setTo('myemail@yourserver.com')
            ->setSubject('Email sent from Yii2-Swiftmailer')
            ->send();
        print_r(json_encode(['email' => $email]));echo "\n\n";exit;
    }
}