<?php

require_once DOC_ROOT . "core2/inc/ajax.func.php";

class ModAjax extends ajaxFunc {

    /**
     * Сохранение статьи.
     * @param array $data - данные формы
     * @return xajaxResponse - ответ будет обработан js функцией ядра
     */
    public function axSaveNewsArticle(array $data): xajaxResponse {
        $currentUserID = Zend_Registry::getInstance()->get('auth')->ID;
        $data['control']['author_id'] = $currentUserID;

        if ($this->ajaxValidate($data, ['title' => 'req', 'content' => 'req'])) {
            return $this->response;
        }

        if (!$last_insert_id = $this->saveData($data)) {
            return $this->response;
        }
 
        $this->done($data);
        return $this->response;
    }
}