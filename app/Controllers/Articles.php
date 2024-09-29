<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Entities\Article;
use CodeIgniter\Exceptions\PageNotFoundException;

class Articles extends BaseController
{
    private ArticleModel $model;

    public function __construct()
    {
        $this->model = new ArticleModel;
    }

    public function index(): string
    {
        $data = $this->model
            ->select('articles.*, users.first_name as author')
            ->join('users','users.id = articles.user_id')
            ->paginate(3);

        return view('Articles/index', [
            'articles' => $data,
            'pager' => $this->model->pager
        ]);
    }

    public function show($id)
    {
        $article = $this->getArticleOr404($id);

        return view('Articles/show', ['article' => $article]);
    }

    public function new()
    {
        return view('Articles/create', [
            "article" => new Article
        ]);
    }

    public function create()
    {
        $article = new Article($this->request->getPost());
        $id = $this->model->insert($article);

        if ($id === false) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/articles')->with('message', 'Article created!');
    }

    public function edit($id)
    {
        $article = $this->getArticleOr404($id);

        return view('Articles/edit', ['article' => $article]);
    }

    public function update($id)
    {
        $article = $this->getArticleOr404($id);
        $article->fill($this->request->getPost());
        $article->__unset('_method');

        if(!$article->hasChanged())
        {
            return redirect()->to('/articles')->withInput()->with('message', 'Nothing to update!');
        }
        else if($this->model->save($article))
        {
            return redirect()->to('/articles')->with('message', 'Article updated!');
        }
        else
        {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
    }

    public function confirmDelete($id)
    {
        $article = $this->getArticleOr404($id);
        return view('Articles/delete', ['article' => $article]);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/articles')->with('message', 'Article deleted!');
    }

    private function getArticleOr404($id): Article
    {
        $article = $this->model->find($id);
        if(is_null($article))
        {
            throw new PageNotFoundException("Article with id $id not found");
        }
        return $article;
    }
}
