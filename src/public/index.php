<?php
use \Psr\Http\Message\ResponseInterface as Response;
require '../../vendor/autoload.php';

require '../../src/utils/common-util.php';
require '../../src/apis/read-file.php';
use \Psr\Http\Message\ServerRequestInterface as Request;

function fileExists($fileName, $caseSensitive = true)
{

    if (file_exists($fileName)) {
        return $fileName;
    }
    if ($caseSensitive) {
        return false;
    }

    // Handle case insensitive requests
    $directoryName = dirname($fileName);
    $fileArray = glob($directoryName . '/*', GLOB_NOSORT);
    $fileNameLowerCase = strtolower($fileName);
    foreach ($fileArray as $file) {
        if (strtolower($file) == $fileNameLowerCase) {
            return $file;
        }
    }
    return false;
}

$app = new \Slim\App;
$app->get('/', function (Request $request, Response $response, array $args) {

    try {
        $fileUserInpPath = $request->getQueryParams()["filePath"];
        $rawPath = "/www/wwwroot/php-for-shell/" . $fileUserInpPath;

        // $path = "";
        // if (file_exists($rawPath)) {
        //     $path = $rawPath;
        // }

        // $test = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        // echo $test;
        // die();

        $path = fileExists($rawPath, $caseSensitive = false);

        if (!$path) {
            throw new ErrorException("no file exist: " . $rawPath);
        }

        $public_name = basename($path);

        // get the file's mime type to send the correct content type header
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $path);

        // send the headers
        header("Content-Disposition: attachment; filename=$public_name;");
        header("Content-Type: $mime_type");
        header('Content-Length: ' . filesize($path));

        // stream the file
        $fp = fopen($path, 'rb');
        fpassthru($fp);
        exit;
    } catch (Exception $e) {
        pe("error", $e);
    }
});

$app->run();
