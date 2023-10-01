<?php

namespace App\DTO;

use App\Helpers\Enums\General;

class BaseDTO
{
    public function __construct(private string    $dataSourceId,
                                private string $sheet,
                                private ?int   $window)
    {
    }
    public static function fromRequest(array $request): self
    {
        return new self(
            dataSourceId: $request['google_sheet_id'],
            sheet: $request['sheet'],
            window: $request['window'] ??  General::DEFAULT_WINDOW_SIZE->value,
        );
    }

    /**
     * @return string
     */
    public function getDataSourceId(): string
    {
        return $this->dataSourceId;
    }

    /**
     * @param string $dataSourceId
     */
    public function setDataSourceId(string $dataSourceId): void
    {
        $this->dataSourceId = $dataSourceId;
    }

    /**
     * @return string
     */
    public function getSheet(): string
    {
        return $this->sheet;
    }

    /**
     * @param string $sheet
     */
    public function setSheet(string $sheet): void
    {
        $this->sheet = $sheet;
    }

    /**
     * @return int|null
     */
    public function getWindow(): ?int
    {
        return $this->window;
    }

    /**
     * @param int|null $window
     */
    public function setWindow(?int $window): void
    {
        $this->window = $window;
    }




}
