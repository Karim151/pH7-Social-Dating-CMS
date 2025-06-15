<?php
/**
 * Verve CMS Server Requirements Checker
 * 
 * This script verifies server compatibility with Verve CMS, providing
 * a visually stunning interface with clear feedback.
 *
 * @package        Install
 * @file           requirements
 * @author         Verve Team
 * @email          support@vervefamily.com
 * @copyright      (c) 2023, Verve Family. All Rights Reserved.
 * @license        MIT (https://opensource.org/licenses/MIT)
 * @version        1.0
 */

defined('VERVE') or exit('Restricted access');

define('EXTENSION_KEY', 'extension');
define('CLASS_KEY', 'class');
define('FUNCTION_KEY', 'function');
define('DIRECTIVE_KEY', 'directive');

// Set required PHP version (adjust as needed)
define('VERVE_REQUIRED_PHP_VERSION', '8.0');

$aErrors = array();

if (version_compare(PHP_VERSION, VERVE_REQUIRED_PHP_VERSION, '<')) {
    $aErrors[] = 'Your PHP version is ' . PHP_VERSION . '. Verve CMS requires PHP ' . VERVE_REQUIRED_PHP_VERSION . ' or newer.';
}

$aRequirementsNeeded = array(
    EXTENSION_KEY => array(
        'pdo_mysql' => 'PDO MySQL',
        'zip' => 'Zip Archive',
        'zlib' => 'Zlib Compression',
        'gd' => 'GD Image Library',
        'mbstring' => 'Multibyte String',
        'exif' => 'EXIF Image Data'
    ),
    CLASS_KEY => array(
        'DOMDocument' => 'DOM Extension'
    ),
    FUNCTION_KEY => array(
        'exif_imagetype' => 'EXIF Functions',
        'imagettftext' => 'FreeType Support',
        'curl_init' => 'cURL Library'
    ),
    DIRECTIVE_KEY => array(
        'file_uploads',
        'allow_url_fopen'
    )
);

foreach ($aRequirementsNeeded as $sType => $aRequirements) {
    if ($sType === EXTENSION_KEY) {
        foreach ($aRequirements as $sExtension => $sExtensionName) {
            if (!extension_loaded($sExtension)) {
                $aErrors[] = 'Missing extension: ' . $sExtensionName;
            }
        }
    }

    if ($sType === CLASS_KEY) {
        foreach ($aRequirements as $sClass => $sClassName) {
            if (!class_exists($sClass)) {
                $aErrors[] = 'Missing class: ' . $sClassName;
            }
        }
    }

    if ($sType === FUNCTION_KEY) {
        foreach ($aRequirements as $sFunction => $sFunctionName) {
            if (!function_exists($sFunction)) {
                $aErrors[] = 'Missing function: ' . $sFunctionName;
            }
        }
    }

    if ($sType === DIRECTIVE_KEY) {
        foreach ($aRequirements as $sDirective) {
            if (filter_var(ini_get($sDirective), FILTER_VALIDATE_BOOLEAN) === false) {
                $aErrors[] = 'Directive required: ' . $sDirective;
            }
        }
    }
}

$iErrors = count($aErrors);

// Display beautiful interface
display_html_header('Server Requirements - Verve CMS');

if ($iErrors === 0) {
    echo '<div class="success-card">
            <div class="icon success-icon">✓</div>
            <h2>Your Server is Ready!</h2>
            <p>All requirements for Verve CMS are satisfied.</p>
            <div class="server-info">
                <div class="info-item">
                    <span>PHP Version:</span>
                    <strong>'.PHP_VERSION.'</strong>
                </div>
                <div class="info-item">
                    <span>Required:</span>
                    <strong>'.VERVE_REQUIRED_PHP_VERSION.'+</strong>
                </div>
            </div>
            <a href="'.get_next_step_url().'" class="continue-btn">Continue Installation</a>
        </div>';
} else {
    echo '<div class="error-card">
            <div class="icon error-icon">!</div>
            <h2>Server Requirements Not Met</h2>
            <p>We found '.$iErrors.' issue(s) that need to be resolved:</p>
            
            <div class="requirements-list">';
    
    foreach ($aErrors as $iKey => $sError) {
        echo '<div class="requirement-item">
                <div class="status-icon error">✗</div>
                <div class="requirement-details">
                    <div class="requirement-name">'.$sError.'</div>
                </div>
              </div>';
    }
    
    echo '</div>
          <div class="server-info">
              <div class="info-item">
                  <span>PHP Version:</span>
                  <strong>'.PHP_VERSION.'</strong>
              </div>
              <div class="info-item">
                  <span>Required:</span>
                  <strong>'.VERVE_REQUIRED_PHP_VERSION.'+</strong>
              </div>
          </div>
          <div class="actions">
              <a href="javascript:location.reload()" class="reload-btn">Re-check</a>
              <a href="https://vervefamily.com/support" target="_blank" class="support-btn">Get Support</a>
          </div>
      </div>';
}

display_html_footer();

exit($iErrors > 0 ? 1 : 0);


function display_html_header($sPageTitle) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>'.htmlspecialchars($sPageTitle).'</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: "Poppins", sans-serif;
                background: linear-gradient(135deg, #5D5CDE 0%, #8b5cf6 100%);
                color: #fff;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                line-height: 1.6;
            }
            
            .container {
                max-width: 800px;
                width: 100%;
                margin: 0 auto;
            }
            
            .logo {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .logo h1 {
                font-size: 2.8rem;
                font-weight: 700;
                letter-spacing: -1px;
                margin-bottom: 10px;
                background: linear-gradient(to right, #fff, #f0f0ff);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }
            
            .logo p {
                font-size: 1.2rem;
                opacity: 0.9;
            }
            
            .card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(12px);
                border-radius: 20px;
                padding: 40px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.15);
            }
            
            .success-card, .error-card {
                text-align: center;
            }
            
            .icon {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 25px;
                font-size: 2.5rem;
                font-weight: bold;
            }
            
            .success-icon {
                background: rgba(76, 175, 80, 0.2);
                color: #4CAF50;
                border: 3px solid #4CAF50;
            }
            
            .error-icon {
                background: rgba(244, 67, 54, 0.2);
                color: #f44336;
                border: 3px solid #f44336;
            }
            
            h2 {
                font-size: 2rem;
                margin-bottom: 15px;
                font-weight: 600;
            }
            
            p {
                font-size: 1.1rem;
                opacity: 0.9;
                margin-bottom: 30px;
            }
            
            .requirements-list {
                background: rgba(0, 0, 0, 0.1);
                border-radius: 12px;
                padding: 20px;
                margin: 30px 0;
                text-align: left;
            }
            
            .requirement-item {
                display: flex;
                align-items: center;
                padding: 15px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .requirement-item:last-child {
                border-bottom: none;
            }
            
            .status-icon {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
                font-size: 1.1rem;
            }
            
            .status-icon.error {
                background: rgba(244, 67, 54, 0.2);
                color: #f44336;
            }
            
            .requirement-name {
                font-size: 1.05rem;
            }
            
            .server-info {
                display: flex;
                justify-content: center;
                gap: 30px;
                margin: 25px 0;
                flex-wrap: wrap;
            }
            
            .info-item {
                background: rgba(0, 0, 0, 0.15);
                padding: 15px 25px;
                border-radius: 12px;
                text-align: center;
            }
            
            .info-item span {
                display: block;
                font-size: 0.9rem;
                opacity: 0.8;
                margin-bottom: 5px;
            }
            
            .info-item strong {
                font-size: 1.2rem;
                font-weight: 600;
            }
            
            .continue-btn, .reload-btn, .support-btn {
                display: inline-block;
                padding: 14px 35px;
                border-radius: 50px;
                text-decoration: none;
                font-weight: 500;
                font-size: 1.1rem;
                transition: all 0.3s ease;
                margin: 10px;
            }
            
            .continue-btn {
                background: linear-gradient(to right, #5D5CDE, #8b5cf6);
                color: white;
                box-shadow: 0 5px 15px rgba(93, 92, 222, 0.4);
            }
            
            .reload-btn {
                background: rgba(255, 255, 255, 0.15);
                color: white;
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            
            .support-btn {
                background: linear-gradient(to right, #00C853, #00E676);
                color: white;
            }
            
            .continue-btn:hover, .reload-btn:hover, .support-btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }
            
            .actions {
                margin-top: 25px;
            }
            
            footer {
                text-align: center;
                margin-top: 40px;
                opacity: 0.7;
                font-size: 0.9rem;
            }
            
            @media (max-width: 600px) {
                .card {
                    padding: 25px;
                }
                
                .logo h1 {
                    font-size: 2.2rem;
                }
                
                h2 {
                    font-size: 1.7rem;
                }
                
                .info-item {
                    width: 100%;
                }
                
                .actions {
                    display: flex;
                    flex-direction: column;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">
                <h1>Verve</h1>
                <p>Connecting Families, Creating Memories</p>
            </div>
            <div class="card">';
}

function display_html_footer() {
    echo '      </div>
            <footer>
                Verve CMS &copy; ' . date('Y') . ' | Server Requirements Checker
            </footer>
        </div>
    </body>
    </html>';
}

function get_next_step_url() {
    // In a real implementation, this would point to the next installation step
    return '#';
}
