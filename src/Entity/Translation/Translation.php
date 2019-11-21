<?php

namespace App\Entity\Translation;

use Bazookas\CommonBundle\Entity\Interfaces\EntityInterface;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Bazookas\CommonBundle\Entity\Traits\TimestampableTrait;
use DateTimeImmutable;
use DateTimeZone;
use Exception;
use Nitro\TranslationBundle\Entity\Interfaces\TranslationInterface;
use Nitro\TranslationBundle\Entity\Traits\TranslationTrait;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use function get_class;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Translation\TranslationRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="translations",
 *     indexes={
 *          @ORM\Index(
 *              name="search_idx",
 *              columns={"domain", "key"}
 *          )
 * })
 * @UniqueEntity(fields={"domain","key"})
 *
 * Class Translation
 * @package Entity\Translation
 */
class Translation implements TranslationInterface, TimestampableInterface, EntityInterface
{
    use TranslationTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $translationNL;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $translationEN;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $translationFR;

    /**
     * Translation constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
        $this->created = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        $this->modified = new DateTimeImmutable('now', new DateTimeZone('UTC'));
    }

    /**
     * @param string $locale
     *
     * @return string|null
     */
    public function getTranslation(string $locale): ?string
    {
        switch ($locale) {
            case 'nl':
                return $this->translationNL;
            case 'fr':
                return $this->translationFR;
            case 'en':
            default:
                return $this->translationEN;
        }
    }

    /**
     * @return bool
     */
    public function allowForceDelete(): bool
    {
        return true;
    }

    /**
     * @param string $locale
     *
     * @return array|string
     *
     * @throws Exception
     */
    public function getLinkedEntityMessage(string $locale = 'nl')
    {
        return get_class($this).' {id: '.$this->getId().'}';
    }

    /**
     * @param string $locale
     * @param string $value
     *
     * @return TranslationInterface
     */
    public function setTranslation(string $locale, string $value): TranslationInterface
    {
        switch ($locale) {
            case 'nl':
                $this->translationNL = $value;
                break;
            case 'fr':
                $this->translationFR = $value;
                break;
            case 'en':
                $this->translationEN = $value;
                break;
        }

        return $this;
    }
}
