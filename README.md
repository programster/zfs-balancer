zfs-balancer
============

A PHP script created in order to re-balance a ZFS RAID array that was built up over time by adding drives to an existing pool.

### Deduplication Off
As this script works by copying files before deleting the original and renaming the copy back to that of the original, **you probably need deduplication switched off** for the principle to properly work. You can do this in Ubuntu 16.04 with the following command:

```
sudo zfs set dedup=off myZpoolName
```

## Requirements
This script requires PHP 5.5 or higher. You can usually install PHP on Ubuntu 16.04 with

```
sudo apt-get install php7.0-cli
```

On Ubuntu 14.04 I believe the command was:
```
sudo apt-get install php-cli
```

## Usage
```
php main.php /path/to/folder/to/balance
```
*Note: You can use relative or full paths.*

## Testing
Tested on Ubuntu 14.04 64bit with php 5.5.9
