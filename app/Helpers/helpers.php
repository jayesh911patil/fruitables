<?php
/// helpers/helpers.php
function uploadImage($file, $directory)
{
    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path($directory), $filename);
    return $filename;
}
?>