<?php

class View {
    private static string $viewsDir = __DIR__ . "/../views/";
    private static string $template = "template.php"; # We could change this to an instance attribute if we want to allow multiple templates
    private string $viewPath;
    private string $title;

    public function __construct(string $viewName, string $viewTitle) {
        $this->viewPath = $this->getViewPath($viewName);
        $this->title = $viewTitle;
    }

    public function generateView(array $data) {
        # Render the specific view with the necessary data
        $content = $this->renderView($this->viewPath, $data);

        # Render the template view 
        $view = $this->renderView(self::$template, array("title" => $this->title,
                                                         "content" => $content));
        return $view;
    }

    private function renderView(string $viewName, array $data) {
        if (file_exists($this->getViewPath($viewName))) {
            # Extract the variables for the views
            extract($data);

            # Output buffering to store the rendered views
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