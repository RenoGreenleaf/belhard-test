<?php

require_once DOC_ROOT . 'core2/inc/classes/Common.php';
require_once DOC_ROOT . 'core2/inc/classes/class.list.php';


class ModNewsController extends Common {

    /**
     * этот метод будет обрадатываться по умолчанию при обращении к модулю
     * @return string|void
     * @throws Zend_Exception
     * @throws Exception
     */
    public function action_index() {
        $list = new \listTable('news');
        $list->addColumn($this->_('Заголовок'));
        $list->addColumn($this->_('Автор'));
        $list->addColumn($this->_('Дата'), "100", "DATETIME");
        $list->showTable();
    }
}