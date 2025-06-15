<?php
/**
 * @title          Core Entry Point
 * @desc           Main entry file for the application.
 */

define('APP_CORE', 1);

use RuntimeException;

require __DIR__ . '/EnvChecker.php';

$oEnvChecker = new EnvChecker();

try {
    $oEnvChecker->verifyPhpVersion();
    if (!$oEnvChecker->isConfigExists()) {
        if ($oEnvChecker->isInstallerAvailable()) {
            $oEnvChecker->clearBrowserCache();
            $oEnvChecker->redirectToInstaller();
        } else {
            echo $oEnvChecker->getConfigMissingMessage();
        }
        exit;
    }
} catch (RuntimeException $oExcept) {
    echo $oExcept->getMessage();
    exit;
}

require __DIR__ . '/_constants.php';
require APP_PATH . 'CoreLoader.php';

$oApp = CoreLoader::init();
$oApp->configureTimezone();

ob_start();
$oApp->launch();
ob_end_flush();
