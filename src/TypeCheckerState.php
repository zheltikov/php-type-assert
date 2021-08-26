<?php

namespace Zheltikov\TypeAssert;

class TypeCheckerState
{
    /**
     * @var string[]
     */
    protected array $report_stack;

    /**
     * @var bool
     */
    protected bool $reporting_enabled;

    /**
     *
     */
    private function __construct()
    {
        $this->report_stack = [];
        $this->setReportingEnabled();
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
        if ($this->isReportingEnabled()) {
            $this->report_stack[] = $message;
        }
        return $this;
    }

    /**
     * @return string[]
     */
    public function getReportStack(): array
    {
        return $this->report_stack;
    }

    /**
     * @param bool $reporting_enabled
     * @return $this
     */
    public function setReportingEnabled(bool $reporting_enabled = true): self
    {
        $this->reporting_enabled = $reporting_enabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReportingEnabled(): bool
    {
        return $this->reporting_enabled;
    }
}
