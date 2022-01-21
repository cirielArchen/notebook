<?php

declare(strict_types=1);

namespace App\Controller;

class NoteController extends AbstractController
{
    private const PAGE_SIZE = 10;

    public function createAction()
    {
        if($this->request->hasPost()) {
            $noteData = [
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description')
            ];
            $this->noteModel->create($noteData);
            $this->redirect('/app/index.php/', ['before' => 'created']);
            exit;
        }

        $this->view->render('create');
    }

    public function showAction()
    {
        $note = $this->get();
        $this->view->render('show', ['note' => $note]);
    }

    public function listAction()
    {
        $phrase = $this->request->getParam('phrase');
        $pageNumber = (int) $this->request->getParam('page', 1);
        $pageSize = (int) $this->request->getParam('pagesize', self::PAGE_SIZE);
        $sortBy = $this->request->getParam('sortby', 'title');
        $sortOrder = $this->request->getParam('sortorder', 'desc');

        if(!in_array($pageSize, [1, 5, 10, 25])){
            $pageSize = self::PAGE_SIZE;
        }

        if ($phrase) {
            $noteList = $this->noteModel->search($phrase, $pageNumber, $pageSize, $sortBy, $sortOrder);
            $notesQuantity = $this->noteModel->searchCount($phrase);
        } else {
            $noteList = $this->noteModel->list($pageNumber, $pageSize, $sortBy, $sortOrder);
            $notesQuantity = $this->noteModel->count();
        }

        $this->view->render(
            'list', 
            [
            'page' => ['number' => $pageNumber, 'size' => $pageSize, 'pages' => (int)ceil($notesQuantity/$pageSize)], 
            'phrase' => $phrase,  
            'sort' => ['by' => $sortBy, 'order' => $sortOrder],
            'notes' => $noteList,
            'before' => $this->request->getParam('before'),
            'error' => $this->request->getParam('error')
            ]
        );
    }

    public function editAction()
    {
        if($this->request->isPost()){
            $noteId = (int) $this->request->postParam('id');
            $noteData = [
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description')
            ];
            $this->noteModel->edit($noteId, $noteData);
            $this->redirect('/app/index.php/', ['before' => 'edited']);
        }

        $note = $this->get();
        $this->view->render('edit', ['note' => $note]);
    }

    public function deleteAction()
    {
        $note = $this->get();
        $this->noteModel->delete((int)$note['id']);
        $this->redirect('/app/index.php/', ['before' => 'deleted']);
    }

    private function get(): array
    {
        $noteId = (int) ($this->request->getParam('id'));
        if (!$noteId) {
        $this->redirect('/app/index.php/', ['error' => 'missingNoteId']);
        }
        return $this->noteModel->get($noteId);
    }
}