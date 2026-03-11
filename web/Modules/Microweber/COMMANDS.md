# Microweber Console Commands

## Available Commands

### 1. Run Vendor Assets Symlink for All Installations

This command runs `microweber:vendor-assets-symlink` for all Microweber installations on the server.

```bash
php artisan microweber:run-vendor-assets-symlink
```

To run for a specific installation:
```bash
php artisan microweber:run-vendor-assets-symlink --installation-id=123
```

### 2. Run Any Command for All Installations (Generic)

This is a generic command that can run any artisan or composer command for all installations.

```bash
php artisan microweber:run-command "cache:clear"
```

To run for a specific installation:
```bash
php artisan microweber:run-command "cache:clear" --installation-id=123
```

#### Supported Commands:
- `cache:clear` - Clear cache
- `microweber:vendor-assets-symlink` - Create vendor assets symlinks
- `microweber:reload-database` - Reload database
- `composer:dump` - Run composer dump-autoload
- `composer:publish-assets` - Publish composer assets
- Any other artisan command

#### Examples:
```bash
# Clear cache for all installations
php artisan microweber:run-command "cache:clear"

# Create vendor symlinks for all installations
php artisan microweber:run-command "microweber:vendor-assets-symlink"

# Reload database for specific installation
php artisan microweber:run-command "microweber:reload-database" --installation-id=5

# Run composer dump-autoload for all installations
php artisan microweber:run-command "composer:dump"
```

## How It Works

These commands use the `RunInstallationCommands` job which:
1. Fetches all Microweber installations (or a specific one)
2. For each installation, it:
   - Finds the associated domain and hosting subscription
   - Gets the system username
   - Executes the command in the installation path as the correct user
   - Logs the results

## Notes

- Commands are executed synchronously (not queued)
- All operations are logged
- Commands run with proper user permissions (sudo -u username)
- Installation paths are validated before execution

