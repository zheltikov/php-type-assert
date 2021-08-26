<?php

namespace Zheltikov\TypeAssert;

class TypeCheckerState
{
    /**
     * @var string[]
     */
    protected array $report_stack;

    /**
     *
     */
    private function __construct()
    {
        $this->report_stack = [];
    }

    // -------------------------------------------------------------------------

    /**
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }

    // -------------------------------------------------------------------------

    /**
     * @param string $message
     * @return $this
     */
    public function appendReportStack(string $message): self
    {
        $this->report_stack[] = $message;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getReportStack(): array
    {
        return $this->report_stack;
    }
}
