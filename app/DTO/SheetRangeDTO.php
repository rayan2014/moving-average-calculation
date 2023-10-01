<?php

namespace App\DTO;

class SheetRangeDTO
{

    public function __construct(public string $start, public ?string $end = '')
    {
    }


    /**
     * @return string
     */
    public function getStart(): string
    {
        return $this->start;
    }

    /**
     * @param string $start
     */
    public function setStart(string $start): void
    {
        $this->start = $start;
    }

    /**
     * @return string|null
     */
    public function getEnd(): ?string
    {
        return $this->end;
    }

    /**
     * @param string|null $end
     */
    public function setEnd(?string $end): void
    {
        $this->end = $end;
    }


}
