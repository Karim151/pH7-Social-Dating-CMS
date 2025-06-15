<?php
/**
 * Environment Compatibility Checker
 * Validates server requirements and configuration status
 */

namespace App\Core;

class EnvChecker
{
    const MIN_PHP_VERSION = '7.4.0';
    const CONFIG_FILE = '_constants.php';
    const INSTALL_DIR = '_install/';

    const PHP_VERSION_ERROR = 'Your server is running PHP %s. This application requires PHP %s or newer.<br>Please contact your hosting provider to upgrade your PHP version.';
    const MISSING_CONFIG_ERROR = 'Configuration file not found. For new installations, ensure the install directory is present and your database is ready.';

    public function verifyPhpVersion(): void
    {
        if ($this->isUnsupportedPhpVersion()) {
            throw new \RuntimeException(
                sprintf(
                    self::PHP_VERSION_ERROR,
                    PHP_VERSION,
                    self::MIN_PHP_VERSION
                )
            );
        }
    }

    public function clearBrowserCache(): void
    {
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: ' . gmdate('D, d M Y H:i:s', 0) . ' GMT');
    }

    public function redirectToInstaller(): void
    {
        header('Location: ' . self::INSTALL_DIR, true, 302);
        exit;
    }

    public function isConfigExists(): bool
    {
        return is_file(__DIR__ . '/' . self::CONFIG_FILE);
    }

    public function isInstallerAvailable(): bool
    {
        return is_dir(__DIR__ . '/' . self::INSTALL_DIR);
    }

    public function getConfigMissingMessage(): string
    {
        return self::MISSING_CONFIG_ERROR;
    }

    private function isUnsupportedPhpVersion(): bool
    {
        return version_compare(PHP_VERSION, self::MIN_PHP_VERSION, '<');
    }
}
