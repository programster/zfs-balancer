zfs-balancer
============

A PHP script created in order to re-balance a ZFS RAID array that was built up over time by adding drives to an existing pool.

### Deduplication Off
As this script works by copying files before deleting the original and renaming the copy back to that of the original, so **you probably need deduplication switched off** for the principle to properly work. You can do this in Ubuntu 16.04 with the following command:

```
sudo zfs set dedup=off myZpoolName
```

Note: this script will work on one file at a time rather than all at once, so it's not a disaster if you terminate the script mid-way through. The worst thing that could happen is that you either have the original file and a copy with a number extension, or you just have the copy with a number extension rather than the original, but you never lose/corrupt a file.

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
