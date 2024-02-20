<?php

require_once DOC_ROOT . 'core2/inc/classes/Common.php';
require_once DOC_ROOT . 'core2/inc/classes/class.list.php';
require_once DOC_ROOT . 'core2/inc/classes/class.edit.php';
require_once DOC_ROOT . 'core2/inc/classes/class.tab.php';


class ModNewsController extends Common {

    /**
     * этот метод будет обрадатываться по умолчанию при обращении к модулю
     * @return string|void
     * @throws Zend_Exception
     * @throws Exception
     */
    public function action_index() {
        $tab = new \tabs('roles');
        $tab->beginContainer($this->translate->tr("Новости"));
        if (isset($_GET['edit']) && $_GET['edit'] != '') {
            $form = new \editTable('news_article');
            $form->SQL = $this->db->quoteInto("
                SELECT `id`, `title`, `content`
                FROM news_article
                WHERE id = ?
            ", $_GET['edit']);
            $form->addControl($this->translate->tr("Название:"), "TEXT", "maxlength=\"255\" size=\"60\"", "", "", true);
            $form->addControl($this->translate->tr("Текст:"), "TEXTAREA", "maxlength=\"255\" size=\"60\"", "", "", true);
            $form->save('xajax_saveNewsArticle(xajax.getFormValues(this.id))');
            $form->showTable();
        }

        $list = new \listTable('news');
        $list->addColumn($this->_('Заголовок'));
        $list->addColumn($this->_('Автор'));
        $list->addColumn($this->_('Дата'), "100", "DATETIME");
        $list->table = "news_article";
        $list->SQL = "
            SELECT id, title, u.u_login, published
            FROM news_article AS a
            LEFT JOIN core_users u ON u.u_id = a.author_id
        ";
        $list->deleteKey = 'news_article.id';
        $list->addURL = 'index.php?module=news&edit=0';
        $list->editURL = 'index.php?module=news&edit=TCOL_00';
        $list->showTable();
        $tab->endContainer();
    }
}