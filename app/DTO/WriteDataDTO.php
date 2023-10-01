<?php

namespace App\DTO;

class WriteDataDTO
{
    private array $data;
    private string $row;
    private string $column;

    /**
     * @param array $data
     * @param string $row
     * @param string $column
     */
    public function __construct(array $data, string $row, string $column)
    {
        $this->data = $data;
        $this->row = $row;
        $this->column = $column;
    }


    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getRow(): string
    {
        return $this->row;
    }

    /**
     * @param string $row
     */
    public function setRow(string $row): void
    {
        $this->row = $row;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @param string $column
     */
    public function setColumn(string $column): void
    {
        $this->column = $column;
    }


}
