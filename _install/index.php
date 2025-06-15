<?php
/**
 * @title          Verve - Family Connection Platform
 * @desc           Main entry point for Verve with enhanced UX and error handling
 *
 * @author         Verve Team <support@vervefamily.com>
 * @copyright      (c) 2023, Verve Family. All Rights Reserved.
 * @license        See LICENSE.txt and COPYRIGHT.txt in the root directory.
 * @link           https://vervefamily.com
 * @package        VERVE / ROOT
 */

namespace VERVE;

define('VERVE', 1);

use RuntimeException;

// Show basic PHP errors in development, hide in production
ini_set('display_errors', $_SERVER['SERVER_NAME'] === 'localhost' ? '1' : '0');
error_reporting(E_ALL);

// Custom error handler for better UX
set_error_handler(function($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) return;
    renderErrorPage("System Error", "A technical issue occurred. Please try again later.", 500);
    exit;
});

// Custom exception handler
set_exception_handler(function($exception) {
    renderErrorPage("Unexpected Error", $exception->getMessage(), 500);
    exit;
});

// Function to render visually appealing error pages
function renderErrorPage(string $title, string $message, int $httpCode = 500) {
    http_response_code($httpCode);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verve - <?= htmlspecialchars($title) ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #5D5CDE 0%, #8b5cf6 100%);
                color: #fff;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 20px;
                text-align: center;
            }
            .error-container {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                padding: 40px;
                max-width: 800px;
                width: 100%;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .logo {
                font-size: 3rem;
                margin-bottom: 20px;
                display: flex;
                justify-content: center;
            }
            .logo i {
                background: linear-gradient(to right, #5D5CDE, #8b5cf6);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            h1 {
                font-size: 2.5rem;
                margin-bottom: 20px;
                font-weight: 600;
            }
            p {
                font-size: 1.2rem;
                line-height: 1.8;
                margin-bottom: 30px;
                opacity: 0.9;
            }
            .error-details {
                background: rgba(0, 0, 0, 0.2);
                padding: 20px;
                border-radius: 10px;
                margin: 25px 0;
                text-align: left;
                font-family: monospace;
                font-size: 0.9rem;
                overflow-x: auto;
            }
            .actions {
                display: flex;
                gap: 15px;
                justify-content: center;
                flex-wrap: wrap;
            }
            .btn {
                padding: 12px 30px;
                border-radius: 50px;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
                display: inline-block;
            }
            .btn-primary {
                background: linear-gradient(to right, #5D5CDE, #8b5cf6);
                color: white;
            }
            .btn-secondary {
                background: rgba(255, 255, 255, 0.15);
                color: white;
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }
            .contact-support {
                margin-top: 30px;
                font-size: 0.9rem;
                opacity: 0.8;
            }
            .brand {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 2.8rem;
                background: linear-gradient(to right, #fff, #f0f0ff);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                margin-bottom: 10px;
                letter-spacing: -1px;
            }
            .tagline {
                font-size: 1.2rem;
                opacity: 0.9;
                margin-bottom: 30px;
            }
            @media (max-width: 600px) {
                .error-container { padding: 25px; }
                h1 { font-size: 2rem; }
                .brand { font-size: 2.2rem; }
                .tagline { font-size: 1rem; }
                p { font-size: 1rem; }
                .btn { width: 100%; margin-bottom: 10px; }
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <div class="logo">
                <i class="fas fa-home"></i>
            </div>
            <div class="brand">Verve</div>
            <div class="tagline">Connecting Families, Creating Memories</div>
            
            <h1><?= htmlspecialchars($title) ?></h1>
            <p><?= nl2br(htmlspecialchars($message)) ?></p>
            
            <?php if ($httpCode === 500): ?>
                <div class="error-details">
                    <strong>Technical Details:</strong><br>
                    Error occurred in <?= $_SERVER['SCRIPT_NAME'] ?><br>
                    Time: <?= date('Y-m-d H:i:s') ?>
                </div>
            <?php endif; ?>
            
            <div class="actions">
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-primary">
                    <i class="fas fa-redo"></i> Reload Page
                </a>
                <a href="/" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Home Page
                </a>
            </div>
            
            <div class="contact-support">
                Need help? Contact our support team at support@vervefamily.com
            </div>
        </div>
        
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
}

require __DIR__ . '/WebsiteChecker.php';

$oSiteChecker = new WebsiteChecker();

try {
    $oSiteChecker->checkPhpVersion();
    
    if (!$oSiteChecker->doesConfigFileExist()) {
        if ($oSiteChecker->doesInstallFolderExist()) {
            $oSiteChecker->clearBrowserCache();
            $oSiteChecker->moveToInstaller();
        } else {
            renderErrorPage(
                "Configuration Missing", 
                "The configuration file was not found and the installation directory is missing.\n\n" .
                "This usually means Verve hasn't been installed yet or files are missing.\n" .
                "Please verify that you've uploaded all files correctly and that the '_install' folder exists."
            );
        }
        exit;
    }
} catch (RuntimeException $e) {
    renderErrorPage(
        "System Requirement Error", 
        $e->getMessage() . "\n\n" .
        "Verve requires PHP 8.0 or higher to run properly.\n" .
        "Please contact your hosting provider to upgrade your PHP version."
    );
    exit;
}

require __DIR__ . '/_constants.php';
require VERVE_PATH_APP . 'Bootstrap.php';

$oApp = Bootstrap::getInstance();
$oApp->setTimezoneIfNotSet();

// Output buffering with compression if available
if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
}

$oApp->run();

// Send output buffer
if (ob_get_level() > 0) {
    ob_end_flush();
}
