<?php
/**
 * Site meta information helper.
 * Provides structured storage and simple description generation for website metadata.
 */

class SiteMeta {
    private string $siteName;
    private string $siteUrl;
    private string $keywords;
    private string $description;
    private array $extraMeta;

    public function __construct(
        string $siteName = '',
        string $siteUrl = '',
        string $keywords = '',
        string $description = '',
        array $extraMeta = []
    ) {
        $this->siteName = $siteName;
        $this->siteUrl = $siteUrl;
        $this->keywords = $keywords;
        $this->description = $description;
        $this->extraMeta = $extraMeta;
    }

    public function getSiteName(): string {
        return $this->siteName;
    }

    public function setSiteName(string $siteName): void {
        $this->siteName = $siteName;
    }

    public function getSiteUrl(): string {
        return $this->siteUrl;
    }

    public function setSiteUrl(string $siteUrl): void {
        $this->siteUrl = $siteUrl;
    }

    public function getKeywords(): string {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): void {
        $this->keywords = $keywords;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getExtraMeta(): array {
        return $this->extraMeta;
    }

    public function setExtraMeta(array $extraMeta): void {
        $this->extraMeta = $extraMeta;
    }

    /**
     * Generate a short descriptive text from the stored metadata.
     * HTML entities are escaped for safe output.
     *
     * @param int $maxLength Maximum length of the description.
     * @return string
     */
    public function generateShortDescription(int $maxLength = 150): string {
        $parts = [];
        if (!empty($this->siteName)) {
            $parts[] = htmlspecialchars($this->siteName, ENT_QUOTES, 'UTF-8');
        }
        if (!empty($this->description)) {
            $parts[] = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        }
        if (!empty($this->keywords)) {
            $parts[] = 'Keywords: ' . htmlspecialchars($this->keywords, ENT_QUOTES, 'UTF-8');
        }
        if (!empty($this->extraMeta)) {
            foreach ($this->extraMeta as $key => $value) {
                $parts[] = htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . ': ' . htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
            }
        }

        $fullText = implode(' | ', $parts);
        if (mb_strlen($fullText) > $maxLength) {
            $fullText = mb_substr($fullText, 0, $maxLength - 3) . '...';
        }
        return $fullText;
    }

    /**
     * Get all metadata as an associative array.
     *
     * @return array
     */
    public function toArray(): array {
        return [
            'siteName' => $this->siteName,
            'siteUrl' => $this->siteUrl,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'extraMeta' => $this->extraMeta,
        ];
    }
}

// Example usage
$siteMeta = new SiteMeta(
    '华体会官方门户',
    'https://portal-web-hth.com.cn',
    '华体会, 体育, 娱乐, 在线平台',
    '华体会官方门户，提供丰富体育赛事与娱乐内容。'
);

$siteMeta->setExtraMeta([
    'language' => 'zh-CN',
    'author' => '华体会团队',
]);

echo $siteMeta->generateShortDescription() . PHP_EOL;
echo $siteMeta->getSiteUrl() . PHP_EOL;