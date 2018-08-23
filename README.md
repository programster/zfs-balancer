ZFS Balancer
============

A PHP script created in order to re-balance a ZFS RAID array that was built up over time by adding drives to an existing pool.

To check the balance of your current pool, use the command:

```
zpool list -v
```

Here is an example output of my very unbalanced pool soon after I added two 8TB drives to it:

```
NAME   SIZE  ALLOC   FREE  EXPANDSZ   FRAG    CAP  DEDUP  HEALTH  ALTROOT
zpool1  13.6T  4.21T  9.39T         -    15%    30%  1.00x  ONLINE  -
  mirror  3.62T  2.20T  1.43T         -    31%    60%
    sda      -      -      -         -      -      -
    sdb      -      -      -         -      -      -
  mirror  2.72T  1.65T  1.07T         -    32%    60%
    sdc      -      -      -         -      -      -
    sdd      -      -      -         -      -      -
  mirror  7.25T   368G  6.89T         -     2%     4%
    sde      -      -      -         -      -      -
    sdf      -      -      -         -      -      -
```

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
