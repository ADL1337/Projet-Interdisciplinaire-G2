<?php

class Vue {
    private static string $viewsDir = __DIR__ . "/../views/";
    private static string $template = "template.php"; # We could change this to an empty instance attribute if we want a different template
    private string $viewPath;
    private string $title;

    public function __construct(string $viewName, string $viewTitle) {
        $this->viewPath = $this->getViewPath($viewName);
        $this->title = $viewTitle;
    }

    public function generateView(array $data) {
        $content = $this->renderView($this->viewPath, $data);
        $view = $this->renderView(self::$template, array("title" => $this->title,
                                                         "content" => $content));
        return $view;
    }

    private function renderView(string $viewName, array $data) {
        if (file_exists($this->getViewPath($viewName))) {
            extract($data);

            ob_start();
            include $this->getViewPath($viewName);
            return ob_get_clean();
        }
        else {
            return false;
        }
    }

    private function getViewPath(string $viewName) {
        return self::$viewsDir . $viewName . ".php";
    }
}

?>