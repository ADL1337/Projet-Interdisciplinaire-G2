<?php

class View {
    private static string $viewsDir = __DIR__ . "/../views/"; # Path to the views directory
    private string $templateName; # Name of the template (default: "template")
    private string $viewName; # Filename of the view
    private string $title; # Title of the page

    private static function getViewsDir() {
        return self::$viewsDir;
    }
    
    private static function getTemplatesDir() {
        return self::getViewsDir() . "templates/";
    }
    
    private static function _getFilepath(string $directoryPath, string $filename, string $fileExtension=".php") {
        return $directoryPath . $filename . $fileExtension;
    }

    private function getViewPath() {
        return self::_getFilepath(self::getViewsDir(), $this->viewName);
    }

    private function getTemplatePath() {
        return self::_getFilepath(self::getTemplatesDir(), $this->templateName);
    }

    public function __construct(string $viewName, string $viewTitle, string $templateName="template") {
        $this->viewName = $viewName;
        $this->title = $viewTitle;
        $this->templateName = $templateName;
    }

    public function generateView(array $data) {
        # Render the specific view with the necessary data
        $content = $this->renderView($data);

        # Render the template
        $view = $this->renderTemplate(array("title" => $this->title,
                                            "content" => $content));
        return $view;
    }

    private function renderView(array $data) {
        return self::_genericRender(self::getViewPath(), $data);
    }

    private function renderTemplate(array $data) {
        return self::_genericRender(self::getTemplatePath(), $data);
    }

    private static function _genericRender(string $filepath, array $data) {
        if (file_exists($filepath)) {
            # Extract the variables for the target
            extract($data);

            # Output buffering to store the render
            ob_start();
            include $filepath;
            return ob_get_clean();
        }
        else {
            return false;
        }
    }
}

?>