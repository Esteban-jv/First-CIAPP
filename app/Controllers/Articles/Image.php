<?php

namespace App\Controllers\Articles;

use App\Controllers\BaseController;
use App\Entities\Article;
use App\Models\ArticleModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use RuntimeException;
use finfo;

class Image extends BaseController
{
    private ArticleModel $model;
    private $folder_name = "article_images";

    public function __construct()
    {
        $this->model = new ArticleModel;
    }

    public function new($id)
    {
        $article = $this->getArticleOr404($id);
        return view('Articles\Image\new', [
            'article' => $article,
        ]);
    }

    public function create($id)
    {
        $article = $this->getArticleOr404($id);
        $file = $this->request->getFile('image');

        // Check if is a valid file
        if (!$file->isValid()) {
            $error_code = $file->getError();
            if ($error_code === UPLOAD_ERR_NO_FILE) {
                return redirect()->back()
                    ->with("errors", ["No file selected"]);
            }

            throw new RuntimeException($file->getErrorString() . ' ' . $error_code);
        }
        // Check size of the file
        if ($file->getSizeByUnit("mb") > 2) {
            return redirect()->back()
                ->with("errors", ["File too large"]);
        }
        // Check extension of the file
        if (!in_array($file->getMimeType(), ["image/png", "image/jpeg"])) {
            return redirect()->back()
                ->with("errors", ["Invalid file format"]);
        }

        // Process
//        dd($file->getRealPath());
        $path = $file->store($this->folder_name);
        $path = WRITEPATH . "uploads/" . $path;

        service("image")
            ->withFile($path)
            ->fit(250, 250, "center")
            ->save();
//        dd($path);

        $article->image = $file->getName();
        $this->model->protect(false)->save($article);

        return redirect()->to("articles/$id")->with("message","Image uploaded.");
    }

    public function get($id)
    {
        $article = $this->getArticleOr404($id);

        if($article->image) {
            $path = WRITEPATH . "uploads/" . $this->folder_name . "/" . $article->image;
            $finfo = new finfo(FILEINFO_MIME);
            $type = $finfo->file($path);

            header("Content-Type: $type");
            header("Content-Length: " . filesize($path));

            readfile($path);
            exit;
        }
    }

    public function delete($id)
    {
        $article = $this->getArticleOr404($id);
        $path = WRITEPATH . "uploads/" . $this->folder_name . "/" . $article->image;

        if(is_file($path)) {
            unlink($path);
        }
        $article->image = null;
        $this->model->protect(false)->save($article);

        return redirect()->to("articles/$id")->with("message","Image removed.");
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
