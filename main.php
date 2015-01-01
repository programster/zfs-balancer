<?php


/**
 * Rebalance the directory by writing the file across all block devices.
 * RecursiveIteratorIterator does not follow symlinks by default, and we do not
 * wish too since that could lead to all kinds of hell.
 * @param $directory - the path to the directory we wish to rebalance
 */
function rebalanceDir($directory)
{
    # Get file count for progress
    $countingIterator = new RecursiveDirectoryIterator($directory);
    $numFiles = 0;

    foreach (new RecursiveIteratorIterator($countingIterator) as $filename => $file) 
    {
        if (!is_dir($filename))
        {
            $numFiles++;
        }
    }
    

    # Now "rebalance"
    $iterator = new RecursiveDirectoryIterator($directory);
    $progressCounter = 0;
    $lastPercentage = 0;

    foreach (new RecursiveIteratorIterator($iterator) as $filename => $file) 
    {
        if (!is_dir($filename))
        {
            $progressCounter++;

            $newPercentage = intval(($progressCounter / $numFiles * 100));
            if ($newPercentage !== $lastPercentage)
            {
                print $newPercentage . "%" . PHP_EOL;
                $lastPercentage = $newPercentage;
            }
            
            
            $counter = 1;

            while (is_file($filename . $counter))
            {
                $counter++;
            }
            
            $newname = $filename . $counter;
            
            # We have to use copy first instead of rename because we need 
            # new data blocks to be rewritten across all drives. Performing
            # a rename would just change the metadata.
            copy($filename, $newname);
            unlink($filename);
            
            # Rename the file back to what it was originally called.
            rename($newname, $filename);
        }
    }
}



$directory = $argv[1];


if (is_dir($directory))
{ 
    $directory = realpath($directory);
    
    if (strtolower(readline("Balance the files within [$directory] (y/n)? ")) == "y")
    {
        rebalanceDir($directory);
        print "complete!" . PHP_EOL;
    }
}
else
{
    print 'Invalid directory given!' . PHP_EOL; 
}
