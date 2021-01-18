<?php

namespace App\Model\Utility;

use Cake\Log\Log;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class S3Manager
{

  private $_s3Client;

  /**
   * __construct method
   *
   * @return void
   */
  function __construct()
  {
    $this->_s3Client = new S3Client([
      'credentials' => [
        'key' => env('S3_ACCESS_KEY'),
        'secret' => env('S3_SECRET_KEY'),
      ],
      'region' => env('S3_REGION'),
      'version' => env('S3_VERSION'),
    ]);
  }

  /**
   * putObject method
   *
   * @param string $directory
   * @param string $baseFileName
   * @param string $newFileName
   * @return boolean
   */
  public function putObject($directory, $baseFileName, $newFileName)
  {
    $ret = false;
    try {
      $fullPath = $directory . $baseFileName;
      $result = $this->_s3Client->putObject([
        'Bucket' => env('S3_BUCKET_NAME'),
        'Key' => env('ITEM_IMAGE_PATH') . $newFileName,
        'SourceFile' => $fullPath,
        'ContentType' => mime_content_type($fullPath),
      ]);
      $ret = true;
    } catch (S3Exception $e) {
      Log::error($e->getMessage());
    }
    return $ret;
  }

  /**
   * Get a list of files
   * @param string $bucket_name
   * @param string $dir
   * @param int $get_max
   * @return array
   * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.S3.S3Client.html#_listObjects
   */
  // public function getList($bucket_name = null, $dir = null, $get_max = 100)
  // {
  //   try {
  //     if (!$bucket_name) $bucket_name = $this->default_bucket;
  //     $list_obj = $this->s3->listObjects([
  //       'Bucket' => $bucket_name,
  //       'MaxKeys' => $get_max,
  //       'Prefix' => $dir
  //     ]);

  //     foreach ($list_obj['Contents'] as $file) {
  //       if (mb_substr($file['Key'], -1) !== "/" && (!$dir  || ($dir && strpos($file['Key'], sprintf('%s/', $dir)) !== false))) {
  //         $result[] = $file['Key'];
  //       }
  //     }

  //     return $result;
  //   } catch (S3Exception $e) {
  //     echo $e->getMessage();
  //   }
  // }


  /**
   * deleteObject method
   *
   * @param string $deleteFileName
   * @return boolean
   */
  public function deleteObject($deleteFileName)
  {
    $ret = false;
    try {
      $result = $this->_s3Client->deleteObject([
        'Bucket' => env('S3_BUCKET_NAME'),
        'Key' => env('ITEM_IMAGE_PATH') . $deleteFileName
      ]);
      $ret = true;
    } catch (S3Exception $e) {
      Log::error($e->getMessage());
    }
    return $ret;
  }
}
