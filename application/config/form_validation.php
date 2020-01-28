
<?php
$config = array(
        'attendance' => array(
                array(
                        'field' => 'label',
                        'label' => 'label',
                        'rules' => 'required|trim|numeric',
                ),
                array(
                        'field' => 'date',
                        'label' => 'date',
                        'rules' => 'required|trim|numeric',
                )
        ),
        'signin' => array(
                array(
                        'field' => 'user_name',
                        'label' => 'ユーザ名',
                        'rules' => 'required|trim',
                        'errors' => array(
                            'required' => '%sを入力してください。'
                        ),
                ),
                array(
                        'field' => 'password',
                        'label' => 'パスワード',
                        'rules' => 'required|md5|trim',
                        'errors' => array(
                            'required' => '%sを入力してください。',
                        ),
                )
        )
);
?>
