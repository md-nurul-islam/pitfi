<?php

class SiteController extends Controller {

    public $defaultAction = 'login';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = 'login';
        $this->pageTitle = Yii::app()->name . ' | Login';
        
        $model = new User;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo $model->validate();
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            if ($_POST['User']['rememberMe']) {
                $model->rememberMe = $_POST['User']['rememberMe'];
            }

            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect('/product/sale');
            }
            //$this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionTest() {
        $this->layout = false;
        $this->render('test');
    }

    public function actionGetdata() {

        foreach (DataGridHelper::$_ar_non_filterable_vars as $nfv_key => $nfv_var_name) {
            ${$nfv_var_name} = Yii::app()->request->getParam($nfv_key);
        }

        $rows = array();
        $offest = 0;

        if (${DataGridHelper::$_ar_non_filterable_vars['page']} > 1) {
            $offest = (${DataGridHelper::$_ar_non_filterable_vars['page']} - 1) * ${DataGridHelper::$_ar_non_filterable_vars['rows']};
        }

        $productDetails = new ProductDetails();

        $productDetails->pageSize = 20;
        $query_params = array(
            'offset' => $offest,
            'order' => ${DataGridHelper::$_ar_non_filterable_vars['sort']} . ' ' . ${DataGridHelper::$_ar_non_filterable_vars['order']},
            'where' => $_POST,
        );
        
        $result['rows'] = $productDetails->dataGridRows($query_params);
//        var_dump($result['rows']);exit;
        $result["total"] = 0;
        
        if(($result['rows'])) {
            $result["total"] = $result['rows'][0]['total_rows'];
        }
        echo CJSON::encode($result);
        Yii::app()->end();
    }

    public function actionGetStatusComboData() {
        echo CJSON::encode(ProductDetails::model()->statusComboData());
    }

    public function actionTest1($param) {
        # mPDF
//        $mPDF1 = Yii::app()->ePdf->mpdf();
        # You can easily override default constructor's params
//        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');
        # render (full page)
//        $mPDF1->WriteHTML($this->render('test', array(), true));
        # Load a stylesheet
//        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
//        $mPDF1->WriteHTML($stylesheet, 1);
        # renderPartial (only 'view' of current controller)
//        $mPDF1->WriteHTML($this->renderPartial('test', array(), true));
        # Renders image
//        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif'));
//        var_dump($mPDF1->Output());exit;
        # Outputs ready PDF
//        $mPDF1->Output();
    }

}
