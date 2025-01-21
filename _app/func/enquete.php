<?php
/*======================================================================

アンケートの内容

======================================================================*/
class appFuncEnquete
{
    public function disp($data, $key, $addTitle = '', $addForm = '')
    {
        $module = [
            'check' => '../_module/form/q_check.php',
            'text' => '../_module/form/q_text.php',
            'radio' => '../_module/form/q_radio.php'
        ];
        $id = $data[$key]['id'];
        $title = null;
        $type = $data[$key]['type'];
        $answer = [];
        $add = null;
        $include = '';
        if (isset($data[$key]['title'])) {
            $title = $data[$key]['title'];
        }
        if (isset($data[$key]['answer'])) {
            $answer = $data[$key]['answer'];
        }
        if (isset($data[$key]['add'])) {
            $add = $data[$key]['add'];
        }
        if (isset($data[$key]['type'])) {
            $include = $module[$type];
            include $include;
        }
    }
    public function print($data, $key, $addTitle = '', $addForm = '')
    {
        $module = [
            'check' => '../_module/form/print_check.php',
            'text' => '../_module/form/print_text.php',
            'radio' => '../_module/form/print_radio.php'
        ];
        $id = $data[$key]['id'];
        $title = null;
        $type = $data[$key]['type'];
        $answer = [];
        $add = null;
        $include = '';
        if (isset($data[$key]['title'])) {
            $title = $data[$key]['title'];
        }
        if (isset($data[$key]['answer'])) {
            $answer = $data[$key]['answer'];
        }
        if (isset($data[$key]['add'])) {
            $add = $data[$key]['add'];
        }
        if (isset($data[$key]['type'])) {
            $include = $module[$type];
            include $include;
        }
    }
}
