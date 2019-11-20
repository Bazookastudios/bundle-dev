<?php

namespace App\Entity\Upload;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nitro\ApiUploadBundle\Entity\Interfaces\ApiFileUploadInterface;
use Nitro\ApiUploadBundle\Entity\Traits\ApiFileUploadTrait;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="file_uploads")
 *
 * Class ApiFileUpload
 * @package App\Entity\Upload
 */
class ApiFileUpload implements ApiFileUploadInterface
{
    use ApiFileUploadTrait;

    /**
     * ApiFileUpload constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
    }
}
